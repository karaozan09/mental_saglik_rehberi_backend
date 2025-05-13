<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function create(StaffRequest $request){
        try{
            $staff = new Staff();
            if ($request->hasFile('img')) {

                $file = $request->file('img');
                $fileName = 'staff_photo' . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/staff', $fileName);

                $staff->img = 'storage/staff/' . $fileName;
            }

            $staff->full_name =$request->full_name;
            $staff->job_id = $request->job_id;
            $staff->save();

            return response()->json(['success'=>'Personel oluşturuldu'],201);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }


    }
    public function update(StaffRequest $request)
    {
        try {
            $staff = Staff::where('id', $request->id)->first(); // yazım düzeltildi

            if ($staff) {
                $staff->full_name = $request->full_name;
                $staff->job_id = $request->job_id;

                if ($request->hasFile('img')) {
                    // Eski resmi sil
                    if ($staff->img) {
                        $oldPath = str_replace('storage/', 'public/', $staff->img);
                        Storage::delete($oldPath);
                    }

                    // Yeni resmi yükle
                    $file = $request->file('img');
                    $fileName = 'staff_photo_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/staff', $fileName);

                    $staff->img = 'storage/staff/' . $fileName;
                }

                $staff->save();

                return response()->json(['success' => 'Güncelleme başarılı'], 200);
            } else {
                return response()->json(['errors' => 'Personel bilgisi bulunamadı'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
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
            $staff=Staff::where('id',$request->id)->with('job')->first();
            if($staff){
                return response()->json(['staff'=>$staff],200);
            }else{
                return response()->json(['errors'=>'personel bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getAll(Request $request){
        try{
            $staff = Staff::with('job')->get();
            return response()->json(['staff'=>$staff],200);
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

}
