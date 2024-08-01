<?php

use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::middleware(['frontenddata'])->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('index');
    Route::get('/blog/{slug}/{id}',[HomeController::class, 'blog_detail']);
    Route::get('/giris',[UserController::class, 'login'])->name('user-login');
    Route::get('/sifremi-unuttum',[UserController::class, 'forget_password'])->name('user-forget-pw');
    Route::get('/kayit-ol',[UserController::class, 'register'])->name('user-register');
    Route::get('/all-blog/{key?}/{page?}',[HomeController::class, 'blogs']);
    Route::get('/product/{slug}/{id}',[HomeController::class, 'product_detail']);
    Route::get('/category/{slug}/{id}',[HomeController::class, 'category_detail']) ;
    Route::get('/confirm/{token}',[UserController::class, 'confirm_user'])->name('confirm_user');
    Route::get('/urun-detay/{slug}',[ProductController::class, 'product_detail'])->name('product_detail');
    Route::get('/urun-detay/{slug}',[BlogController::class, 'blog_detail'])->name('blog_detail');
    Route::get('/sss',[HomeController::class, 'faqs'])->name('sss');
    
    Route::get('/hakkimizda',[HomeController::class, 'about'])->name('about-us');
    Route::get('/yardim',[HomeController::class, 'help'])->name('help-me');
    Route::get('/iletisim',[ContactController::class, 'contact'])->name('contact');
    Route::post('/iletisim-post',[ContactController::class, 'contact_post'])->name('contact_post');



});

Route::get('/faqin/{key?}',[HomeController::class, 'faqin'])->name('faqin');

Route::get('/check-email/{email}',[UserController::class, 'email_check'])->name('email-user-check');
Route::get('/check-username/{username}',[UserController::class, 'username_check'])->name('username-check');
Route::get('/check-phone/{phone_number}',[UserController::class, 'phone_check'])->name('phone-check');
Route::post('/register_user',[UserController::class, 'register_user'])->name('register_user');
Route::post('/login_user',[UserController::class, 'login_user'])->name('login_user');
Route::post('/logout_user',[UserController::class, 'logout'])->name('logout_user');
Route::post('/forget-pw-post',[UserController::class, 'forget_pw_post'])->name('forget_pw_post');
Route::get('/fetch-page/{page_id}',[HomeController::class, 'fetch_page'])->name('fetch-page');
