<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailRental;
use App\Models\RentalAlat;
use App\Models\AlatBand;

class DetailRentalController extends Controller
{
    public function index()
    {
        $detailRental = DetailRental::all();

        return view('detail-rental.index', compact('detailRental'));
    }

    public function create()
    {
        $rental = RentalAlat::all();
        $alat = AlatBand::all();

        return view('detail-rental.create', compact('rental', 'alat'));
    }

    public function store(Request $request)
    {
        DetailRental::create($request->all());

        return redirect('/detail-rental');
    }

    public function edit($id)
    {
        $detailRental = DetailRental::findOrFail($id);

        $rental = RentalAlat::all();
        $alat = AlatBand::all();

        return view('detail-rental.edit', compact(
            'detailRental',
            'rental',
            'alat'
        ));
    }

    public function update(Request $request, $id)
    {
        $detailRental = DetailRental::findOrFail($id);

        $detailRental->update($request->all());

        return redirect('/detail-rental');
    }

    public function destroy($id)
    {
        $detailRental = DetailRental::findOrFail($id);

        $detailRental->delete();

        return redirect('/detail-rental');
    }
}