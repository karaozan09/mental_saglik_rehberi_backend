<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(ContactRequest $request){
        try{
            Contact::create([
                'email'=>$request->email,
                'address'=>$request->address,
            ]);
            return response()->json(['success'=>'İletişim bilgileri oluşturuldu'],201);
        }catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
    public function update(ContactRequest $request){
        try{
            $contact = Contact::where('id',$request->id)->first();

            if($contact){
                $contact->email=$request->email;
                $contact->address=$request->address;
                $contact->save();

                return response()->json(['success'=>'iletişim bilgileri güncellendi'],200);
            }else{
                return response()->json(['errors'=>'iletişim bilgisi bulunamadı'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function delete(Request $request){
        try{
            $contact=Contact::where('id',$request->id)->first();

            if($contact){
                $contact->delete();
                return response()->json(['success','iletişim bilgisi silindi'],200);
            }else{
                return response()->json(['errors'=>'iletişim bilgisi bulunamdı'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }

    public function getByDetail(Request $request){
        try{
            $contact=Contact::where('id',$request->id)->first();
            if($contact){
                return response()->json(['contact'=>$contact],200);
            }else{
                return response()->json(['errors'=>'iletişim bilgisi bulunamadı'],404);
            }
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
    public function getAll(Request $request){
        try{
            $contact=Contact::all();
            return response()->json(['contact'=>$contact],200);
        }catch (\Exception $e){
            return response()->json(['errors'=>$e->getMessage()],500);
        }
    }
}
