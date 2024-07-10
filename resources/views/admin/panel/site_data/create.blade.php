@extends('admin.panel.main_layout');
@section('css-section')
 
@endsection
 
 
@section('main')
 
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Site Verisi Ekle</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <button type="button" onclick="window.open('{{ route('site-data.index') }}','_self')"
                                class="btn btn-primary">  Site Verileri</button>
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
                            <form class="form" id="site-data-form" name="site-data-form"
                                action="{{ route('site-data.store') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="maöe" class="form-control-label">Başlık</label></div>
                                    <div class="col-12 col-md-9">

                                        <input type="text" id="title" name="title" placeholder="Başlık"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Anahtar
                                            </label></div>
                                    <div class="col-12 col-md-9">
                                        <span id="slug-span"></span>
                                        <input type="hidden" id="slug" name="slug" placeholder="Text"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="description"
                                            class=" form-control-label">Değer :</label></div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="value" id="value"  class="form-control"></textarea>
                                        
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="file-multiple-input"
                                            class=" form-control-label"></label></div>
                                    <div class="col-12 col-md-9"><button onclick="formSubmit()"
                                            class="btn btn-primary"  >Ekle</button></div>
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
	 
 
 

$('#site-data-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
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
        text: 'Başlık giriniz'
    });

    error = true;
    return false;
} else {

    const response = await fetch('/admin-panel/site-data/check-slug/' + $('#slug').val());
    const data = await response.json();
    if (data !== 'ok') {
        Swal.fire({
            icon: 'error',
            text: data
        });
        $('#title').val('');
        $('#title').focus();
        error = true;
        return false;
    
      
    }

}



if ($('#value').val() == '') {

$('#value').focus();
Swal.fire({
    icon: 'error',
    text: 'Değer giriniz'
});



error = true;
return false;
} 

 


//console.log(error);
 var formData = new FormData(document.getElementById('site-data-form'));
 console.log(formData);
 save(formData, '{{route("site-data.store")}}', '', '');
 
setTimeout(() => {
    window.open("/admin-panel/site-data/", "_self")
}, 2000);

}
 
    
    </script>


    <script type="text/javascript" src="{{ url('assets/js/categories2.js') }}"></script>
@endsection
