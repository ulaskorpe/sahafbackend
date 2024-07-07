<div class="row form-group">

    <div class="col col-md-3"><label for="select" class=" form-control-label">Üst
            Kategori</label></div>
    <div class="col-12 col-md-9">
        <select name="cat_select" id="cat_select" class="form-control"
        onchange="select_cat(this.value)">
        <option value="0">Seçiniz</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
        @endforeach
    </select>
        
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3"><label for="select" class=" form-control-label">Sıra</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="rank" id="rank" class="form-control" ></select>
    </div>
</div>