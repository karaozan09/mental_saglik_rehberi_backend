<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSettingsController extends Controller
{
    public function updateProfil(UpdateProfilRequest $request){
        try{
            $user = Auth::user();

            if ($request->hasFile('img')) {
                if ($user->img) {
                    $path = str_replace('storage/', 'public/', $user->img);
                    Storage::delete($path);
                }

                $file = $request->file('img');
                $fileName = 'user_photo' . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/user_photo', $fileName);

                $user->img = 'storage/user_photo/' . $fileName; // Yeni fotoğrafın yolunu kaydet
            }

            $user->full_name=$request->full_name;
            $user->email=$request->email;
            $user->phone_number=$request->phone_number;

            $user->save();
            return response()->json([
                'user' => $user,
            ], 200);

        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }

    }

    public function passwordChange(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::user();
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['errors' => ['password' => ['Eski şifre hatalı']]], 401);
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['success' => 'Şifre başarıyla değiştirildi'], 200);
        }catch (\Exception $e){
            User::logError(new User, $e,'updated');
            return response()->json(['error' => $e->getMessage()], 500);
        }



    }
}
