<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsRequest;
use app\models\jobs;
use Illuminate\Http\Request;


class JobsController extends Controller
{

    public function create(JobsRequest $request){
        try{
            Jobs::create([
                'id'=>$request->id,
                'name'=>$request->name,
            ]);
            return response()->json(['success'=>'iş başarıyla oluşturuldu'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);

        }
    }
    public function update(JobsRequest $request){
        try{
            $jobs=Jobs::where('id', $request->id)->first();
            if($jobs){
                $jobs->name=$request->name;
                $jobs->save();
                return response()->json(['success'=>'iş bilgisi güncellendi'],200);
            }else{
                return response()->json(['errors'=>'iş bilgisi bulunamadı'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }

    }
    public function delete(Request $request){
        try{
            $jobs=Jobs::where('id',$request->id)->first();

            if($jobs){
                $jobs->delete();
                return response()->json(['success'=>'iş silindi'],200);
            }else{
                return response()->json(['errors'=>'iş  silinemedi'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getByDetail(Request $request){
        try{
            $jobs=Jobs::where('id',$request->id)->first();

            if($jobs){
                return response()->json(['jobs'=>$jobs],200);
            }else{
                return response()->json(['errors'=>'iş bilgisi bulunamadı'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getAll(Request $request){
        try{
            $jobs=Jobs::all();
            return response()->json(['jobs'=>$jobs],200);
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
}
