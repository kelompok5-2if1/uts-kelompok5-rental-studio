<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingStudio;
use App\Models\Pelanggan;
use App\Models\Studio;

class BookingStudioController extends Controller
{
    public function index()
    {
        $bookingStudio = BookingStudio::with([
            'pelanggan',
            'studio'
        ])->get();

        return view('booking-studio.index', compact('bookingStudio'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();

        $studio = Studio::all();

        return view('booking-studio.create', compact(
            'pelanggan',
            'studio'
        ));
    }

    public function store(Request $request)
    {
        BookingStudio::create($request->all());

        return redirect('/booking-studio');
    }

    public function edit($id)
    {
        $bookingStudio = BookingStudio::findOrFail($id);

        $pelanggan = Pelanggan::all();

        $studio = Studio::all();

        return view('booking-studio.edit', compact(
            'bookingStudio',
            'pelanggan',
            'studio'
        ));
    }

    public function update(Request $request, $id)
    {
        $bookingStudio = BookingStudio::findOrFail($id);

        $bookingStudio->update($request->all());

        return redirect('/booking-studio');
    }

    public function destroy($id)
    {
        $bookingStudio = BookingStudio::findOrFail($id);

        $bookingStudio->delete();

        return redirect('/booking-studio');
    }
}