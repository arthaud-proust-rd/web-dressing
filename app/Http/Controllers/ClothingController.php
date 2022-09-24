<?php

namespace App\Http\Controllers;

use App\Enums\ClothingCategory;
use App\Http\Requests\StoreClothingRequest;
use App\Http\Requests\UpdateClothingRequest;
use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ClothingController extends Controller
{
    public function index(): View
    {
        return view('clothing.index', [
            'clothes' => Clothing::all()
        ]);
    }

    public function create(): View
    {
        return view('clothing.create', [
            'dressings' => Dressing::all(),
            'clothingCategories' => ClothingCategory::list()
        ]);
    }

    public function store(StoreClothingRequest $request): RedirectResponse
    {

        $clothing = new Clothing;
        $clothing->dressing_id = request('dressing_id');
        $clothing->name = request('name');
        $clothing->note = request('note');
        $clothing->category = request('category');

        $imageFront = $request->file('image_front');
        if($imageFront) {
            $clothing->image_front = $imageFront->store('clothing', 'public');
        }

        $imageBack = $request->file('image_back');
        if($imageBack) {
            $clothing->image_back = $imageBack->store('clothing', 'public');
        }

        $clothing->save();

        return redirect()->route('dressing.show', $clothing->dressing_id);
    }

    public function show(Clothing $clothing): View
    {
        return view('clothing.show', [
            'clothing' => $clothing,
        ]);
    }

    public function edit(Clothing $clothing): View
    {
        return view('clothing.edit', [
            'clothing' => $clothing,
            'dressings' => Dressing::all(),
            'clothingCategories' => ClothingCategory::list()
        ]);
    }

    public function update(UpdateClothingRequest $request, Clothing $clothing): RedirectResponse
    {
        $clothing->dressing_id = request('dressing_id');
        $clothing->name = request('name');
        $clothing->note = request('note');
        $clothing->category = request('category');

        $imageFront = $request->file('image_front');
        if($imageFront) {
            $clothing->image_front = $imageFront->store('clothing', 'public');
        }

        $imageBack = $request->file('image_back');
        if($imageBack) {
            $clothing->image_back = $imageBack->store('clothing', 'public');
        }

        $clothing->save();

        return redirect()->route('clothing.show', $clothing);
    }

    public function destroy(Clothing $clothing): RedirectResponse
    {
        $clothing->delete();

        return redirect()->route('dressing.show', $clothing->dressing_id);
    }
}
