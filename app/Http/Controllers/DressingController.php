<?php

namespace App\Http\Controllers;

use App\Enums\ClothingCategory;
use App\Http\Requests\StoreDressingRequest;
use App\Http\Requests\UpdateDressingRequest;
use App\Models\City;
use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DressingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Dressing::class, 'dressing');
    }
    public function index(): Response
    {
        return Inertia::render('Dressing/Index', [
            'dressings' => Auth::user()->dressings->toArray()
        ]);
    }

    public function create()
    {
        return Inertia::render('Dressing/CreateOrEdit', [
            'cities' => City::all(),
        ]);
    }

    public function store(StoreDressingRequest $request)
    {
        $dressing = new Dressing;

        $dressing->name = request('name');
        $dressing->city_id = request('city_id');
        $dressing->user_id = $request->user()->id;

        $dressing->save();

        session()->flash('status', 'Dressing ajouté');

        return redirect()->route('dressing.show', $dressing->id);
    }

    public function show(Dressing $dressing): Response
    {
        return Inertia::render('Dressing/Show', [
            'dressing' => $dressing,
            'categories' => ClothingCategory::list()
        ]);
    }

    public function edit(Dressing $dressing)
    {
        return Inertia::render('Dressing/CreateOrEdit', [
            'dressing' => $dressing,
            'cities' => City::all(),
        ]);
    }

    public function update(UpdateDressingRequest $request, Dressing $dressing)
    {
        $dressing->name = request('name');
        $dressing->city_id = request('city_id');

        $dressing->save();

        session()->flash('status', 'Dressing modifié');

        return redirect()->route('dressing.show', $dressing->id);
    }

    public function destroy(Dressing $dressing): RedirectResponse
    {
        $dressing->delete();

        session()->flash('status', 'Dressing supprimé');

        return redirect()->route('dressing.index');
    }
}
