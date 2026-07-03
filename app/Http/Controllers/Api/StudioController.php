<?php

namespace App\Http\Controllers\Api;

use App\Models\Studio;
use App\Http\Requests\StoreStudioRequest;
use App\Http\Requests\UpdateStudioRequest;
use App\Http\Resources\StudioResource;
use App\Http\Resources\StudioCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    public function index()
    {
        $studio = Studio::paginate(10);
        return new StudioCollection($studio);
    }

    public function store(StoreStudioRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('studio', 'public');
        }

        $studio = Studio::create($data);
        return new StudioResource($studio);
    }

    public function show(Studio $studio)
    {
        return new StudioResource($studio);
    }

    public function update(UpdateStudioRequest $request, Studio $studio)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($studio->foto) {
                Storage::disk('public')->delete($studio->foto);
            }
            $data['foto'] = $request->file('foto')->store('studio', 'public');
        }

        $studio->update($data);
        return new StudioResource($studio);
    }

    public function destroy(Studio $studio)
    {
        if ($studio->foto) {
            Storage::disk('public')->delete($studio->foto);
        }
        $studio->delete();
        return response()->json(['message' => 'Studio deleted successfully'], Response::HTTP_OK);
    }
}
