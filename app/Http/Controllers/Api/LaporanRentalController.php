<?php

namespace App\Http\Controllers\Api;

use App\Models\LaporanRental;
use App\Http\Requests\StoreLaporanRentalRequest;
use App\Http\Requests\UpdateLaporanRentalRequest;
use App\Http\Resources\LaporanRentalResource;
use App\Http\Resources\LaporanRentalCollection;
use Illuminate\Http\Response;

class LaporanRentalController extends Controller
{
    public function index()
    {
        $laporan = LaporanRental::paginate(10);
        return new LaporanRentalCollection($laporan);
    }

    public function store(StoreLaporanRentalRequest $request)
    {
        $laporan = LaporanRental::create($request->validated());
        return (new LaporanRentalResource($laporan))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LaporanRental $laporan)
    {
        return new LaporanRentalResource($laporan);
    }

    public function update(UpdateLaporanRentalRequest $request, LaporanRental $laporan)
    {
        $laporan->update($request->validated());
        return new LaporanRentalResource($laporan);
    }

    public function destroy(LaporanRental $laporan)
    {
        $laporan->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
