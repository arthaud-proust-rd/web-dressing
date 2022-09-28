<?php

namespace App\Http\Controllers;

use App\Enums\ClothingCategory;
use App\Enums\ClothingWeatherOptions;
use App\Http\Requests\StoreClothingRequest;
use App\Http\Requests\UpdateClothingRequest;
use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Helpers\OptimizedImage;

class ClothingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Clothing::class, 'clothing');
    }

    public function index(): View
    {
        return view('clothing.index', [
            'clothes' => Clothing::all()
        ]);
    }

    public function create(?Dressing $dressing): View
    {
        return view('clothing.create', [
            'selectedDressing' => $dressing,
            'dressings' => Auth::user()->dressings,
            'clothingCategories' => ClothingCategory::list(),
            'clothingWeatherOptions' => ClothingWeatherOptions::list(),
        ]);
    }

    public function store(StoreClothingRequest $request): RedirectResponse
    {
        $clothing = new Clothing;
        $clothing->dressing_id = request('dressing_id');
        $clothing->name = request('name');
        $clothing->note = request('note');
        $clothing->category = request('category');
        $clothing->image_front = OptimizedImage::getPath($request->file('image_front'));
        $clothing->image_back = OptimizedImage::getPath($request->file('image_back'));

        $weatherOptions = [];
        foreach (ClothingWeatherOptions::values() as $option) {
            $weatherOptions[$option] = $request->has('weather_options.'.$option);
        }
        $clothing->weather_options = $weatherOptions;

        $clothing->save();

        session()->flash('status', 'Vêtement ajouté');

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
            'dressings' => Auth::user()->dressings,
            'clothingCategories' => ClothingCategory::list(),
            'clothingWeatherOptions' => ClothingWeatherOptions::list(),
        ]);
    }

    public function update(UpdateClothingRequest $request, Clothing $clothing): RedirectResponse
    {
        $clothing->dressing_id = request('dressing_id');
        $clothing->name = request('name');
        $clothing->note = request('note');
        $clothing->category = request('category');

        if($request->has('image_front')) {
            $clothing->image_front = OptimizedImage::getPath($request->file('image_front'));
        }

        if($request->has('image_front')) {
            $clothing->image_back = OptimizedImage::getPath($request->file('image_back'));
        }

        $weatherOptions = [];
        foreach (ClothingWeatherOptions::values() as $option) {
            $weatherOptions[$option] = $request->has('weather_options.'.$option);
        }
        $clothing->weather_options = $weatherOptions;

        $clothing->save();

        session()->flash('status', 'Vêtement modifié');

        return redirect()->route('dressing.show', request('dressing_id'));
    }

    public function destroy(Request $request, Clothing $clothing): RedirectResponse
    {
        $clothing->delete();

        session()->flash('status', 'Vêtement supprimé');

        return redirect()->route('dressing.show', $clothing->dressing_id);
    }
}
