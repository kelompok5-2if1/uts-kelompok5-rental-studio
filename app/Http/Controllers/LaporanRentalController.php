<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanRental;

class LaporanRentalController extends Controller
{
    public function index()
    {
        $laporan = LaporanRental::all();

        return view('laporan-rental.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporan-rental.create');
    }

    public function store(Request $request)
    {
        LaporanRental::create($request->all());

        return redirect('/laporan-rental');
    }

    public function edit($id)
    {
        $laporan = LaporanRental::findOrFail($id);

        return view('laporan-rental.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanRental::findOrFail($id);

        $laporan->update($request->all());

        return redirect('/laporan-rental');
    }

    public function destroy($id)
    {
        $laporan = LaporanRental::findOrFail($id);

        $laporan->delete();

        return redirect('/laporan-rental');
    }
}