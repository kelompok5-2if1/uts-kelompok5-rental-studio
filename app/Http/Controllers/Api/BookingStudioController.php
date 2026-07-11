<?php

namespace App\Http\Controllers\Api;

use App\Models\BookingStudio;
use App\Http\Requests\StoreBookingStudioRequest;
use App\Http\Requests\UpdateBookingStudioRequest;
use App\Http\Resources\BookingStudioResource;
use App\Http\Resources\BookingStudioCollection;
use Illuminate\Http\Response;

class BookingStudioController extends Controller
{
    public function index()
    {
        $bookingStudio = BookingStudio::with(['pelanggan', 'studio'])->paginate(10);
        return new BookingStudioCollection($bookingStudio);
    }

    public function store(StoreBookingStudioRequest $request)
    {
        $bookingStudio = BookingStudio::create($request->validated());
        return (new BookingStudioResource($bookingStudio->load(['pelanggan', 'studio'])))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookingStudio $bookingStudio)
    {
        return new BookingStudioResource($bookingStudio->load(['pelanggan', 'studio']));
    }

    public function update(UpdateBookingStudioRequest $request, BookingStudio $bookingStudio)
    {
        $bookingStudio->update($request->validated());
        return new BookingStudioResource($bookingStudio->load(['pelanggan', 'studio']));
    }

    public function destroy(BookingStudio $bookingStudio)
    {
        $bookingStudio->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
