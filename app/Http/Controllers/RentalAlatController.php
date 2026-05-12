<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalAlat;
use App\Models\Pelanggan;
use App\Models\AlatBand;

class RentalAlatController extends Controller
{
    public function index()
    {
        $rentalAlat = RentalAlat::with([
            'pelanggan',
            'alatBand'
        ])->get();

        return view('rental-alat.index', compact('rentalAlat'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();

        $alatBand = AlatBand::all();

        return view('rental-alat.create', compact(
            'pelanggan',
            'alatBand'
        ));
    }

    public function store(Request $request)
    {
        RentalAlat::create($request->all());

        return redirect('/rental-alat');
    }

    public function edit($id)
    {
        $rentalAlat = RentalAlat::findOrFail($id);

        $pelanggan = Pelanggan::all();

        $alatBand = AlatBand::all();

        return view('rental-alat.edit', compact(
            'rentalAlat',
            'pelanggan',
            'alatBand'
        ));
    }

    public function update(Request $request, $id)
    {
        $rentalAlat = RentalAlat::findOrFail($id);

        $rentalAlat->update($request->all());

        return redirect('/rental-alat');
    }

    public function destroy($id)
    {
        $rentalAlat = RentalAlat::findOrFail($id);

        $rentalAlat->delete();

        return redirect('/rental-alat');
    }
}