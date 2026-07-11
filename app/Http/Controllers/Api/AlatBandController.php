<?php

namespace App\Http\Controllers\Api;

use App\Models\AlatBand;
use App\Http\Requests\StoreAlatBandRequest;
use App\Http\Requests\UpdateAlatBandRequest;
use App\Http\Resources\AlatBandResource;
use App\Http\Resources\AlatBandCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AlatBandController extends Controller
{
    public function index()
    {
        $alatBand = AlatBand::with('kategori')->paginate(10);
        return new AlatBandCollection($alatBand);
    }

    public function store(StoreAlatBandRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alat-band', 'public');
        }

        $alatBand = AlatBand::create($data);
        return (new AlatBandResource($alatBand->load('kategori')))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AlatBand $alatBand)
    {
        return new AlatBandResource($alatBand->load('kategori'));
    }

    public function update(UpdateAlatBandRequest $request, AlatBand $alatBand)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($alatBand->foto) {
                Storage::disk('public')->delete($alatBand->foto);
            }
            $data['foto'] = $request->file('foto')->store('alat-band', 'public');
        }

        $alatBand->update($data);
        return new AlatBandResource($alatBand->load('kategori'));
    }

    public function destroy(AlatBand $alatBand)
    {
        if ($alatBand->foto) {
            Storage::disk('public')->delete($alatBand->foto);
        }
        $alatBand->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
