<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\FrontEndServices;
use Illuminate\Http\Request;
//use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use App\Models\Permission;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{



    private $service ;
    public function __construct(FrontEndServices $service){
        $this->service =  $service;
    }

    use HttpResponses;

    public function forget_password(){
        if(!empty(Session::get('user_code'))){
            return redirect(route('index'));
        }else{
           $data  =  $this->service->generateImage();
        return view('front.login_register',['action'=>'forget_pw',
            'todo'=>'Şifremi Unuttum'
        ,'products'=>$this->service->pick_items(),'img'=>$data['img'],'text'=>$data['text']]);
        }
    }
    public function login(){
        if(!empty(Session::get('user_code'))){
            return redirect(route('index'));
        }else{
           $data  =  $this->service->generateImage();
        return view('front.login_register',['action'=>'user_login',
        'todo'=>'Üye Giriş','products'=>$this->service->pick_items(),'img'=>$data['img'],'text'=>$data['text']]);
        }
    }

    public function register(){

        if(!empty(Session::get('user_code'))){
        
            return redirect(route('index'));
        }else{
            $data  =  $this->service->generateImage();
            return view('front.login_register',['action'=>'user_register'
            
            ,'todo'=>'Üye Kayıt'
            ,'products'=>$this->service->pick_items(),'img'=>$data['img'],'text'=>$data['text']]);
        }
       
    }

    public function register_user(Request $request){
 
        try{
           
        
           
           $user = User::create([
                'name'=>$request->name,
                'username'=>$request->username,
                'phone_number'=>(!empty($request->phone_number))?$request->phone_number:'',
                'email'=>$request->email,
                'password'=> Hash::make($request->password),
                'remember_token' => Str::random(20).rand(1000,5000),
                'user_code'=>$this->service->generateUserCode()
        ]);

            return  $this->success([''],"Kaydınız tamamlandı lütfen eposta kutunuzu kontrol ediniz" ,201);
        }catch (Exception $e){
           // return response()->json(['error' => $e->getMessage()], 500);
            return  $this->error([''], $e->getMessage() ,500);
        } 
    }

    public function login_user(Request $request){
        if(!Auth::attempt(['admin_code' =>(integer)$request->admin_code, 'password' =>(string)$request->password])){
            return $this->error('','no such admin',200);
        }
        $remember=0;
        $user = User::where('admin_code',$request->admin_code)->first();
 
        Session::put('admin_code',$user['admin_code']);
        if(!empty($request['remember_me'])) {
                $rememberToken = Str::random(60); // Generate a random token
                  Cookie::queue('remember_me', $rememberToken, 60*24*30);
                $user->remember_token = $rememberToken;
                $user->save();
               // $remember=$request['remember_me'];
            }
        return  $this->success(['user'=>Auth::user(),'token'=>$this->createToken($user)],"Giriş Başarılı" ,200);

    }
    public function confirm_user($token){
        return $token;
    }

    public function email_check($email){
            $err = "ok";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "Geçersiz eposta adresi";
            }else{
                $user = User::where('email','=',$email)->first();
                $err = (!empty($user))?"Bu eposta ile başka bir kullanıcı kayıtlı":"ok";
            }
    
    
            return response()->json($err);
    
        }

        public function username_check($username){
            $err = "ok";
            if (strlen($username)<6) {
            $err = "kullanıcı adınız 6 karakterden az olmamalıdır";
            }else{
                $user = User::where('username','=',$username)->first();
                $err = (!empty($user))?"Bu kullanıcı adı ile başka bir kullanıcı kayıtlı":"ok";
            }
    
    
            return response()->json($err);
    
        }

        public function phone_check($phone_number){
         
            $err = "ok";
            if (!is_int(intval($phone_number)) || ($phone_number < 5000000000 || $phone_number>5999999999)) {
            $err = "Lütfen geçerli bir telefon numarası giriniz ";
            
            }
 
                return response()->json($err);
    
        }


   
         
    
      
}
