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
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'phone_number' => 'required|max:14',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'İsim soyisim alanı zorunludur.',
            'email.required' => 'Email alanı zorunludur.',
            'email.unique' => 'Bu email zaten kayıtlı.',
            'email.email' => 'Geçerli bir email adresi giriniz.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.min' => 'Şifre en az 6 karaterden oluşmaldır.',
            'password.confirmed' => 'Şifre ve şifre tekrarı uyuşmuyor.',
            'password_confirmation.required' => 'Şifre tekrarı alanı zorunludur.',
            'phone_number.required' => 'Telefon alanı zorunludur.',
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
