<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use app\models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        return view('settings.index', compact('settings'));

    }
    public function create(SettingsRequest $request){
        try{
            Settings::create([
                'id'=>$request->id,
                'logo'=>$request->logo,
                'home_image'=>$request->home_image,
                'home_title'=>$request->home_title,
                'home_text'=>$request->home_text,
                'aim_title'=>$request->aim_title,
                'aim_text'=>$request->aim_text,
                'aim_image'=>$request->aim_image,
                'purpose_image'=>$request->purpose_image,
                'purpose_title'=>$request->purpose_title,
                'purpose_subheading'=>$request->purpose_subheading,
            ]);
            return response()->json(['success'=>'ayarlar oluşturuldu'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function update(SettingsRequest $request){
        try{
            $settings = Settings::where('id',$request->id)->first();

            if($settings){
                $settings->id=$request->id;
                $settings->logo=$request->logo;
                $settings->home_image=$request->home_image;
                $settings->home_title=$request->home_title;
                $settings->home_text=$request->home_text;
                $settings->aim_title=$request->aim_title;
                $settings->aim_text=$request->aim_text;
                $settings->aim_image=$request->aim_image;
                $settings->purpose_image=$request->purpose_image;
                $settings->purpose_title=$request->purpose_title;
                $settings->purpose_subheading=$request->purpose_subheading;

                $settings->save();
                return response()->json(['success'=>'güncelleme başarılı'],200);
            }else{
                return response()->json(['errors'=>'ayarlar bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }


    }
    public function delete(Request $request){
        try{
            $settings=Settings::where('id',$request->id)->first();

            if($settings){
                $settings->delete();
                return response()->json(['success'=>'ayarlar silindi'],200);
            }else{
                return response()->json(['errors'=>'ayar bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getByDetail(Request $request){
        try{
            $settings=Settings::where('id',$request->id)->first();

            if($settings){
                return response()->json(['settings'=>$settings],200);
            }else{
                return response()->json(['errors'=>'Ayar bilgisi bulunamaadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getAll(){
        try{
            $settings=Settings::all();
                return response()->json(['settings'=>$settings],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
}
