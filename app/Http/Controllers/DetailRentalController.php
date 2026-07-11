<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailRental;
use App\Models\RentalAlat;
use App\Models\AlatBand;
use App\Http\Requests\StoreDetailRentalRequest;
use App\Http\Requests\UpdateDetailRentalRequest;
use App\Exports\DetailRentalExport;
use Maatwebsite\Excel\Facades\Excel;

class DetailRentalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $detailRental = DetailRental::with(['rentalAlat', 'alatBand'])
                                     ->when($search, function ($query) use ($search) {
                                         return $query->whereHas('alatBand', function ($q) use ($search) {
                                                         $q->where('nama_alat', 'like', '%' . $search . '%');
                                                     })
                                                     ->orWhere('jumlah', 'like', '%' . $search . '%');
                                     })
                                     ->paginate(10)
                                     ->appends($request->query());

        return view('detail-rental.index', compact('detailRental', 'search'));
    }

    public function create()
    {
        $this->authorizeWriteAccess('detail-rental');

        $rental = RentalAlat::all();
        $alat = AlatBand::all();

        return view('detail-rental.create', compact('rental', 'alat'));
    }

    public function store(StoreDetailRentalRequest $request)
    {
        $this->authorizeWriteAccess('detail-rental');

        DetailRental::create($request->validated());

        return redirect('/detail-rental');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('detail-rental');

        $detailRental = DetailRental::findOrFail($id);

        $rental = RentalAlat::all();
        $alat = AlatBand::all();

        return view('detail-rental.edit', compact(
            'detailRental',
            'rental',
            'alat'
        ));
    }

    public function update(UpdateDetailRentalRequest $request, $id)
    {
        $this->authorizeWriteAccess('detail-rental');

        $detailRental = DetailRental::findOrFail($id);

        $detailRental->update($request->validated());

        return redirect('/detail-rental');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('detail-rental');

        $detailRental = DetailRental::findOrFail($id);

        $detailRental->delete();

        return redirect('/detail-rental');
    }

    public function exportExcel()
    {
        return Excel::download(
            new DetailRentalExport,
            'detail-rental.xlsx'
        );
    }
}