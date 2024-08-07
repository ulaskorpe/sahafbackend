<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'permissions';
    protected $fillable = [
        'name','slug'
        
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permission')->withPivot('value');;
    }
}
