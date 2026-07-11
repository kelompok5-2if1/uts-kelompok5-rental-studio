<?php

namespace App\Http\Controllers;

use App\Models\AlatBand;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAlatBandRequest;
use App\Http\Requests\UpdateAlatBandRequest;
use App\Exports\AlatBandExport;
use Maatwebsite\Excel\Facades\Excel;

class AlatBandController extends Controller
{
    /**
     * Display listing.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $kondisi = $request->kondisi;

        $alatBand = AlatBand::with('kategori')

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {

                    $q->where('nama_alat', 'like', "%{$search}%")
                      ->orWhere('kondisi', 'like', "%{$search}%");

                });
            })

            ->when($kondisi, function ($query) use ($kondisi) {
                $query->where('kondisi', $kondisi);
            })

            ->orderBy('nama_alat')
            ->paginate(10)
            ->appends($request->query());

        return view(
            'alat-band.index',
            compact(
                'alatBand',
                'search',
                'kondisi'
            )
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $this->authorizeWriteAccess('alat-band');

        $kategori = Kategori::orderBy('nama_kategori')
                            ->get();

        return view(
            'alat-band.create',
            compact('kategori')
        );
    }

    /**
     * Store data.
     */
    public function store(StoreAlatBandRequest $request)
    {
        $this->authorizeWriteAccess('alat-band');

        $data = $request->validated();

        if ($request->hasFile('foto')) {

            $data['foto'] = $request
                ->file('foto')
                ->store('alat-band', 'public');
        }

        AlatBand::create($data);

        return redirect()
            ->route('alat-band.index')
            ->with(
                'success',
                'Alat band berhasil ditambahkan'
            );
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $this->authorizeWriteAccess('alat-band');

        $alatBand = AlatBand::findOrFail($id);

        $kategori = Kategori::orderBy('nama_kategori')
                            ->get();

        return view(
            'alat-band.edit',
            compact(
                'alatBand',
                'kategori'
            )
        );
    }

    /**
     * Update data.
     */
    public function update(
        UpdateAlatBandRequest $request,
        $id
    ) {
        $this->authorizeWriteAccess('alat-band');

        $alatBand = AlatBand::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('foto')) {

            if (
                $alatBand->foto &&
                Storage::disk('public')
                    ->exists($alatBand->foto)
            ) {
                Storage::disk('public')
                    ->delete($alatBand->foto);
            }

            $data['foto'] = $request
                ->file('foto')
                ->store('alat-band', 'public');
        }

        $alatBand->update($data);

        return redirect()
            ->route('alat-band.index')
            ->with(
                'success',
                'Alat band berhasil diperbarui'
            );
    }

    /**
     * Delete data.
     */
    public function destroy($id)
    {
        $this->authorizeWriteAccess('alat-band');

        $alatBand = AlatBand::findOrFail($id);

        if (
            $alatBand->foto &&
            Storage::disk('public')
                ->exists($alatBand->foto)
        ) {
            Storage::disk('public')
                ->delete($alatBand->foto);
        }

        $alatBand->delete();

        return redirect()
            ->route('alat-band.index')
            ->with(
                'success',
                'Alat band berhasil dihapus'
            );
    }

    public function exportExcel()
    {
        return Excel::download(
            new AlatBandExport,
            'alat-band.xlsx'
        );
    }
}