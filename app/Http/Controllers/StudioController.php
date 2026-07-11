<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;
use App\Http\Requests\StoreStudioRequest;
use App\Http\Requests\UpdateStudioRequest;
use Illuminate\Support\Facades\Storage;
use App\Exports\StudioExport;
use Maatwebsite\Excel\Facades\Excel;


class StudioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $filter = $request->query('filter', '');

        $studio = Studio::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_studio', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->when($filter === 'Tersedia', function ($query) {
                $query->where('status', 'Tersedia');
            })
            ->when($filter === 'Maintenance', function ($query) {
                $query->where('status', 'Maintenance');
            })
            ->when($filter === 'booking', function ($query) {
                $query->whereHas('bookingStudio');
            })
            ->when($filter === 'kosong', function ($query) {
                $query->whereDoesntHave('bookingStudio');
            })
            ->orderBy('nama_studio')
            ->paginate(10)
            ->appends($request->query());

        return view('studio.index', compact('studio', 'search', 'filter'));
    }

    public function create()
    {
        $this->authorizeWriteAccess('studio');

        return view('studio.create');
    }

    public function store(StoreStudioRequest $request)
    {
        $this->authorizeWriteAccess('studio');

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('studio', 'public');
        }

        Studio::create($data);

        return redirect('/studio');
    }

    public function edit($id)
    {
        $this->authorizeWriteAccess('studio');

        $studio = Studio::findOrFail($id);

        return view('studio.edit', compact('studio'));
    }

    public function update(UpdateStudioRequest $request, $id)
    {
        $this->authorizeWriteAccess('studio');

        $studio = Studio::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($studio->foto) {
                Storage::disk('public')->delete($studio->foto);
            }
            $data['foto'] = $request->file('foto')->store('studio', 'public');
        }

        $studio->update($data);

        return redirect('/studio');
    }

    public function destroy($id)
    {
        $this->authorizeWriteAccess('studio');

        $studio = Studio::findOrFail($id);

        if ($studio->foto) {
            Storage::disk('public')->delete($studio->foto);
        }

        $studio->delete();

        return redirect('/studio');
    }


    public function exportExcel()
    {
        return Excel::download(
            new StudioExport,
            'studio.xlsx'
        );
    }
}