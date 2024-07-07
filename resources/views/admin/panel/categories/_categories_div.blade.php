<div class="row form-group">
    <input type="hidden" name="parent_id" id="parent_id" value="{{$selected_cat['parent_id']}}">

    <div class="col col-md-3"><label for="select" class=" form-control-label">Üst
            Kategori</label></div>
    <div class="col-12 col-md-9">
        <select name="cat_select" id="cat_select" class="form-control" onchange="select_cat(this.value)">
            <option value="0">Seçiniz</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat['id'] }}" @if($up_selected == $cat['id']) selected @endif>{{ $cat['name'] }}</option>
            @endforeach
        </select>
        <div id="cats_div">
            @foreach($cats_array as $select)

           
            <select name="cat_select_31" id="cat_select_31" class="form-control mt-2" onchange="select_cat(this.value)">
                <option value="0">seçiniz</option>
                @foreach($select['cats'] as $cat)
                <option value="{{$cat['id']}}" @if($cat['id']==$select['selected']) selected @endif>{{$cat['name']}}</option>
                @endforeach
            </select><br>
                @endforeach
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3"><label for="select" class=" form-control-label">Sıra</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="rank" id="rank" class="form-control">
            @for($i=$rank_count ; $i>0;$i--)
            <option value="{{$i}}" @if($i==$selected_cat['rank']) selected @endif>{{$i}}</option>
            @endfor
        </select>
    </div>
</div>
