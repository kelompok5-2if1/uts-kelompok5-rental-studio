<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $filter = $request->query('filter', '');

        $kategori = Kategori::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kategori', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%');
                });
            })
            ->when($filter === 'alat', function ($query) {
                $query->whereHas('alatBand');
            })
            ->when($filter === 'kosong', function ($query) {
                $query->whereDoesntHave('alatBand');
            })
            ->orderBy('nama_kategori')
            ->paginate(10)
            ->appends($request->query());

        return view('kategori.index', compact('kategori', 'search', 'filter'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(StoreKategoriRequest $request)
    {
        Kategori::create($request->validated());

        return redirect('/kategori');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->update($request->validated());

        return redirect('/kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        $kategori->delete();

        return redirect('/kategori');
    }
}