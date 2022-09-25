<?php

namespace App\Http\Controllers;

use App\Enums\ClothingCategory;
use App\Http\Requests\StoreDressingRequest;
use App\Http\Requests\UpdateDressingRequest;
use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DressingController extends Controller
{
    public function index(): View
    {
        return view('dressing.index', [
            'dressings' => Dressing::all()
        ]);
    }

    public function create()
    {
        return view('dressing.create');
    }

    public function store(StoreDressingRequest $request)
    {
        $dressing = new Dressing;

        $dressing->name = request('name');

        $dressing->save();

        return redirect()->route('dressing.show', $dressing->id);
    }

    public function show(Dressing $dressing): View
    {
        return view('dressing.show', [
            'dressing' => $dressing,
            'categories' => ClothingCategory::list()
        ]);
    }

    public function edit(Dressing $dressing)
    {
        return view('dressing.edit',  [
            'dressing' => $dressing
        ]);
    }

    public function update(UpdateDressingRequest $request, Dressing $dressing)
    {
        $dressing->name = request('name');

        $dressing->save();

        return redirect()->route('dressing.show', $dressing->id);
    }

    public function destroy(Dressing $dressing): RedirectResponse
    {
        $dressing->delete();

        return redirect()->route('dressing.index');
    }
}
