<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException;
class BlogController extends Controller
{
    public function blog_detail($slug,$id){
        try {
            $blog = Blog::with('images','user' ,'category')->where('slug', $slug)->findOrFail($id);
            $title = $blog['title'];
            $cat_array = [];
            foreach($blog->category()->first()->parentTree() as $ca){
                $cat_array[]=['name'=>$ca['name'],'slug'=>$ca['slug']];
            }
        //    return view('front.blog_detail',compact('blog','cat_array','title'));
            return view('front.detail',compact('blog','cat_array','title'));
        } catch (ModelNotFoundException $e) {
            // Automatically return a 404 page
            //abort(404);
            return view('front.not_found');
        }
    }
}
