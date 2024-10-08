<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatedSectionValidation extends FormRequest
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
            "section_name"=>"required|unique:sections|max:255",
            "description"=>"required",
        ];
    
    }


    public function Messages()
    {
        return [
            "section_name.required"=>"يرجي إدخال اسم القسم ",
            "section_name.unique"=>" اسم القسم مسجل مسبقآ ",
            "description.required"=>"يرجي إدخال الوصف",
        ];
    }
}