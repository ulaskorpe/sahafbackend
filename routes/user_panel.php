<?php

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
});



Route::get('/check-email/{email}',[UserController::class, 'email_check'])->name('email-user-check');
Route::get('/check-username/{username}',[UserController::class, 'username_check'])->name('username-check');
Route::get('/check-phone/{phone_number}',[UserController::class, 'phone_check'])->name('phone-check');
Route::post('/register_user',[UserController::class, 'register_user'])->name('register_user');
Route::post('/login_user',[UserController::class, 'login_user'])->name('login_user');
Route::post('/forget-pw-pst',[UserController::class, 'forget_pw_post'])->name('forget_pw_post');
Route::get('/fetch-page/{page_id}',[HomeController::class, 'fetch_page'])->name('fetch-page');
Route::get('/confirm/{token}',[UserController::class, 'confirm_user'])->name('confirm_user');