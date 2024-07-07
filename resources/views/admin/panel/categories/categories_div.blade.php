<div class="row form-group"> 
    <div class="col col-md-3"><label for="select" class=" form-control-label">Üst 
        Kategori</label></div>
    @if(!empty($selected_category))
    <input type="hidden" name="selected_category_id" id="selected_category_id" value="{{$selected_category['id']}}">
    <div class="col-md-5 ">

         @foreach($up_categories as $category)
         <select name="cat_select" id="cat_select" class="form-control" onchange="select_cats(this.value,'{{$type}}',{{$show}})" style="margin-bottom:10px">
                <option value="0">seçiniz</option>
            @foreach($category[0] as $item)
            
                @php 
                 $selected  = ($item['id'] == $category['selected']) ? "selected":"";
                @endphp
               
                    <option value="{{$item['id']}}" {{$selected}}>{{$item['name']}}</option>
                    
            @endforeach
        </select>
         @endforeach
       


@if(count($sub_categories['categories'])>0)

    
   
<select name="cat_select" id="cat_select" class="form-control" onchange="select_cats(this.value,'{{$type}}',{{$show}})" style="margin-bottom:10px">
    <option value="0">seçiniz</option>
    @foreach($sub_categories['categories'] as $cat)
        <option value="{{$cat['id']}}">{{$cat['name']}} </option>
     @endforeach
</select>


@if($show) 
<select name="rank" id="rank" class="form-control" >
    <option value="{{count($sub_categories['categories'])+1}}">{{count($sub_categories['categories'])+1}}</option>
   @for($i = count($sub_categories['categories']); $i>0 ; $i--)
   <option value="{{$i}}">{{$i}}</option>
   @endfor
</select>
@endif


@else
@if($show)
<select name="rank" id="rank" class="form-control" >
    <option value="1">1</option>
</select>
 
@endif
@endif
    </div>


</div>
</div>


    @else
    <input type="hidden" name="selected_category_id" id="selected_category_id" value="0">
    
        <div class="col-5  ">
            <select name="cat_select" id="cat_select" class="form-control" onchange="select_cats(this.value,'{{$type}}',{{$show}})" style="margin-bottom:10px">
                <option value="0">seçiniz</option>
                @foreach($up_categories['categories'] as $cat)
                    <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                 @endforeach
            </select>
       
    
   @if($show)
        
            <select name="rank" id="rank" class="form-control"  >
                <option value="{{$count+1}}">{{$count+1}}</option>
               @for($i = $count; $i>0 ; $i--)
               <option value="{{$i}}">{{$i}}</option>
               @endfor
            </select>
            @endif
        </div>
 
    @endif

   