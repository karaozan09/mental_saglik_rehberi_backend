<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create(UserRequest $request)
    {
       try{
           User::create([
               'full_name'=>$request->full_name,
               'email'=>$request->email,
               'password'=>Hash::make($request->password),
               'phone_number'=>$request->phone_number,

           ]);
           return response()->json(['success'=>'Kullanıcı oluşturuldu'],201);
       }catch (\Exception $e){
           return response()->json(['errors'=>$e->getMessage()],500);
       }
    }
    public function update(UserRequest $request){
        try{
            $user=User::where('id',$request->id)->first();

            if($user){
                $user->full_name=$request->full_name;
                $user->email=$request->email;
                $user->phone_number=$request->phone_number;

                $user->save();
                return response()->json(['success'=>'güncelleme başarılı'],200);
            }else{
                return response()->json(['errors'=>'kullanıcı bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }

    }

    public function delete(Request $request){
        try{
            $user = User::where('id',$request->id)->first();

            if($user){
                $user->delete();
                return response()->json(['success'=>'kullanıcı silindi'],200);
            }else{
                return response()->json(['errors'=>'kullanıcı bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getByDetail(Request $request){
        try{
            $user = User::where('id',$request->id)->first();
            if($user){
                return response()->json(['user'=>$user],200);
            }else{
                return response()->json(['errors'=>'kullanıcı bulunamadı'],404);
            }
        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getAll(Request $request){
        try{
            $user = User::all();
            return response()->json(['user'=>$user],200);
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
}
