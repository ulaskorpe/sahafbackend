<?php

namespace App\Http\Services;
use App\Models\Category;

class FrontEndServices
{
    public function getCategories()
    {
        return Category::with('subcategory')->where('parent_id','=',0)
        ->where('type','=','product')
        ->orderBy('rank')->get();
    }
}