<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\RentalAlat;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $status = $request->query('status', '');
        $pembayaran = Pembayaran::with('rentalAlat')
                               ->when($search, function ($query) use ($search) {
                                   return $query->where('metode_bayar', 'like', '%' . $search . '%')
                                                ->orWhere('status', 'like', '%' . $search . '%');
                               })
                               ->when($status, function ($query) use ($status) {
                                   return $query->where('status', $status);
                               })
                               ->paginate(10)
                               ->appends($request->query());

        return view('pembayaran.index', compact('pembayaran', 'search', 'status'));
    }

    public function create()
    {
        $this->authorizeWriteAccess('pembayaran');

        $rental = RentalAlat::all();

        return view('pembayaran.create', compact('rental'));
    }

    public function store(StorePembayaranRequest $request)
    {
        $this->authorizeWriteAccess('pembayaran');

        Pembayaran::create($request->validated());

        return redirect('/pembayaran');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('pembayaran');

        $pembayaran = Pembayaran::findOrFail($id);

        $rental = RentalAlat::all();

        return view('pembayaran.edit', compact(
            'pembayaran',
            'rental'
        ));
    }

    public function update(UpdatePembayaranRequest $request, $id)
    {
        $this->authorizeWriteAccess('pembayaran');

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update($request->validated());

        return redirect('/pembayaran');
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
    
}