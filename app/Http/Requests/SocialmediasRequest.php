<?php

namespace App\Http\Requests;

use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialmediasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ];
    }
    public function messages(){
        return[
            'name.required'=>'platform isim alanı zorunludur',
            'link.required'=>'platform linki zorunludur',
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
