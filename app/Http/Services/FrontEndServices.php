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

    public function popularCategories(){
        $categories = Category::where('type', 'product')
        ->orderBy('product_count', 'DESC')
        ->limit(8)
        ->get();

    // Attach the parent tree to each category
    foreach ($categories as $category) {
        $category->parent_tree = $category->parentTree();
    }

    return $categories;
    }
}