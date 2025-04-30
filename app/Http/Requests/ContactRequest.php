<?php

namespace App\Http\Requests;

use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email'=>'required|email',
            'address'=>'required|string',
        ];
    }
    public function messages(){
        return[
            'email.required'=>'email alanı zorunludur',
            'email.email'=>'Bu alan email formatında olmalıdır',
            'address.required'=>'adres alanı zorunludur',
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
