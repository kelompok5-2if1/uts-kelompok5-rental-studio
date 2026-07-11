<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Exports\PelangganExport;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;

        $pelanggan = Pelanggan::query()

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%");
                });
            })

            ->when($filter == 'booking', function ($query) {
                $query->whereHas('bookingStudio');
            })

            ->when($filter == 'rental', function ($query) {
                $query->whereHas('rentalAlat');
            })

            ->when($filter == 'baru', function ($query) {
                $query->whereDoesntHave('bookingStudio')
                      ->whereDoesntHave('rentalAlat');
            })

            ->orderBy('nama')
            ->paginate(10)
            ->appends(request()->query());

        return view(
            'pelanggan.index',
            compact(
                'pelanggan',
                'search',
                'filter'
            )
        );
    }

    public function create()
    {
        $this->authorizeWriteAccess('pelanggan');

        return view('pelanggan.create');
    }

    public function store(StorePelangganRequest $request)
    {
        $this->authorizeWriteAccess('pelanggan');

        Pelanggan::create(
            $request->validated()
        );

        return redirect()
            ->route('pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil ditambahkan'
            );
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('pelanggan');

        $pelanggan = Pelanggan::findOrFail($id);

        return view(
            'pelanggan.edit',
            compact('pelanggan')
        );
    }

    public function update(
        UpdatePelangganRequest $request,
        $id
    ) {
        $this->authorizeWriteAccess('pelanggan');

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update(
            $request->validated()
        );

        return redirect()
            ->route('pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil diperbarui'
            );
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('pelanggan');

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with(
                'success',
                'Data pelanggan berhasil dihapus'
            );
    }

    public function exportExcel()
    {
        return Excel::download(
            new PelangganExport,
            'pelanggan.xlsx'
            );
    }

    
}