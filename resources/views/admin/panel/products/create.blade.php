@extends('admin.panel.main_layout');
@section('css-section')
<link rel="stylesheet" href="{{url('richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{url('richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src="{{url('richtexteditor/plugins/all_plugins.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">

<style>
 
</style>
@endsection
 
 
@section('main')
 
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Ürün Ekle</h1>
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
                                action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="maöe" class="form-control-label">Ürün
                                            Başlığı</label></div>
                                    <div class="col-12 col-md-9">

                                        <input type="text" id="title" name="title" placeholder="ürün adı"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Etiket
                                            (slug)</label></div>
                                    <div class="col-12 col-md-9">
                                        <span id="slug-span"></span>
                                        <input type="hidden" id="slug" name="slug" placeholder="Text"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Ön Yazı</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="prologue" id="prologue" 
                                        placeholder="önyazı..." class="form-control" ></input>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <input type="hidden" name="product" id="product">
                                        <div id="div_editor1">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="start_price"
                                            class=" form-control-label">Başlangıç Fiyatı</label></div>
                                    <div class="col-3 col-md-3">
                                        <input class="form-control" type="number" value="0" name="start_price" id="start_price">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="buy_now_price"
                                            class=" form-control-label">Hemen Al Fiyatı</label></div>
                                    <div class="col-3 col-md-3">
                                        <input class="form-control" type="number" value="0" name="buy_now_price" id="buy_now_price">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="bid_price"
                                            class=" form-control-label">Enaz arttırma tutarı</label></div>
                                    <div class="col-3 col-md-3">
                                        <input class="form-control" type="number" value="10" name="bid_price" id="bid_price">
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Onaylandı</label></div>
                                    <div class="col-12 col-md-9">
                                         
                                        <input type="checkbox" name="verified" id="verified" value="13" data-toggle="switchbutton" checked>
                                       
                                    </div>
                                </div>
                                <div id="cats_div"></div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Youtube Video</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="youtube_link" id="youtube_link" 
                                        placeholder="https://www.youtube.com/watch?v...." class="form-control" ></input>
                                    </div>
                                </div>
                              


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Ürün
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

                                <div class="row form-group" id="preview_pic" style="display: none">
                                    <div class="col col-md-3"></div>
                                    <div class="col-12 col-md-9">
                                        <img id="previewImage" src="#" alt="Preview Image"
                                            style="max-width: 300px">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-multiple-input"
                                            class=" form-control-label"></label></div>
                                    <div class="col-12 col-md-9"><button onclick="formSubmit()" id="submit_button"
                                            class="btn btn-primary" onmouseover="fillproduct()">Ekle</button></div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>

                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('scripts')


<script type="text/javascript">
	 
    $(function() { 
    
    select_cats(0,'product',0)
});
var editor1cfg = {}
	editor1cfg.toolbar = "basic";
	//var editor1 = new RichTextEditor("#div_editor1", editor1cfg);
	var editor1 =  new RichTextEditor("#div_editor1", { skin: "rounded-corner", toolbar: "default" });

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
        text: 'ürün başlığı giriniz'
    });

    error = true;
    return false;
} else {

    const response = await fetch('/admin-panel/products/check-slug/' + $('#slug').val());
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
    text: 'ürün önyazı giriniz'
});



error = true;
return false;
} 

if ($('#product').val().length < 30) {

$('#div_editor1').focus();
Swal.fire({
    icon: 'error',
    text: 'ürün  giriniz'
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

 

// var formData = new FormData(document.getElementById('product-form'));
// //console.log(formData);
// save(formData, '/admin-panel/products/update', '', '');
 
// setTimeout(() => {
//     window.open("/admin-panel/products/", "_self")
// }, 2000);

console.log(error);
 var formData = new FormData(document.getElementById('product-form'));
 //console.log(formData);
 $('#submit_button').prop('disabled',true);
 save(formData, '/admin-panel/products/store', '', '');
 
setTimeout(() => {
    window.open("/admin-panel/products/", "_self")
}, 3000);

  }
function doesNotStartWithYouTube(str) {
    return !str.startsWith("https://www.youtube.com/");
}
    
    </script>


    <script type="text/javascript" src="{{ url('assets/js/categories2.js') }}"></script>
@endsection
