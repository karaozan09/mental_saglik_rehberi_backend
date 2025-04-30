<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialmediasRequest;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialmedias = SocialMedia::all();
        return view('socialmedias.index', compact('socialmedias'));

    }

    public function create(SocialmediasRequest $request){
        try{
            SocialMedia::create([
               'id'=>$request->id,
                'name'=>$request->name,
                'link'=>$request->link,
            ]);
            return response()->json(['success'=>'sosyal medya oluşturuldu'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function update(SocialmediasRequest $request){
        try{
            $socialmedias=SocialMedia::where('id',$request->id)->first();

            if($socialmedias){
                $socialmedias->name=$request->name;
                $socialmedias->link=$request->link;
                $socialmedias->save();
                return response()->json(['success'=>'sosyal medya güncellendi'],200);
            }else{
                return response()->json(['errors'=>'sosyal medya bulunamadı'],404);
            }

        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function delete(Request $request){
        try{
            $socialmedias=SocialMedia::where('id',$request->id)->first();

            if($socialmedias){
                $socialmedias->delete();
                return response()->json(['success'=>'sosyal medya silindi'],200);
            }else{
                return response()->json(['errors'=>'sosyal medya bulunamadı'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function getByDetail(Request $request){
        try{
            $socialmedias=SocialMedia::where('id', $request->id)->first();

            if($socialmedias){
                return response()->json(['social_media'=>$socialmedias],200);
            }else{
                return response()->json(['errors'=>'sosyal medya bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function getAll(){
        try{
            $socialmedias=SocialMedia::all();
            return response()->json(['social_medias'=>$socialmedias],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
}
