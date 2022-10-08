<?php

namespace App\Http\Requests;

use App\Enums\ClothingCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClothingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'dressing_id' => ['required', 'exists:dressings,id'],
            'name' => ['nullable', 'string'],
            'note' => ['required', 'between:1,3'],
            'category' => ['required', Rule::in(ClothingCategory::associativeArray())],
            'weather_options.sunny' => ['nullable'],
            'weather_options.rainy' => ['nullable'],
            'weather_options.cold' => ['nullable'],
        ];
    }
}
