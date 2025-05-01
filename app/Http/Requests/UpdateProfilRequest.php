<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateProfilRequest extends FormRequest
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
        $userId = Auth::id();
        return [
            'full_name' => 'required',
            'phone_number' => 'required|string|regex:/^05\d{2}\s\d{3}\s\d{2}\s\d{2}$/', // Boşluklar zorunlu olacak
            'email' => "required|email|unique:users,email,{$userId}",
            'img' => "nullable|image|mimes:jpeg,png,jpg"
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Ad soyad alanı zorunludur.',

            'phone_number.required' => 'Telefon numarası zorunludur.',
            'phone_number.regex' => 'Örnek format : 5XX XXX XX XX',

            'email.required' => 'E-posta adresi zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',

            'img.image' => 'Yüklenen dosya bir resim olmalıdır.',
            'img.mimes' => 'Sadece JPEG, PNG, JPG formatları desteklenmektedir.',
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
