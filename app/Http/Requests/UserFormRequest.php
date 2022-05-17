<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return (bool)!Auth::check();
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ["required", "alpha"],
            'email' => ["required", "email", Rule::unique('users', 'email')],
            'password' => ["required", "min: 5"],
            'admin' => []
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide full name.',
            'name.alpha' => 'Name must be all alphabets.',

            'email.required' => 'Email not provided.',
            'email.email' => 'Email is not of valid structure.',
            'email.unique' => 'This email is already registered in our system.',

            'password.required' => 'Password is required.',
            'password.min' => 'Minimum Password length required is 5 characters.',
        ];
    }
}
