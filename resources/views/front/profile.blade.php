@extends('front.main_layout')

@section('css')
<style>
    .search-box {
        display: flex;
        justify-content: flex-end;
        max-width: 20%;
    }
</style>
@endsection 
@section('main')
  
<div class="container-fluid">
         <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                   <a class="breadcrumb-item text-dark" href="{{route('index')}}">Anasayfa</a>
                    <a class="breadcrumb-item text-dark" href="#">Hesabım</a>
                    
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->

    <div class="container-fluid pb-5">
      
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Üyelik Bilgilerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Adreslerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Şifre Güncelle</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Resimlerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-5">Hesap Ayarlarım</a>
                     
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            @include("front.partials.profile_info")
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                           dwer
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                           d
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            5
                         </div>
                         <div class="tab-pane fade" id="tab-pane-5">
                           64
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if(false)
    <div class="container-fluid pb-5">
      
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Üyelik Bilgilerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Adreslerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Şifre Güncelle</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Resimlerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-5">Hesap Ayarlarım</a>
                     
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                          @include("front.partials.profile_info")
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                        </div>
                        <div class="tab-pane fade" id="tab-pane-5">
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Shop Detail End -->


    <!-- Products Start -->
    
    <!-- Products End -->

</div>
@endsection

@section('scripts')
<script>
 
 document.getElementById('avatar').addEventListener('change', function(event) {
   
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        $('#previewImage').show();
    };

    reader.readAsDataURL(file);
});


$('#forget-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});


$('#info-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});

async function infoFormSubmit() {

let error = false;
 
 

if ($('#name').val() == '') {
    $('#name').focus();
    Swal.fire({
        icon: 'error',
        text: 'Adınız ve soyadınızı giriniz'
    });
    error = true;
    return false;
 }


 if ($('#username').val() == '') {
    $('#username').focus();
    Swal.fire({
        icon: 'error',
        text: 'Lütfen kullanıcı adı seçiniz'
    });
    error = true;
    return false;
 }else{
    const response = await fetch('/check-username/' + $('#username').val());
    const data2 = await response.json();
    if (data2 !== 'ok') {
        $('#username').val('');
        $('#username').focus();
        Swal.fire({
            icon: 'error',
            text: data2
        });

        error = true;
        return false;
    }
 }


 if ($('#email').val() == '') {
    $('#email').focus();
    Swal.fire({
        icon: 'error',
        text: 'Eposta adresi giriniz'
    });
    error = true;
    return false;

 }else{
    const response = await fetch('/check-email/' + $('#email').val());
    const data = await response.json();
    if (data !== 'ok') {
        $('#email').val('');
        $('#email').focus();
        Swal.fire({
            icon: 'error',
            text: data
        });

        error = true;
        return false;
    }


 }




 if ($('#phone_number').val() != '') {
 
    const response = await fetch('/check-phone/' + $('#phone_number').val());
    const data3 = await response.json();
    if (data3 !== 'ok') {
        $('#phone_number').val('');
        $('#phone_number').focus();
        Swal.fire({
            icon: 'error',
            text: data3
        });

        error = true;
        return false;
    }
}

        



           
 

var formData = new FormData(document.getElementById('info-form'));
$('#submit_button').prop('disabled',true);
// alert("ok");
///async function save(formData,route,formID,btn,reload) 
await save(formData, '/user-profile-post', '', '','{{url('/hesabim')}}');
 
  
 
// setTimeout(() => {
//       window.open('{{url('/')}}','_self');
// }, 2000);

}


@if($user['new_email'])
async function cancel_email_update() {
    Swal.fire({
        title: 'Eposta güncellemeniz iptal edilecek , eminmisiniz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet!',
        cancelButtonText: 'Hayır'
    }).then(async (result) => {  
        // If confirmed
        if (result.isConfirmed) {
            try {
                const response = await fetch('/cancel-email-update/');
                const data = await response.json();
                console.log(data);
                if (data == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        text: "Eposta güncelleme talebiniz iptal edildi"
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    text: "Bir hata oluştu, lütfen tekrar deneyin."
                });
            }

            setTimeout(() => {
                        window.location.reload();  
                    }, 2000);  
        }
    });
}

@endif 

    </script>
@endsection