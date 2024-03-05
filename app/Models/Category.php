<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'icon','description','rank','slug','parent_id'];

 
    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }
    
    public function images()
    {
        return $this->hasMany(\App\Models\CategoryImage::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }

}
