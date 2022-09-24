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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clothing  $clothing
     * @return \Illuminate\Http\Response
     */
    public function show(Clothing $clothing)
    {
        return view('clothing.show', [
            'clothing' => $clothing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clothing  $clothing
     * @return \Illuminate\Http\Response
     */
    public function edit(Clothing $clothing)
    {
        return view('clothing.edit', [
            'clothing' => $clothing,
            'dressings' => Dressing::all(),
            'clothingCategories' => ClothingCategory::list()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClothingRequest  $request
     * @param  \App\Models\Clothing  $clothing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClothingRequest $request, Clothing $clothing)
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

        return redirect()->route('dressing.show', $clothing->dressing_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clothing  $clothing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clothing $clothing)
    {
        //
    }
}
