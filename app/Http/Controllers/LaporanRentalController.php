<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanRental;
use App\Http\Requests\StoreLaporanRentalRequest;
use App\Http\Requests\UpdateLaporanRentalRequest;

class LaporanRentalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $laporan = LaporanRental::when($search, function ($query) use ($search) {
                                   return $query->where('tanggal_laporan', 'like', '%' . $search . '%')
                                                ->orWhere('total_transaksi', 'like', '%' . $search . '%');
                               })
                               ->paginate(10)
                               ->appends($request->query());

        return view('laporan-rental.index', compact('laporan', 'search'));
    }

    public function create()
    {
        return view('laporan-rental.create');
    }

    public function store(StoreLaporanRentalRequest $request)
    {
        LaporanRental::create($request->validated());

        return redirect('/laporan-rental');
    }

    public function edit($id)
    {
        $laporan = LaporanRental::findOrFail($id);

        return view('laporan-rental.edit', compact('laporan'));
    }

    public function update(UpdateLaporanRentalRequest $request, $id)
    {
        $laporan = LaporanRental::findOrFail($id);

        $laporan->update($request->validated());

        return redirect('/laporan-rental');
    }

    public function destroy($id)
    {
        $laporan = LaporanRental::findOrFail($id);

        $laporan->delete();

        return redirect('/laporan-rental');
    }
}