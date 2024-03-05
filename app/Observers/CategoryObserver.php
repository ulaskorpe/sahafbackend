<?php

namespace App\Observers;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
class CategoryObserver
{
   public function created(Category $category){
    Category::where('rank', '>=', $category['rank'])
    ->where('id', '!=', $category['id'])
    ->where('parent_id', '=', $category['parent_id'])
    ->increment('rank', 1);

   // Log::channel('data_check')->info($category->name);
   }

   public function updated(Category $category){
        if($category->isDirty('parent_id')){
      
            Category::where('rank', '>=', $category['rank'])
            ->where('id', '!=', $category['id'])
            ->where('parent_id', '=', $category['parent_id'])
            ->increment('rank', 1);

            Category::where('rank', '>=', $category['rank'])
            ->where('id', '!=', $category['id'])
            ->where('parent_id', '=', $category->getOriginal('parent_id'))
            ->decrement('rank', 1);
        }else{

        }
   }
}
