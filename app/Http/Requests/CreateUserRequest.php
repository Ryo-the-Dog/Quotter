<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'title_img' => 'nullable|file|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phrase' => 'required|string|max:100',
//            'tag_ids[]' => 'required',
            'tag_ids[].*' => 'integer',
            'detail' => 'nullable|string|max:200',
        ];
    }
}
