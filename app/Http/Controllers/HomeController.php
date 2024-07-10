<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Mail\ProductUpdatedMail;
use App\Mail\UserCreatedEmail;
use App\Traits\HttpResponses;
class HomeController extends Controller
{

    use HttpResponses;
    public function index(){
         //Mail::to('ulas@asd.com')->send(new ProductUpdatedMail('this is your life','ürününüz eklendi'));
        //Mail::to('ulas@asdf.com')->send(new UserCreatedEmail('ulaş','13213546','134132'));
        return view('front.index' );
        
           /// return response()->redirectTo('/login');
    }

    public function category($slug){
        return $slug;
    }

    public function remember_me(){
        return view('admin.call_me');
    }

    public function test(Request $request){
        return response()->json(["ok"],200);
    }

    private function createToken(User $user){
        $token = $user->createToken('API Token of'.$user->name)->plainTextToken;
        Session::put('token',$token);
        return $token;
    }

    public function login_post(Request $request){
        return json_encode([ $request ]);
      //  return response()->json("ok");
        //Log::channel('data_check')->info($request->admin_code);
        if(!Auth::attempt(['admin_code' => $request->admin_code, 'password' => $request->password])){
            return $this->error('','no such admin',401);
        }
            
        $user = User::where('admin_code',$request->admin_code)->first();
       
      return  $this->success(['user'=>$user,'token'=>$this->createToken($user)]);
    }

}
