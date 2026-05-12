<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlatBand;
use App\Models\Kategori;

class AlatBandController extends Controller
{
    public function index()
    {
        $alatBand = AlatBand::with('kategori')->get();

        return view('alat-band.index', compact('alatBand'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('alat-band.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        AlatBand::create($request->all());

        return redirect('/alat-band');
    }

    public function edit($id)
    {
        $alatBand = AlatBand::findOrFail($id);

        $kategori = Kategori::all();

        return view('alat-band.edit', compact('alatBand', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $alatBand = AlatBand::findOrFail($id);

        $alatBand->update($request->all());

        return redirect('/alat-band');
    }

    public function destroy($id)
    {
        $alatBand = AlatBand::findOrFail($id);

        $alatBand->delete();

        return redirect('/alat-band');
    }
}