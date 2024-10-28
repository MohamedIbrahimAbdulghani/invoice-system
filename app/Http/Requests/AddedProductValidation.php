<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddedProductValidation extends FormRequest
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
            "product_name"=>"required||max:255",
            "description"=>"required",
            "section_id"=>"required",
        ];
    }
    public function Messages()
    {
        return [
            "product_name.required"=>"يرجي إدخال اسم المنتج ",
            "description.required"=>"يرجي إدخال الوصف",
            "section_id.required"=>" يرجي اختيار القسم ",
        ];
    }
}