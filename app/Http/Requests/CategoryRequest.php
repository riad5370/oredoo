<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|unique:categories',
            'image'=>'required|file|max:512|mimes:jpg,bmp,png'
        ];
    }
    public function messages()
    {
        return[
            'image.mimes'=>'file type not allow your allow type is jpg,bmp,png'
        ];
    }
}
