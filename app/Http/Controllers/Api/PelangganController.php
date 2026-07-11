<?php

namespace App\Http\Controllers\Api;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Http\Resources\PelangganResource;
use App\Http\Resources\PelangganCollection;
use Illuminate\Http\Response;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::paginate(10);
        return new PelangganCollection($pelanggan);
    }

    public function store(StorePelangganRequest $request)
    {
        $pelanggan = Pelanggan::create($request->validated());
        return (new PelangganResource($pelanggan))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pelanggan $pelanggan)
    {
        return new PelangganResource($pelanggan);
    }

    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        $pelanggan->update($request->validated());
        return new PelangganResource($pelanggan);
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
