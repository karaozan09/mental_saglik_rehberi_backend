<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Settings;
use App\Models\SocialMedia;
use App\Models\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getSettings(){
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

    public function getStaff()
    {
        $staff = Staff::with('job')->get();

        return response()->json([
            'staff' => $staff
        ], 200);
    }

    public function getSocialMedia()
    {
        $social_media = SocialMedia::all();

        return response()->json([
            'social_media' => $social_media
        ], 200);
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
