<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

   // protected $guard = 'admin';

    protected $table = 'users';
    protected $connection = 'mysql_admin';

    // protected $id = 'id';
    // protected $uuid = 'uuid';
    // protected $Type = 'Type';
    // protected $name = 'name';
    // protected $email = 'email';
    // protected $phone = 'phone';
    // protected $tc = 'tc';
    // protected $otp = 'otp';
    // protected $ott = 'ott';
    // protected $api_token = 'api_token';
    // protected $ip_address = 'ip_address';
    // protected $status = 'status';

    /*
                $table->uuid('uuid')->unique()->default(Str::uuid()); // UUID column
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->integer('admin_code')->unique();
            $table->integer('role_id')->default(1);
            $table->string('api_token')->nullable();
            $table->image('api_token')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
    */

    protected $fillable = [
        'uuid',
        'role_id',
        'admin_code',
        'name',
        'email',
        'password',
        'phone',
        'api_token',
        'ip_address',
        'status'
    ];

    protected $hidden = [
        'id','password'//,'otp','ott','api_token', 'ott_created_at', 'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed'
    ];


    // public function role(){
    //     return $this->belongsTo(AdminRole::class,'role_id');
    // }

}
