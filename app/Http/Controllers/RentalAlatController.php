<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalAlat;
use App\Models\Pelanggan;
use App\Models\AlatBand;
use App\Http\Requests\StoreRentalAlatRequest;
use App\Http\Requests\UpdateRentalAlatRequest;
use App\Exports\RentalAlatExport;
use Maatwebsite\Excel\Facades\Excel;

class RentalAlatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $status = $request->query('status', '');
        $rentalAlat = RentalAlat::with([
            'pelanggan',
            'alatBand'
        ])->when($search, function ($query) use ($search) {
            return $query->whereHas('pelanggan', function ($q) use ($search) {
                            $q->where('nama', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('alatBand', function ($q) use ($search) {
                            $q->where('nama_alat', 'like', '%' . $search . '%');
                        })
                        ->orWhere('status', 'like', '%' . $search . '%');
        })->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->paginate(10)->appends($request->query());

        return view('rental-alat.index', compact('rentalAlat', 'search', 'status'));
    }

    public function create()
    {
        $this->authorizeWriteAccess('rental-alat');

        $pelanggan = Pelanggan::all();

        $alatBand = AlatBand::all();

        return view('rental-alat.create', compact(
            'pelanggan',
            'alatBand'
        ));
    }

    public function store(StoreRentalAlatRequest $request)
    {
        $this->authorizeWriteAccess('rental-alat');

        RentalAlat::create($request->validated());

        return redirect('/rental-alat');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('rental-alat');

        $rentalAlat = RentalAlat::findOrFail($id);

        $pelanggan = Pelanggan::all();

        $alatBand = AlatBand::all();

        return view('rental-alat.edit', compact(
            'rentalAlat',
            'pelanggan',
            'alatBand'
        ));
    }

    public function update(UpdateRentalAlatRequest $request, $id)
    {
        $this->authorizeWriteAccess('rental-alat');

        $rentalAlat = RentalAlat::findOrFail($id);

        $rentalAlat->update($request->validated());

        return redirect('/rental-alat');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('rental-alat');

        $rentalAlat = RentalAlat::findOrFail($id);

        $rentalAlat->delete();

        return redirect('/rental-alat');
    }

    public function exportExcel()
    {
        return Excel::download(
            new RentalAlatExport,
            'rental-alat.xlsx'
        );
    }
}