<?php

namespace App\Http\Requests;

use App\Helper\UserHelper;
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
        return (bool)UserHelper::isUserAdmin();
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

    // Custom message when validation fails
    public function messages()
    {
        return [
            'model.required'    => 'TV model is required and must be specified.',

            'price.required'    => 'Price is a required field and must be numeric.',
            'price.numeric'     => 'Price must be numeric in value.',

            'path.required'     => 'Valid Image file must be uploaded.',
            'path.image'        => 'File provided is not of Image type.'
        ];
    }
}
