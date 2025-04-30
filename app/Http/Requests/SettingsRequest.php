<?php

namespace App\Http\Requests;

use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }
    public function rules(): array
    {
        return [
            'logo'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'home_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'home_title' => 'required|string|max:55',
            'home_text' => 'required|string|max:255',
            'aim_title' => 'required|string|max:55',
            'aim_text' => 'required|string|max:255',
            'aim_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'purpose_title' => 'required|string|max:55',
            'purpose_text' => 'required|string|max:255',
            'purpose_subheading' => 'required|string|max:55',
        ];
    }

    public function messages(){
        return[
          'logo.required'=>'logo alanı zorunludur',
            'home_image.required'=>'anasayfa görsel alanı zorunldur',
            'home_title.required'=>'anasayfa başlığı zorunludur',
            'home_text.required'=>'anasayfa text bölümü zorunludur',
            'aim_title.required'=>'hedefler başlığı zorunludur',
            'aim_text.required'=>'hedefler text bölümü zorunludur',
            'aim_image.required'=>'hedefler görsel alanı zorunldur',
            'purpose_title.required'=>'amaçlar başlığı zorunludur',
            'purpose_text.required'=>'amaçlar text bölümü zorunludur',
            'purpose_subheading.required'=>'amaçlar maddeleri zorunldur',
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
