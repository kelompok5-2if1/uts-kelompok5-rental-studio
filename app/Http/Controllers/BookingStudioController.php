<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingStudio;
use App\Models\Pelanggan;
use App\Models\Studio;
use App\Http\Requests\StoreBookingStudioRequest;
use App\Http\Requests\UpdateBookingStudioRequest;
use App\Exports\BookingStudioExport;
use Maatwebsite\Excel\Facades\Excel;

class BookingStudioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $status = $request->query('status', '');
        $bookingStudio = BookingStudio::with([
            'pelanggan',
            'studio'
        ])->when($search, function ($query) use ($search) {
            return $query->whereHas('pelanggan', function ($q) use ($search) {
                            $q->where('nama', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('studio', function ($q) use ($search) {
                            $q->where('nama_studio', 'like', '%' . $search . '%');
                        })
                        ->orWhere('status', 'like', '%' . $search . '%');
        })->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->paginate(10)->appends($request->query());

        return view('booking-studio.index', compact('bookingStudio', 'search', 'status'));
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

    public function store(StoreBookingStudioRequest $request)
    {
        BookingStudio::create($request->validated());

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

    public function update(UpdateBookingStudioRequest $request, $id)
    {
        $bookingStudio = BookingStudio::findOrFail($id);

        $bookingStudio->update($request->validated());

        return redirect('/booking-studio');
    }

    public function destroy($id)
    {
        $bookingStudio = BookingStudio::findOrFail($id);

        $bookingStudio->delete();

        return redirect('/booking-studio');
    }

    public function exportExcel()
    {
        return Excel::download(
            new BookingStudioExport,
            'booking-studio.xlsx'
        );
    }
}