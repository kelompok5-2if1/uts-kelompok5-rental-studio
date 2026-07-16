<?php

namespace App\Http\Controllers;

use App\Exports\DetailRentalExport;
use App\Http\Requests\StoreDetailRentalRequest;
use App\Http\Requests\UpdateDetailRentalRequest;
use App\Models\AlatBand;
use App\Models\DetailRental;
use App\Models\RentalAlat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DetailRentalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $detailRental = RentalAlat::with(['pelanggan', 'alatBand', 'detailRental'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('pelanggan', function ($q) use ($search) {
                        $q->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('alatBand', function ($q) use ($search) {
                        $q->where('nama_alat', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10)
            ->appends($request->query());

        return view('detail-rental.index', compact('detailRental', 'search'));
    }

    public function create()
    {
        return redirect('/detail-rental')->with('info', 'Detail rental diambil dari transaksi rental yang sudah ada.');
    }

    public function store(StoreDetailRentalRequest $request)
    {
        return redirect('/detail-rental')->with('info', 'Detail rental diambil dari transaksi rental yang sudah ada.');
    }

    public function edit($id)
    {
        return redirect('/detail-rental')->with('info', 'Detail rental diambil dari transaksi rental yang sudah ada.');
    }

    public function update(UpdateDetailRentalRequest $request, $id)
    {
        return redirect('/detail-rental')->with('info', 'Detail rental diambil dari transaksi rental yang sudah ada.');
    }

    public function destroy($id)
    {
        return redirect('/detail-rental')->with('info', 'Detail rental diambil dari transaksi rental yang sudah ada.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new DetailRentalExport,
            'detail-rental.xlsx'
        );
    }
}