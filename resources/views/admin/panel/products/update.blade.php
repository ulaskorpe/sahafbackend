@extends('admin.panel.main_layout');

@section('css-section')
<link rel="stylesheet" href="{{url('richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{url('richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src="{{url('richtexteditor/plugins/all_plugins.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">

@endsection
@section('main')
 
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Ürün Güncelle</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <button type="button" onclick="window.open('{{ route('products.index') }}','_self')"
                                class="btn btn-primary">  Ürünler</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
             
                <div class="col-lg-12">
                    <div class="card">
                        
                        <div class="card-body card-block">
                            <form class="form" id="product-form" name="product-form"
                                action="{{ route('products-update') }}" method="post" enctype="multipart/form-data">
 

                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id" value="{{ $product['id'] }}">
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="maöe" class="form-control-label">Yazar 
                                            Adı</label></div>
                                    <div class="col-12 col-md-9">

                                       {{$product->user()->first()->name}}
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="maöe" class="form-control-label">Ürün
                                            Adı</label></div>
                                    <div class="col-12 col-md-9">

                                        <input type="text" id="title" name="title" placeholder="product adı" value="{{ $product['title'] }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Etiket
                                            (slug)</label></div>
                                    <div class="col-12 col-md-9">
                                        <span id="slug-span">{{$product['slug']}}</span>
                                        <input type="hidden" id="slug" name="slug" placeholder="Text" value="{{ $product['slug'] }}"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Ön Yazı</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="prologue" id="prologue"  value="{{ $product['prologue'] }}"
                                        placeholder="önyazı..." class="form-control" ></input>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <input type="hidden" name="product" id="product">
                                        <div id="div_editor1"> </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="start_price"
                                            class=" form-control-label">Başlangıç Fiyatı</label></div>
                                    <div class="col-3 col-md-3">
                                        <input class="form-control" type="number" value="{{$product['start_price']}}" name="start_price" id="start_price">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="buy_now_price"
                                            class=" form-control-label">Hemen Al Fiyatı</label></div>
                                    <div class="col-3 col-md-3">
                                        <input class="form-control" type="number" value="{{$product['buy_now_price']}}" name="buy_now_price" id="buy_now_price">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="bid_price"
                                            class=" form-control-label">Enaz arttırma tutarı</label></div>
                                    <div class="col-3 col-md-3">
                                        <input class="form-control" type="number" value="{{$product['bid_price']}}" name="bid_price" id="bid_price">
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Onaylandı</label></div>
                                    <div class="col-12 col-md-9">
                                        @if(!empty($product['verified'])) 
                                        <input type="checkbox" name="verified" id="verified" value="13" data-toggle="switchbutton" checked >

                                            {{ Carbon\Carbon::parse($product['verified'])->format('d.m.Y H:i')}} ,

                                            {{$product->verified_by()->first()->name}}
                                            @else 
                                            <input type="checkbox" name="verified" id="verified" value="13" data-toggle="switchbutton"  >
                                        @endif

                                       
                                    </div>
                                </div>
                                <div id="cats_div"></div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Youtube Video</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="youtube_link" id="youtube_link"  value="{{$product['youtube_link']}}"
                                        placeholder="https://www.youtube.com/watch?v...." class="form-control" ></input>
                                    </div>
                                </div>
                              @if(!empty($product['youtube_link']))
                              <div class="row form-group">
                                <div class="col col-md-12"> 
                             
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$youtube_link}}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        
                              @endif


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">product
                                            Resmi</label></div>
                                    <div class="col-12 col-md-9"><input type="file" id="icon" name="icon"
                                            class="form-control-file"></div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-multiple-input"
                                            class=" form-control-label">Diğer Resimler</label></div>
                                    <div class="col-12 col-md-9"><input type="file" id="multiple_files"
                                            name="multiple_files[]" multiple="" class="form-control-file"></div>
                                </div>
                                @if($product->icon)
                                <div class="row form-group" id="preview_pic" >
                                    <div class="col col-md-3"></div>
                                    <div class="col-12 col-md-9">
                                        <a href="#" data-toggle="modal" data-target="#mediumModal" onclick="show_image('icon',{{$product->id}})">
                                        <img id="previewImage" src="{{url('/files/products/'.$product->slug.'/'.$product->icon)}}" alt="Preview Image"
                                            style="max-width: 300px">
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="row form-group" id="preview_pic" style="display: none">
                                    <div class="col col-md-3"></div>
                                    <div class="col-12 col-md-9">
                                        <img id="previewImage" src="#" alt="Preview Image"
                                            style="max-width: 300px">
                                    </div>
                                </div>
                                @endif
                              
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-multiple-input"
                                            class=" form-control-label"></label></div>
                                    <div class="col-12 col-md-9"><button onclick="formSubmit()"
                                            class="btn btn-primary" onmouseover="fillproduct()">Güncelle</button></div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
<textarea id="tmptxt" style="display: none">{{$product_txt}}</textarea>
                        </div>
                        <div class="card">

                            <div class="card-body card-block">
                                <div id="product-images">
                                
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('assets/js/categories2.js') }}"></script>
<script type="text/javascript">
  $(function() {
             bring_images();
          //  bring_cats();
            select_cats({{$product['category_id']}},"product",0)
        
        });
