<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembayaran;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Http\Resources\PembayaranResource;
use App\Http\Resources\PembayaranCollection;
use Illuminate\Http\Response;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('rentalAlat')->paginate(10);
        return new PembayaranCollection($pembayaran);
    }

    public function store(StorePembayaranRequest $request)
    {
        $pembayaran = Pembayaran::create($request->validated());
        return new PembayaranResource($pembayaran->load('rentalAlat'));
    }

    public function show(Pembayaran $pembayaran)
    {
        return new PembayaranResource($pembayaran->load('rentalAlat'));
    }

    public function update(UpdatePembayaranRequest $request, Pembayaran $pembayaran)
    {
        $pembayaran->update($request->validated());
        return new PembayaranResource($pembayaran->load('rentalAlat'));
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return response()->json(['message' => 'Pembayaran deleted successfully'], Response::HTTP_OK);
    }
}
