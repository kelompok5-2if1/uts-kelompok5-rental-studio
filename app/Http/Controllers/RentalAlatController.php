<?php

namespace App\Http\Controllers;

use App\Exports\RentalAlatExport;
use App\Http\Requests\StoreRentalAlatRequest;
use App\Http\Requests\UpdateRentalAlatRequest;
use App\Models\AlatBand;
use App\Models\Pelanggan;
use App\Models\RentalAlat;
use Illuminate\Http\Request;
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

        return view('rental-alat.create', compact('pelanggan', 'alatBand'));
    }

    public function store(StoreRentalAlatRequest $request)
    {
        $this->authorizeWriteAccess('rental-alat');

        $alatBand = AlatBand::findOrFail($request->alat_band_id);

        if ($alatBand->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok alat tidak mencukupi.'])->withInput();
        }

        $alatBand->decrement('stok', $request->jumlah);

        $data = $request->validated();
        $data['total_harga'] = $alatBand->harga_sewa * $request->jumlah;
        $data['status'] = $data['status'] ?? 'Dipinjam';

        RentalAlat::create($data);

        return redirect('/rental-alat')->with('success', 'Rental alat berhasil dibuat.');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('rental-alat');

        $rentalAlat = RentalAlat::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $alatBand = AlatBand::all();

        return view('rental-alat.edit', compact('rentalAlat', 'pelanggan', 'alatBand'));
    }

    public function update(UpdateRentalAlatRequest $request, $id)
    {
        $this->authorizeWriteAccess('rental-alat');

        $rentalAlat = RentalAlat::findOrFail($id);
        $previousAlat = $rentalAlat->alatBand;

        if ($previousAlat) {
            $previousAlat->increment('stok', $rentalAlat->jumlah);
            $previousAlat->save();
        }

        $alatBand = AlatBand::findOrFail($request->alat_band_id);

        if ($alatBand->stok < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Stok alat tidak mencukupi.'])->withInput();
        }

        $alatBand->decrement('stok', $request->jumlah);

        $data = $request->validated();
        $data['total_harga'] = $alatBand->harga_sewa * $request->jumlah;
        $rentalAlat->update($data);

        return redirect('/rental-alat')->with('success', 'Rental alat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('rental-alat');

        $rentalAlat = RentalAlat::findOrFail($id);
        $rentalAlat->delete();

        return redirect('/rental-alat')->with('success', 'Rental alat berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new RentalAlatExport,
            'rental-alat.xlsx'
        );
    }
}