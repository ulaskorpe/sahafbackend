<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['title', 'icon','description','prologue','slug','category_id','user_id','youtube_link','verified','verified_by'];

  
    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function verified_by()
    {
        return $this->belongsTo(\App\Models\User::class, 'verified_by');
    }
}
