<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TVFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isUserAdmin() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'model' => ["required"],
            'price' => ["required", "numeric"],
            'path'  => ["required", "image"]
        ];
    }
}
