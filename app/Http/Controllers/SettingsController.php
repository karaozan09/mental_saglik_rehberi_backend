<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Models\Contact;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function logo(Request $request){
        try{
            $settings = Settings::first() ?? new Settings();
            if ($request->hasFile('logo')) {
                // Eski resmi sil
                if ($settings->logo) {
                    $oldPath = str_replace('storage/', 'public/', $settings->logo);
                    Storage::delete($oldPath);
                }

                // Yeni resmi yükle
                $file = $request->file('logo');
                $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/logo', $fileName);

                $settings->logo = 'storage/logo/' . $fileName;
            }
            $settings->save();
            return response()->json(['success'=>'Başarıyla güncellendi'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function homeProcess(Request $request)
    {
        try {
            $settings = Settings::first() ?? new Settings();
            // Resim alanları
            $imageFields = [
                'aim_img' => 'aim_img',
                'purpose_img' => 'purpose_img',
                'home_img' => 'home_img',
            ];

            foreach ($imageFields as $field => $folder) {
                if ($request->hasFile($field)) {
                    // Eski resmi sil
                    if (!empty($settings->{$field})) {
                        $oldPath = str_replace('storage/', 'public/', $settings->{$field});
                        Storage::delete($oldPath);
                    }

                    // Yeni resmi yükle
                    $file = $request->file($field);
                    $fileName = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs("public/{$folder}", $fileName);
                    $settings->{$field} = "storage/{$folder}/{$fileName}";
                }
            }

            // Metin alanları
            $textFields = [
                'home_title', 'home_text', 'aim_title', 'aim_text',
                'purpose_title', 'purpose_subheading_1', 'purpose_subheading_2',
                'purpose_subheading_3', 'purpose_subheading_4'
            ];

            foreach ($textFields as $field) {
                if ($request->has($field)) {
                    $settings->{$field} = $request->input($field);
                }
            }

            $settings->save();
            return response()->json(['success' => 'Başarıyla güncellendi'], 201);

        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }

    public function contact(Request $request){
        try{
            $contact = Contact::first() ?? new Contact();

            $fields = [
                'phone_number_1', 'phone_number_2',
                'email_1', 'email_2',
                'address_1', 'address_2'
            ];

            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $contact->{$field} = $request->input($field);
                }
            }
            $contact->save();

            return response()->json(['success'=>'Başarıyla güncellendi'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function contactEmail(Request $request){
        try{
            $contact = Contact::first() ?? new Contact();

            if($request->contact_email){
                $contact->contact_email = $request->contact_email;
                $contact->save();
            }

            return response()->json(['success'=>'Başarıyla güncellendi'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function mapLocation(Request $request){
        try{
            $contact = Contact::first() ?? new Contact();

            if($request->coordinates){
                $contact->coordinates = $request->coordinates;
            }
            $contact->save();

            return response()->json(['success'=>'Başarıyla güncellendi'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function footer(Request $request){
        try{
            $settings = Settings::first() ?? new Settings();

            $fields = [
                'footer_top_title', 'footer_top_text',
                'footer_bottom_text'
            ];

            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $settings->{$field} = $request->input($field);
                }
            }

            $settings->save();

            return response()->json(['success'=>'Başarıyla güncellendi'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function getAll(){
        try{
            $settings = Settings::first() ?? new Settings();
            $contact = Contact::first() ?? new Contact();

            if (!$settings->exists) {
                $settings->save();
            }
            if (!$contact->exists) {
                $contact->save();
            }

                return response()->json(['settings'=>$settings,'contact' => $contact],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getLogo()
    {
        $settings = Settings::first() ?? new Settings();

        if (!$settings->exists) {
            $settings->save();
        }

        return response()->json([
            'logo' => $settings->logo
        ], 200);
    }
}
