<?php

namespace App\Http\Services;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\CapthaTrait;

class FrontEndServices
{

    use CapthaTrait;
    public function getCategories()
    {

        
        return Category::with('subcategory')->where('parent_id','=',0)
        ->where('type','=','product')
        ->orderBy('rank')->get();
    }

    public function popularCategories(){
        $categories = Category::where('type', 'product')
        ->where('product_count','>',0)
        ->orderBy('product_count', 'DESC')
        ->limit(8)
        ->get();

    // Attach the parent tree to each category
    foreach ($categories as $category) {
        $category->parent_tree = $category->parentTree();
    }

    return $categories;
    }

    public function pick_items($count = 4){
        return Product::whereNotNull('verified')->inRandomOrder()->take($count)->get();
    }

    public function generateUserCode(){
        $ch=true;
        while($ch){
            $token = rand(100000,999999);
            $user = User::where('user_code','=',$token)->first();
            $ch = (!empty($user))?true:false;
        }
        return $token;
    }
    

}