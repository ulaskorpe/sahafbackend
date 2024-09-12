<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HttpResponses; 
class UserProducts extends Controller
{
        use HttpResponses;


        public function my_products($selected=1){
            return view('front.partials.user_products.my_products',['selected'=>$selected]);
        }

        public function user_products($page=0){
 
            $per_page=10;
            $products = Product::orderBy('id','DESC');
            $page_count = ceil($products->count() / $per_page);
            $products = $products->offset(($page*$per_page))->limit($per_page)->get();
          //  return $bids;
          $bg="secondary";
          //  return $page."::".$product_id.":".$page_count."::".$bids->count();
          return view('front.partials.user_products.user_products',compact('products','page_count','page','bg'));
        }

        //user_products
}
