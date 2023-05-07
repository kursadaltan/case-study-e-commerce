<?php

namespace App\Http\Requests\Products;

use App\Rules\PlatformFormatRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
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
            'platform' => ['required', 'string', 'in:cimri,google,facebook,n11'],
            //TODO: Tüm formatlar, her platform için geçerli olacak şekilde düzenlenebilir
            'format' => ['required', 'string', new PlatformFormatRule($this->platform)], 
            'category' => ['sometimes', 'string', 'exists:products,category'],
        ];
    }
}
