<?php

namespace App\Http\Controllers;

use App\Enums\ClothingCategory;
use App\Enums\ClothingWeatherOptions;
use App\Http\Requests\StoreClothingRequest;
use App\Http\Requests\UpdateClothingRequest;
use App\Models\Clothing;
use App\Models\Dressing;
use App\Services\ClothingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

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

    public function create(?Dressing $dressing): Response
    {
        return Inertia::render('Clothing/CreateOrEdit', [
            'selectedDressing' => $dressing,
            'dressings' => Auth::user()->dressings,
            'clothingCategories' => ClothingCategory::array(),
            'clothingWeatherOptions' => ClothingWeatherOptions::array(),
        ]);
    }

    public function store(StoreClothingRequest $request): RedirectResponse
    {
        $clothingService = ClothingService::fromEmpty()
            ->setDressingId($request->dressing_id)
            ->setName($request->name)
            ->setCategory($request->category)
            ->setNote($request->note)
            ->setWeatherOptionsFromAssociative($request->weather_options);

        if ($request->image_front) {
            $clothingService->setImageFront($request->image_front);
        }
        if ($request->image_back) {
            $clothingService->setImageFront($request->image_back);
        }

//        $weatherOptions = [];
//        foreach (ClothingWeatherOptions::values() as $option) {
//            $weatherOptions[$option] = $request->has('weather_options.' . $option);
//        }
//        $clothing->weather_options = $weatherOptions;

        $clothingService->save();

        session()->flash('status', 'Vêtement ajouté');

        return redirect()->route('dressing.show', $clothingService->getInstance()->dressing_id);
    }

    public function show(Clothing $clothing): Response
    {
        return Inertia::render('Clothing/Show', [
            'clothing' => $clothing,
        ]);
    }

    public function edit(Clothing $clothing): Response
    {
        return Inertia::render('Clothing/CreateOrEdit', [
            'clothing' => $clothing,
            'dressings' => Auth::user()->dressings,
            'clothingCategories' => ClothingCategory::array(),
            'clothingWeatherOptions' => ClothingWeatherOptions::array(),
        ]);
    }

    public function update(UpdateClothingRequest $request, Clothing $clothing): RedirectResponse
    {
        $clothingService = (new ClothingService($clothing))
            ->setDressingId($request->dressing_id)
            ->setName($request->name)
            ->setCategory($request->category)
            ->setNote($request->note)
            ->setWeatherOptionsFromAssociative($request->weather_options);

        if ($request->image_front) {
            $clothingService->setImageFront($request->image_front);
        }
        if ($request->image_back) {
            $clothingService->setImageFront($request->image_back);
        }

        $clothingService->save();

        session()->flash('status', 'Vêtement modifié');

        return redirect()->route('dressing.show', $request->dressing_id);
    }

    public function destroy(Request $request, Clothing $clothing): RedirectResponse
    {
        $clothing->delete();

        session()->flash('status', 'Vêtement supprimé');

        return redirect()->route('dressing.show', $clothing->dressing_id);
    }
}
