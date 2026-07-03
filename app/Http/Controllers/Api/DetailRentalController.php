<?php

namespace App\Http\Controllers\Api;

use App\Models\DetailRental;
use App\Http\Requests\StoreDetailRentalRequest;
use App\Http\Requests\UpdateDetailRentalRequest;
use App\Http\Resources\DetailRentalResource;
use App\Http\Resources\DetailRentalCollection;
use Illuminate\Http\Response;

class DetailRentalController extends Controller
{
    public function index()
    {
        $detailRental = DetailRental::with(['rentalAlat', 'alatBand'])->paginate(10);
        return new DetailRentalCollection($detailRental);
    }

    public function store(StoreDetailRentalRequest $request)
    {
        $detailRental = DetailRental::create($request->validated());
        return new DetailRentalResource($detailRental->load(['rentalAlat', 'alatBand']));
    }

    public function show(DetailRental $detailRental)
    {
        return new DetailRentalResource($detailRental->load(['rentalAlat', 'alatBand']));
    }

    public function update(UpdateDetailRentalRequest $request, DetailRental $detailRental)
    {
        $detailRental->update($request->validated());
        return new DetailRentalResource($detailRental->load(['rentalAlat', 'alatBand']));
    }

    public function destroy(DetailRental $detailRental)
    {
        $detailRental->delete();
        return response()->json(['message' => 'Detail Rental deleted successfully'], Response::HTTP_OK);
    }
}
