<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|unique:users|email',
            'username' => 'required|unique:users|unique:admins|min:8|max: 255',
            'profile_picture' => 'image|mimes:jpg,png,jpeg',
            'password' => 'required|string|confirmed'
        ];
    }
}
