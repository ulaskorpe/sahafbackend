@extends('admin.panel.main_layout');

@section('css-section')
<link rel="stylesheet" href="{{url('richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{url('richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src="{{url('richtexteditor/plugins/all_plugins.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">

@endsection
@section('main')

<div class="default-tab">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link @if($tab==0) active show @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ürün Bilgisi</a>
            <a class="nav-item nav-link @if($tab==1) active show @endif" id="nav-images-tab" data-toggle="tab" href="#nav-images" role="tab" aria-controls="nav-images" aria-selected="false">Ürün Resimler</a>
            <a class="nav-item nav-link @if($tab==2) active show @endif" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="false">Yorumlar</a>
            <a class="nav-item nav-link @if($tab==3) active show @endif" id="nav-keywords-tab" data-toggle="tab" href="#nav-keywords" role="tab" aria-controls="nav-keywords" aria-selected="false">Anahtar Kelimeler</a>
            <a class="nav-item nav-link @if($tab==4) active show @endif" id="nav-bid-tab" data-toggle="tab" href="#nav-bid" role="tab" aria-controls="nav-bid" aria-selected="false">Teklif Verenler</a>
        </div>
    </nav>
    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
        <div class="tab-pane fade @if($tab==0) active show @endif" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          @include("admin.panel.products.product_info")
        </div>
        <div class="tab-pane fade @if($tab==1) active show @endif" id="nav-images" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
                <div class="col-md-12"> <div id="product-images"> </div></div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12"> 
                    <form class="form" id="product-form-images" name="product-form-images"
                    action="{{ route('update-product-images') }}" method="post" enctype="multipart/form-data">
        
        
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id" value="{{ $product['id'] }}">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="file-multiple-input"
                                class=" form-control-label"> </label></div>
                        <div class="col-12 col-md-9"><input type="file" id="multiple_files"
                                name="multiple_files[]" multiple="" class="form-control-file"></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="file-multiple-input"
                                class=" form-control-label"></label></div>
                        <div class="col-12 col-md-9"><button onclick="formImagesSubmit()" id="submit_button2"
                                class="btn btn-primary" >Güncelle</button></div>
                    </div>
                    </form>

                </div>
            </div>
           
           

        </div>
        <div class="tab-pane fade @if($tab==2) active show @endif" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
            @include("admin.panel.products.product_comments")
        </div>
        <div class="tab-pane fade @if($tab==3) active show @endif" id="nav-keywords" role="tabpanel" aria-labelledby="nav-keywords-tab">
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone. Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
        </div>
        <div class="tab-pane fade @if($tab==4) active show @endif" id="nav-bid" role="tabpanel" aria-labelledby="nav-bid-tab">
            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, irure terry richardson ex sd. Alip placeat salvia cillum iphone. Seitan alip s cardigan american apparel, butcher voluptate nisi .</p>
        </div>
    </div>

</div>
 
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
     //   alert("ok");
     
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
 
//product-form-images
$('#product-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});
$('#product-form-images').submit(function(e) {
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
 
async function formImagesSubmit() {


    let error = false;
if ($('#multiple_files').val() == '') {

    $('#multiple_files').focus();
    Swal.fire({
        icon: 'error',
        text: 'Lütfen dosya seçiniz'
    });

    error = true;
    return false;
} 

    var formData = new FormData(document.getElementById('product-form-images'));
 
$('#submit_button2').prop('disabled',true);
await save(formData, '/admin-panel/products/update-product-images', '', '');



setTimeout(() => {
    bring_images();
    $('#submit_button2').prop('disabled',false);
    $('#multiple_files').val('');
}, 2000);

}
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
$('#submit_button').prop('disabled',true);
save(formData, '/admin-panel/products/update', '', '');
 
setTimeout(() => {
  //  window.open("/admin-panel/products/", "_self")
   window.open("/admin-panel/products/edit/{{$product['id']}}", "_self")
}, 3000);

}
function doesNotStartWithYouTube(str) {
    return !str.startsWith("https://www.youtube.com/");
}
    
    
    </script>


   
@endsection
