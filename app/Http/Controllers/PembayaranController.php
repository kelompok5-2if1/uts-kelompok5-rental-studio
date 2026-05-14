<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\RentalAlat;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::all();

        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $rental = RentalAlat::all();

        return view('pembayaran.create', compact('rental'));
    }

    public function store(Request $request)
    {
        Pembayaran::create($request->all());

        return redirect('/pembayaran');
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $rental = RentalAlat::all();

        return view('pembayaran.edit', compact(
            'pembayaran',
            'rental'
        ));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update($request->all());

        return redirect('/pembayaran');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->delete();

        return redirect('/pembayaran');
    }
}