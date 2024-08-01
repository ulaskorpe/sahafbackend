<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Http\Services\FrontEndServices;
use App\Mail\ForgetPasswordMail;
use Illuminate\Http\Request;
//use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//use App\Models\Permission;
 
use Illuminate\Support\Facades\Mail;
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

    private function checkCookie(){
        if( Cookie::get('remember_me')){
             
            $user = User::where('remember_token', Cookie::get('remember_me'))->first();
       
            if ($user) {
            Auth::login($user);

                Session::put('user_code',$user['user_code']);
                return redirect('/');
            }
              
        }
    }

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
        $this->checkCookie();
        if(!empty(Session::get('user_code'))){
            return redirect(route('index'));
        }else{
           $data  =  $this->service->generateImage();
        return view('front.login_register',['action'=>'user_login',
        'todo'=>'Üye Giriş','products'=>$this->service->pick_items(),'img'=>$data['img'],'text'=>$data['text']]);
        }
    }

    public function register(){
        $this->checkCookie();
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

         
        $user = User::where('email', $request['username_or_email'])->where('user_code','>',0)->first();
           if(empty($user)){
            $user = User::where('username', $request['username_or_email'])->where('user_code','>',0)->first();
            if(empty($user)){
                $user = User::where('user_code', $request['username_or_email'])->where('user_code','>',0)->first();
               }
           }
       // $user = User::where('admin_code',$request->admin_code)->first();

       if ($user && Hash::check($request['password'], $user->password)) {
        Auth::attempt(['user_code' =>(integer)$user['user_code'], 'password' =>(string)$request->password]);
        Session::put('user_code',$user['user_code']);
        if(!empty($request['remember_me'])) {
                $rememberToken = Str::random(60); // Generate a random token
                 
                //  return Cookie::get('remember_me');

                $user->remember_token = $rememberToken;
                $user->save();

                Cookie::queue('remember_me', $rememberToken, 60*24*30);
               // $remember=$request['remember_me'];
            }

        return  $this->success(['user'=>Auth::user()],"Giriş Başarılı" ,200);

        
    } else {
        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

          
       

    }


    public function forget_pw_post(Request $request){
        // if(!Auth::attempt(['username' =>(string)$request->username_or_email, 'password' =>(string)$request->password])){
        //     if(!Auth::attempt(['email' =>(string)$request->username_or_email, 'password' =>(string)$request->password])){
        //         if(!Auth::attempt(['user_code' =>(integer)$request->username_or_email, 'password' =>(string)$request->password])){
        //             return $this->error('','böyle bir kullanıcı yok',200);
        //         }
        //     }
        // }
       
           // $user = User::where('email','=',$request['username_or_email'])
 
           $user = User::where('email', $request['username_or_email'])->first();
           if(empty($user)){
            $user = User::where('username', $request['username_or_email'])->first();
            if(empty($user)){
                $user = User::where('user_code', $request['username_or_email'])->first();
               }
           }
 

           if(!empty($user)){
            
            $pw = GeneralHelper::randomPassword(8,1);

            
            $user->password = Hash::make($pw);
            $user->save();


            Mail::to($user['email'])->send(new ForgetPasswordMail($user['name'],$pw));
            return  $this->success('',"Yeni Şifre ".$user['email']." adresinize gönderildi" ,200);
           }else{
            return $this->error('','böyle bir kullanıcı yok',200);
           }
        

    }
    public function confirm_user($token){
        $msg = "Böyle bir kullanıcı bulunamadı";
        $user = User::where('remember_token','=',$token)->first();
        if(!empty($user)){
            if(empty($user['email_verified_at'])){
                $msg = "Katılımınız için teşekkür ederiz, üyeliğiniz tamamlandı";
                $user->email_verified_at = now();
             
                $user->save();
               Auth::login($user);
                Session::put('user_code',$user['user_code']);
            }else{
                $msg = "Üyeliğiniz daha önce aktive edilmiş, lütfen giriş yapınız.";
            }
        }
        return view('front.confirm',['msg'=>$msg]);
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
        public function logout(Request $request){
            Cookie::queue('remember_me', '',0);
            Auth::logout();
            Session::forget('user_code');
            return redirect('/');
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
