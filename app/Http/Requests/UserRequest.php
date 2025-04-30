<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
            'phone_number' => 'nullable|string|max:14',

        ];
    }
    public function messages()
    {
       return [
            'full_name.required' => 'isim soyisim alanı zorunludur',
            'email.required'=>'email alanı zorunldur',
            'email.unique'=> 'bu email zaten kayıtlı',
            'password.required'=> 'şifre alanı zorunludur',
       ];
        }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}
