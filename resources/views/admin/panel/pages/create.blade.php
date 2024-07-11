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
                            <h1>Sayfa Ekle</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <button type="button" onclick="window.open('{{ route('pages.index') }}','_self')"
                                class="btn btn-primary">  Sabit Sayfalar</button>
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
                            <form class="form" id="page-form" name="page-form"
                                action="{{ route('pages.store') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="maöe" class="form-control-label">Sayfa
                                            Başlığı</label></div>
                                    <div class="col-12 col-md-9">

                                        <input type="text" id="title" name="title" placeholder="sayfa başlığı"
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
                                        <input type="hidden" name="content" id="content">
                                        <div id="div_editor1">
                                           
                                        </div>
                                    </div>
                                </div>
                               
                                
                               
                                
                               
                                
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Youtube Video</label></div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" name="youtube_link" id="youtube_link" 
                                        placeholder="https://www.youtube.com/watch?v...." class="form-control" ></input>
                                    </div>
                                </div>
                              


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Sayfa
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
                                            class="btn btn-primary" onmouseover="fillpage()">Ekle</button></div>
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
	 
 
var editor1cfg = {}
	editor1cfg.toolbar = "basic";
	//var editor1 = new RichTextEditor("#div_editor1", editor1cfg);
	var editor1 =  new RichTextEditor("#div_editor1", { skin: "rounded-corner", toolbar: "default" });

function fillpage(){
    var content =editor1.getHTMLCode();//= editor1.get('div_editor1').getContent();
    document.getElementById('content').value =content;
}
 

$('#page-form').submit(function(e) {
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
        text: 'sayfa başlığı giriniz'
    });

    error = true;
    return false;
} else {

    const response = await fetch('/admin-panel/pages/check-slug/' + $('#slug').val());
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

if ($('#content').val().length < 30) {

$('#div_editor1').focus();
Swal.fire({
    icon: 'error',
    text: 'ürün  giriniz'
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

 
console.log(error);
 var formData = new FormData(document.getElementById('page-form'));
 //console.log(formData);
 $('#submit_button').prop('disabled',true);
 save(formData, '{{ route('pages.store') }}', '', '');
 
setTimeout(() => {
    window.open("/admin-panel/pages/", "_self")
}, 3000);

  }
function doesNotStartWithYouTube(str) {
    return !str.startsWith("https://www.youtube.com/");
}
    
    </script>


    <script type="text/javascript" src="{{ url('assets/js/categories2.js') }}"></script>
@endsection
