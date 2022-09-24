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
            'name' => ['required', 'string'],
            'note' => ['required', 'between:0,5'],
            'category' => ['required', Rule::in(ClothingCategory::list())]
        ];
    }
}
