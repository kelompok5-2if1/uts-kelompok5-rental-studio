<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studio;

class StudioController extends Controller
{
    public function index()
    {
        $studio = Studio::all();

        return view('studio.index', compact('studio'));
    }

    public function create()
    {
        return view('studio.create');
    }

    public function store(Request $request)
    {
        Studio::create($request->all());

        return redirect('/studio');
    }

    public function edit($id)
    {
        $studio = Studio::findOrFail($id);

        return view('studio.edit', compact('studio'));
    }

    public function update(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);

        $studio->update($request->all());

        return redirect('/studio');
    }

    public function destroy($id)
    {
        $studio = Studio::findOrFail($id);

        $studio->delete();

        return redirect('/studio');
    }
}