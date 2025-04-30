<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use app\models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff=Staff::all();
        return view('staff.index', compact('staff'));

    }

    public function create(StaffRequest $request){
        try{
            Staff::create([
               'id'=>$request->id,
                'full_name'=>$request->full_name,
                'job_id'=>$request->job_id,
            ]);
            return response()->json(['success'=>'personel oluşturuldu'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }


    }
    public function update(StaffRequest $request){
        try{
            $staff=Staff::where('id',$request->id)->firs();

            if($staff){
                $staff->full_name=$request->full_name;
                $staff->save();
                return response()->json(['success'=>'güncelleme başarılı'],200);
            }else{
                return response()->json(['errors'=>'personel biglisi bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function delete(Request $request){
        try{
            $staff=Staff::where('id',$request->id)->first();
            if($staff){
                $staff->delete();
                return response()->json(['success'=>'personel silindi'],200);
            }else{
                return response()->json(['errors'=>'personel bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getByDetail(Request $request){
        try{
            $staff=Staff::where('id',$request->id)->first();
            if($staff){
                return response()->json(['success'=>$staff],200);
            }else{
                return response()->json(['errors'=>'personel bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getAll(Request $request){
        try{
            $staff=Staff::all();
            return response()->json(['success'=>$staff],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

}