async function show_image(type='image',id){
        await $.get('/admin-panel/products/show-image/'+type+'/'+id , function(data, status) {
              
              $("#mediumModalBody").html(data);
          });
    
     
          }

	var editor1cfg = {}
	editor1cfg.toolbar = "basic";
	//var editor1 = new RichTextEditor("#div_editor1", editor1cfg);
	var editor1 =  new RichTextEditor("#div_editor1", { skin: "rounded-corner", toolbar: "default" });
 
    $(document).ready(function() {
        bring_images();
        editor1.setHTMLCode($('#tmptxt').val());
    });

    async function bring_images(image_id=0,rank=0){
        await $.get('/admin-panel/products/show-product-images/'+{{$product->id}}+"/"+image_id+"/"+rank , function(data, status) {
              
              $("#product-images").html(data);
          });
    
     
    }

    function deleteImage(image_id) {
                Swal.fire({
                    text: 'Resim silinecek silinecek, emin misin?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet',
                    cancelButtonText: 'Hayır'
                }).then((result) => {

                    if (result.isConfirmed) {

                         $.get('/admin-panel/products/delete-product-image/'+image_id , function(data, status) {
                            if(data=="ok"){
                                bring_images();
                            }
                        
                        });
                    }
                });
            }

function fillproduct(){
    var content =editor1.getHTMLCode();//= editor1.get('div_editor1').getContent();
    document.getElementById('product').value =content;
}
 

$('#product-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});


document.getElementById('icon').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        $('#preview_pic').show();
    };

    reader.readAsDataURL(file);
});

document.getElementById('title').addEventListener('input', function(event) {
    // This function will be called whenever the text input changes
    let slug = slugify($('#title').val());
    $('#slug').val(slug);
    $('#slug-span').html(slug);

});
 
async function formSubmit() {

let error = false;
if ($('#title').val() == '') {

    $('#title').focus();
    Swal.fire({
        icon: 'error',
        text: 'product başlığı giriniz'
    });

    error = true;
    return false;
} else {

    const response = await fetch('/admin-panel/products/check-slug/' + $('#slug').val()+'/'+{{$product['id']}});
    const data = await response.json();
    if (data !== 'ok') {
        Swal.fire({
            icon: 'error',
            text: data
        });

        error = true;
        return false;
    }

}



if ($('#prologue').val() == '') {

$('#prologue').focus();
Swal.fire({
    icon: 'error',
    text: 'product önyazı giriniz'
});



error = true;
return false;
} 

if ($('#product').val().length < 30) {

$('#div_editor1').focus();
Swal.fire({
    icon: 'error',
    text: 'product  giriniz'
});



error = true;
return false;
} 
if ($('#selected_category_id').val() == '0') {

$('#selected_category_id').focus();
Swal.fire({
    icon: 'error',
    text: 'kategori seçiniz'
});



error = true;
return false;
} 

if ($('#start_price').val()< 10 ||  $('#start_price').val() > 100000) {

$('#start_price').focus();
Swal.fire({
    icon: 'error',
    text: 'başlangıç fiyatı 10 - 100000 arasında olmalıdır'
});

error = true;
return false;
} 


if ($('#buy_now_price').val()<  $('#start_price').val()  ) {

$('#buy_now_price').focus();
Swal.fire({
    icon: 'error',
    text: 'hemen al fiyatı başlangıç fiyatından düşük olamaz'
});
error = true;
return false;
} 

if ($('#bid_price').val()< 10 ||  $('#bid_price').val() > 1000) {

$('#bid_price').focus();
Swal.fire({
    icon: 'error',
    text: 'arttırma tutarı 10 - 1000 arasında olmalıdır'
});
error = true;
return false;
} 


if ($('#youtube_link').val() != '' ) {
    if(doesNotStartWithYouTube($('#youtube_link').val())){
 
$('#youtube_link').focus();
$('#youtube_link').val('');
Swal.fire({
    icon: 'error',
    text: 'geçerli bir youtube linki giriniz'
});

error = true;
return false;
    }
} 

//console.log(error);
var formData = new FormData(document.getElementById('product-form'));
console.log(formData);
save(formData, '/admin-panel/products/update', '', '');
 
setTimeout(() => {
    window.open("/admin-panel/products/", "_self")
}, 2000);

}
function doesNotStartWithYouTube(str) {
    return !str.startsWith("https://www.youtube.com/");
}
    
    
    </script>


    <script type="text/javascript" src="{{ url('assets/js/categories.js') }}"></script>
@endsection
