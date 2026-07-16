<?php

namespace App\Http\Controllers;

use App\Exports\BookingStudioExport;
use App\Http\Requests\StoreBookingStudioRequest;
use App\Http\Requests\UpdateBookingStudioRequest;
use App\Models\BookingStudio;
use App\Models\Pelanggan;
use App\Models\Studio;
use Illuminate\Http\Request;
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
        $this->authorizeWriteAccess('booking-studio');

        $pelanggan = Pelanggan::all();
        $studio = Studio::all();

        return view('booking-studio.create', compact('pelanggan', 'studio'));
    }

    public function store(StoreBookingStudioRequest $request)
    {
        $this->authorizeWriteAccess('booking-studio');

        $studio = Studio::findOrFail($request->studio_id);
        $durationHours = $this->calculateDurationHours($request->jam_mulai, $request->jam_selesai);
        $total = $durationHours * $studio->harga_per_jam;

        $data = $request->validated();
        $data['total_harga'] = $total;

        BookingStudio::create($data);

        return redirect('/booking-studio')->with('success', 'Booking studio berhasil dibuat.');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('booking-studio');

        $bookingStudio = BookingStudio::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $studio = Studio::all();

        return view('booking-studio.edit', compact('bookingStudio', 'pelanggan', 'studio'));
    }

    public function update(UpdateBookingStudioRequest $request, $id)
    {
        $this->authorizeWriteAccess('booking-studio');

        $bookingStudio = BookingStudio::findOrFail($id);
        $studio = Studio::findOrFail($request->studio_id);
        $durationHours = $this->calculateDurationHours($request->jam_mulai, $request->jam_selesai);
        $total = $durationHours * $studio->harga_per_jam;

        $data = $request->validated();
        $data['total_harga'] = $total;
        $bookingStudio->update($data);

        return redirect('/booking-studio')->with('success', 'Booking studio berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('booking-studio');

        $bookingStudio = BookingStudio::findOrFail($id);
        $bookingStudio->delete();

        return redirect('/booking-studio')->with('success', 'Booking studio berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(
            new BookingStudioExport,
            'booking-studio.xlsx'
        );
    }

    private function calculateDurationHours(string $jamMulai, string $jamSelesai): int|float
    {
        $start = strtotime($jamMulai);
        $end = strtotime($jamSelesai);
        $minutes = max(0, ($end - $start) / 60);

        return max(1, (int) ceil($minutes / 60));
    }
}