<?php

namespace App\Http\Controllers;

use App\Exports\LaporanRentalExport;
use App\Http\Requests\StoreLaporanRentalRequest;
use App\Http\Requests\UpdateLaporanRentalRequest;
use App\Models\BookingStudio;
use App\Models\LaporanRental;
use App\Models\Pembayaran;
use App\Models\RentalAlat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanRentalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $data = $this->buildReportData($search);

        return view('laporan-rental.index', [
            'laporan' => $data['laporan'],
            'search' => $search,
            'summary' => $data['summary'],
        ]);
    }

    public function create()
    {
        $this->authorizeWriteAccess('laporan-rental');

        return view('laporan-rental.create');
    }

    public function store(StoreLaporanRentalRequest $request)
    {
        $this->authorizeWriteAccess('laporan-rental');

        LaporanRental::create($request->validated());

        return redirect('/laporan-rental');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('laporan-rental');

        $laporan = LaporanRental::findOrFail($id);

        return view('laporan-rental.edit', compact('laporan'));
    }

    public function update(UpdateLaporanRentalRequest $request, $id)
    {
        $this->authorizeWriteAccess('laporan-rental');

        $laporan = LaporanRental::findOrFail($id);

        $laporan->update($request->validated());

        return redirect('/laporan-rental');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('laporan-rental');

        $laporan = LaporanRental::findOrFail($id);

        $laporan->delete();

        return redirect('/laporan-rental');
    }

    public function exportPdf()
    {
        $data = $this->buildReportData('');

        $pdf = Pdf::loadView(
            'laporan-rental.pdf',
            ['laporan' => $data['laporan']]
        );

        return $pdf->download(
            'laporan-rental.pdf'
        );
    }

    public function exportExcel()
    {
        $data = $this->buildReportData('');

        return Excel::download(
            new LaporanRentalExport($data['laporan']),
            'laporan-rental.xlsx'
        );
    }

    private function buildReportData(string $search = ''): array
    {
        $bookings = BookingStudio::with(['pelanggan', 'studio'])->get();
        $rentals = RentalAlat::with(['pelanggan', 'alatBand'])->get();
        $payments = Pembayaran::with(['rentalAlat', 'bookingStudio'])->get();

        $reportRows = collect();

        foreach ($bookings as $booking) {
            $reportRows->push([
                'pelanggan' => $booking->pelanggan->nama ?? '-',
                'jenis_transaksi' => 'Booking Studio',
                'tanggal' => $booking->tanggal_booking,
                'metode_pembayaran' => '-',
                'total' => $booking->total_harga,
                'total_bayar' => $booking->total_harga,
                'nominal_dibayar' => null,
                'kembalian' => null,
                'status' => $booking->status,
            ]);
        }

        foreach ($rentals as $rental) {
            $reportRows->push([
                'pelanggan' => $rental->pelanggan->nama ?? '-',
                'jenis_transaksi' => 'Rental Alat',
                'tanggal' => $rental->tanggal_sewa,
                'metode_pembayaran' => '-',
                'total' => $rental->total_harga,
                'total_bayar' => $rental->total_harga,
                'nominal_dibayar' => null,
                'kembalian' => null,
                'status' => $rental->status,
            ]);
        }

        foreach ($payments as $payment) {
            $reportRows->push([
                'pelanggan' => $payment->rentalAlat?->pelanggan?->nama ?? $payment->bookingStudio?->pelanggan?->nama ?? '-',
                'jenis_transaksi' => $payment->jenis_transaksi ?? 'Pembayaran',
                'tanggal' => $payment->tanggal_bayar,
                'metode_pembayaran' => $payment->metode_bayar,
                'total' => $payment->total_bayar,
                'total_bayar' => $payment->total_bayar,
                'nominal_dibayar' => $payment->nominal_dibayar,
                'kembalian' => $payment->kembalian,
                'status' => $payment->status,
            ]);
        }

        $laporan = $reportRows->filter(function ($row) use ($search) {
            if ($search === '') {
                return true;
            }

            return str_contains(strtolower($row['pelanggan']), strtolower($search))
                || str_contains(strtolower($row['jenis_transaksi']), strtolower($search))
                || str_contains(strtolower($row['status']), strtolower($search));
        })->values();

        $summary = [
            'total_booking' => $bookings->count(),
            'total_rental' => $rentals->count(),
            'total_pendapatan' => $payments->sum('total_bayar'),
        ];

        return compact('laporan', 'summary');
    }
}