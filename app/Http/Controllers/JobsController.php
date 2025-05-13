<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobsRequest;
use App\Models\Jobs;
use Illuminate\Http\Request;


class JobsController extends Controller
{

    public function create(JobsRequest $request){
        try{
            Jobs::create([
                'name'=>$request->name,
            ]);
            return response()->json(['success'=>'Meslek başarıyla eklendi'],201);
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
                return response()->json(['success'=>'Meslek başarıyla güncellendi'],200);
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
