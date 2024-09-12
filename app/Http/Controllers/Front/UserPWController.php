<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Traits\HttpResponses; 
use App\Models\User;
class UserPWController extends Controller
{


    use HttpResponses;

    public function check_old_pw($old_pw){
        // $user = Auth::user();
        // $user->password=Hash::make('123123');
        // $user->save();
        $user = User::where('user_code','=',Session::get('user_code'))->first();
        if(!Hash::check( $old_pw, $user['password'])){
            return response()->json('eski şifrenizi hatalı girdiniz');
        }

        return response()->json("ok");
    }


    public function password_post(Request $request){
        $user = User::where('user_code','=',Session::get('user_code'))->first();
        $user->password= Hash::make($request['password']);
  
        $user->save();
       
       return  $this->success([''],"Şifreniz güncellendi" ,200);
    }
}
