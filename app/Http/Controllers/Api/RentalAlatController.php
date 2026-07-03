<?php

namespace App\Http\Controllers\Api;

use App\Models\RentalAlat;
use App\Http\Requests\StoreRentalAlatRequest;
use App\Http\Requests\UpdateRentalAlatRequest;
use App\Http\Resources\RentalAlatResource;
use App\Http\Resources\RentalAlatCollection;
use Illuminate\Http\Response;

class RentalAlatController extends Controller
{
    public function index()
    {
        $rentalAlat = RentalAlat::with(['pelanggan', 'alatBand'])->paginate(10);
        return new RentalAlatCollection($rentalAlat);
    }

    public function store(StoreRentalAlatRequest $request)
    {
        $rentalAlat = RentalAlat::create($request->validated());
        return new RentalAlatResource($rentalAlat->load(['pelanggan', 'alatBand']));
    }

    public function show(RentalAlat $rentalAlat)
    {
        return new RentalAlatResource($rentalAlat->load(['pelanggan', 'alatBand']));
    }

    public function update(UpdateRentalAlatRequest $request, RentalAlat $rentalAlat)
    {
        $rentalAlat->update($request->validated());
        return new RentalAlatResource($rentalAlat->load(['pelanggan', 'alatBand']));
    }

    public function destroy(RentalAlat $rentalAlat)
    {
        $rentalAlat->delete();
        return response()->json(['message' => 'Rental Alat deleted successfully'], Response::HTTP_OK);
    }
}
