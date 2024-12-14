<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|string|max:15|unique:users,phone',
            'city'=>'required|string|max:255',
            'state'=>'required|string|max:255',
            'country'=>'required|string|max:255',
            'pincode'=>'required|string|max:6',
            'image'=>'required|image',
            'about'=>'nullable',
            'company'=>'nullable',
            'profession'=>'nullable',
            'address'=>'required|string|max:255',
            'password'=>'required|string|max:10',

        ];
    }
}
