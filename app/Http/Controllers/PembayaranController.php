<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\BookingStudio;
use App\Models\Pembayaran;
use App\Models\RentalAlat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $status = $request->query('status', '');
        $pembayaran = Pembayaran::with(['rentalAlat', 'bookingStudio'])
                               ->when($search, function ($query) use ($search) {
                                   return $query->where('metode_bayar', 'like', '%' . $search . '%')
                                                ->orWhere('status', 'like', '%' . $search . '%');
                               })
                               ->when($status, function ($query) use ($status) {
                                   return $query->where('status', $status);
                               })
                               ->latest()
                               ->paginate(10)
                               ->appends($request->query());

        return view('pembayaran.index', compact('pembayaran', 'search', 'status'));
    }

    public function create()
    {
        $this->authorizeWriteAccess('pembayaran');

        $bookings = BookingStudio::whereDoesntHave('pembayaran')
            ->where('status', '!=', 'Batal')
            ->with(['pelanggan', 'studio'])
            ->get();

        $rentals = RentalAlat::whereDoesntHave('pembayaran')
            ->where('status', '!=', 'Dikembalikan')
            ->with(['pelanggan', 'alatBand'])
            ->get();

        return view('pembayaran.create', compact('bookings', 'rentals'));
    }

    public function store(StorePembayaranRequest $request)
    {
        $this->authorizeWriteAccess('pembayaran');

        $totalTagihan = $this->resolveTotalTagihan($request);

        if ($request->nominal_dibayar < $totalTagihan) {
            return back()->withErrors(['nominal_dibayar' => 'Pembayaran tidak mencukupi.'])->withInput();
        }

        $data = $request->validated();
        $data['total_bayar'] = $totalTagihan;
        $data['nominal_dibayar'] = $request->nominal_dibayar;
        $data['kembalian'] = $request->nominal_dibayar - $totalTagihan;
        $data['status'] = 'Lunas';

        $payment = Pembayaran::create($data);

        if ($request->jenis_transaksi === 'Booking Studio') {
            $booking = BookingStudio::findOrFail($request->booking_studio_id);
            $booking->update(['status' => 'Selesai']);
            $payment->booking_studio_id = $booking->id;
            $payment->save();
        } else {
            $rental = RentalAlat::findOrFail($request->rental_alat_id);
            $rental->update(['status' => 'Dikembalikan']);
            $payment->rental_alat_id = $rental->id;
            $payment->save();
        }

        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('pembayaran');

        $pembayaran = Pembayaran::findOrFail($id);
        $bookings = BookingStudio::whereDoesntHave('pembayaran')->with(['pelanggan', 'studio'])->get();
        $rentals = RentalAlat::whereDoesntHave('pembayaran')->with(['pelanggan', 'alatBand'])->get();

        return view('pembayaran.edit', compact('pembayaran', 'bookings', 'rentals'));
    }

    public function update(UpdatePembayaranRequest $request, $id)
    {
        $this->authorizeWriteAccess('pembayaran');

        $pembayaran = Pembayaran::findOrFail($id);
        $totalTagihan = $this->resolveTotalTagihan($request);

        if ($request->nominal_dibayar < $totalTagihan) {
            return back()->withErrors(['nominal_dibayar' => 'Pembayaran tidak mencukupi.'])->withInput();
        }

        $data = $request->validated();
        $data['total_bayar'] = $totalTagihan;
        $data['nominal_dibayar'] = $request->nominal_dibayar;
        $data['kembalian'] = $request->nominal_dibayar - $totalTagihan;
        $data['status'] = 'Lunas';

        $pembayaran->update($data);

        return redirect('/pembayaran')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('pembayaran');

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect('/pembayaran');
    }

    public function exportExcel()
    {
        return Excel::download(
            new PembayaranExport,
            'pembayaran.xlsx'
        );
    }

    private function resolveTotalTagihan(Request $request): float
    {
        if ($request->jenis_transaksi === 'Booking Studio') {
            $booking = BookingStudio::findOrFail($request->booking_studio_id);
            return (float) $booking->total_harga;
        }

        $rental = RentalAlat::findOrFail($request->rental_alat_id);
        return (float) $rental->total_harga;
    }
}