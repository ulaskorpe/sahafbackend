<?php

namespace App\Http\Controllers;

use App\Models\CategoryImage;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Helpers\GeneralHelper;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Jobs\UploadFilesJob;

use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    use HttpResponses;
    private function getCategories($parent_id=0){
        $cats =   Category::where('parent_id','=',$parent_id)->orderBy('rank', 'ASC') ;
        return  ['data'=>$cats->get(),'count'=>$cats->count()];
    }

    public function index()
    {
        $cats = $this->getCategories(0);
       
        return view('admin.panel.categories.index',['categories'=>$cats['data'],'count'=>$cats['count']]);
    }

    public function create()
    {
        $cats = $this->getCategories(0);
        
        
        return view('admin.panel.categories.create',['categories'=>$cats['data'],'count'=>$cats['count']]);
    }

    
    public function store(Request $request)
    {
        try {
        $icon = "";
            $file = $request->file('icon');
            if (!empty($file)) {
                $ext = GeneralHelper::findExtension($file->getClientOriginalName());
                if (in_array($ext, $this->allowed_array)) {
                $path = public_path("files/categories/" . $request['slug']);
                $filename = GeneralHelper::fixName($request['name']) . "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
                $file->move($path, $filename);
               
                $path = public_path("files/categories/" . $request['slug'] . "/" . $filename);


               $resizedImage = Image::make($path)->resize(100, null, function ($constraint) {
                   $constraint->aspectRatio();
               });


                $resizedImage->save(public_path("files/categories/" . $request['slug'] . "/100".$filename));
               $icon ="100".$filename;

               }

        }
        
        
        $category= Category::create([
            'name'=>$request['name'],
            'slug'=>$request['slug'],
            'icon'=>$icon,
            'description'=>$request['description'],
            'parent_id'=>$request['parent_id'],
            'rank'=>$request['rank']
        ]);
     
        if ($request->hasFile('multiple_files')) {
        
            $files = $request->file('multiple_files');

            // Extract file paths
                $rank=1;
            foreach ($files as $file) {
                $ext = GeneralHelper::findExtension($file->getClientOriginalName());
                if (in_array($ext, $this->allowed_array)) {
                $path = public_path("files/categories/" . $request['slug']);
                $filename =  rand(1000,99999). "_" . date('YmdHis') . "." . GeneralHelper::findExtension($file->getClientOriginalName());
                $file->move($path, $filename);
               
                $path = public_path("files/categories/" . $request['slug'] . "/" . $filename);


               $resizedImage = Image::make($path)->resize(200, null, function ($constraint) {
                   $constraint->aspectRatio();
               });


                $resizedImage->save(public_path("files/categories/" . $request['slug'] . "/200".$filename));
               $image200 ="200".$filename;

               $resizedImage = Image::make($path)->resize(50, null, function ($constraint) {
                $constraint->aspectRatio();
            });


             $resizedImage->save(public_path("files/categories/" . $request['slug'] . "/50".$filename));
            $image50 ="50".$filename;
                    CategoryImage::create([
                        'category_id'=>$category['id'],
                        'image'=>$filename,
                        'image200'=> $image200,
                        'image50'=> $image50,
                            'rank'=>$rank

                    ]);
                    $rank++;
               }
            }
             
        }
        
        return  $this->success([''],"Kategori Eklendi" ,201);
    }catch (Exception $e){
       // return response()->json(['error' => $e->getMessage()], 500);
        return  $this->error([''], $e->getMessage() ,500);
    } 

       

    }
public function check_slug($slug ){
    $ch = Category::where('slug','=',$slug) ->first();
        if($ch){
            return response()->json('bu isimde başka bir kategori mevcut');
        }
    
    
    return response()->json("ok");
}
    
    public function show($id)
    {
        // Show the specified resource
    }

    public function edit($id)
    {
        // Show the form to edit the specified resource
    }

    public function update(Request $request, $id)
    {
        // Update the specified resource
    }

    public function destroy($id)
    {
        // Remove the specified resource
    }


    public function select_count($cat_id){
        return  Category::select('id')->where('parent_id','=',$cat_id)->count();
    }

    private function find_lower_cats($cat_id){
        return  Category::select('id','name')->where('parent_id','=',$cat_id)->orderBy('rank')->get();
    }

    private function find_siblings($parent_id){
        return Category::select('id','name','parent_id')->where('parent_id','=',$parent_id)->orderBy('rank')->get();
    }
    
    public function show_up_categories($cat_id){
        
        $category = Category::select('id','name','parent_id')->find($cat_id);
        $parent_id =  $category['parent_id'];
        $array = ['cat_select_'.$category['parent_id']];
        while($parent_id > 0){
            $category = Category::find($parent_id);
            $parent_id =  $category['parent_id'];
            if($parent_id>0){
            array_push($array,'cat_select_'.$parent_id) ;
            }
        }

        return response()->json( ['data'=> $array]);
    }
    
    public function select_categories($cat_id){
        $array = [];
        $category = Category::select('id','name','parent_id')->find($cat_id);
        $parent_id =  $category['parent_id'];
        $array[]=['categories'=>$this->find_siblings($category['parent_id']),'selected'=>$category['id']];
        while($parent_id > 0){
            $category = Category::find($parent_id);
            $parent_id =  $category['parent_id'];
            
            $array[]=['categories'=>$this->find_siblings($category['parent_id']),'selected'=>$category['id']];
        }
        $subs=[];
        $sub_cats = Category::select('id','name','parent_id')->where('parent_id','=',$cat_id);
        if($sub_cats->count()>0){
            $subs=['categories'=>$sub_cats->orderBy('rank')->get(),'count'=>$sub_cats->count()];
        }

        return response()->json( ['data'=> array_reverse($array),'sub_categories'=>$subs]);
        // $cats = $this->getCategories(0);
        //  return view('admin.panel.categories.categories_test',['categories_array'=>$array]);
    }
    
}
