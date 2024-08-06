@extends('front.main_layout')

 
@section('main')
  
<div class="container-fluid">
 
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('index')}}">Anasayfa</a>
                    @foreach ($cat_array  as $cat)
                    <a class="breadcrumb-item text-dark" href="{{route('category_detail',$cat['slug'])}}">{{$cat['name']}}</a>
               @endforeach

                  
                   
                    
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @if(!empty($product['icon']))
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{url('/files/products/'.$product['slug'].'/'.$product['icon'])}}" alt="Image">
                        </div>
                        @endif

                        @if(!empty($product->images()->get()))
                            @foreach($product->images()->get() as $img)
                        <div class="carousel-item">
                           
                            <img class="w-100 h-100" src="{{url('/files/products/'.$product['slug'].'/'.$img['image'])}}" alt="Image">
                        </div>
                        @endforeach

                        @endif
                        
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product['title']}}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            @if(false)
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            @endif
                            @for($i=0;$i<5;$i++)
                            <small class="far fa-star" style="cursor: pointer"></small>
                            @endfor
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h5 class="font-weight-semi-bold mb-4">

                        @if($product['winner_id']==0)
                        <input type="hidden" id="current_price" value="{{$product['current_price']}}">


                        @if($product['new_price']!=$product['current_price'])
                        Başlangıç fiyatı : {{$product['current_price']}} &#8378;  <br>
                        @endif

                        Şu an fiyatı : <span id="current_price_span">{{$product['new_price']}}&#8378;</span> 
                        
                        @if(count($product->bids()->get())>0)
                        ,  {{count($product->bids()->get())}} Teklif
                        @endif
                        <br> 
                        
                        Hemen Al fiyatı :  {{$product['buy_now_price']}}&#8378; </h5>
                    
                    <p class="mb-4">{{$product['prologue']}}</p>

                  
                    <form class="form" id="offer-form" name="offer-form" action="{{ route('make_offer') }}"
                    method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="users_bid" id="users_bid" value="{{$product['bid_price']}}">
                        <input type="hidden" name="product_id" id="product_id" value="{{$product['id']}}">
                    </form>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group   mr-3" style="width: 180px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus" onclick="reduce_bid()" id="minus_button" disabled>
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" disabled id="show_box"  value="{{$product['bid_price']}} &#8378;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus" onclick="raise_bid()" id="plus_button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" style="margin-right: 10px"  onclick="make_offer()"><i class="fa fa-regular fa-thumbs-up mr-1"></i>Teklif Ver</button>
                        <button class="btn btn-primary px-3"  onclick="buy_now()"><i class="fa fa-solid fa-bolt  mr-1"></i>Hemen Al</button>
                    </div>
                    @else 

                    @endif
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Bu ürünü paylaş:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Ürün Açıklaması</a>
                      
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Yorumlar (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3"></h4>
                            @php 
                                echo $product['description']
                            @endphp
                      
                        </div>
                       
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                       
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    @include("front.partials.similar_products")
    <!-- Products End -->
    
     
</div>
@endsection

@section('scripts')

  <!-- JavaScript Libraries -->
  
  <script src="{{url('front_assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>

  <!-- Contact Javascript File -->
 

  <!-- Template Javascript -->
  <script src="{{url('front_assets/js/main.js')}}"></script>
  <script src="{{ url('assets/js/saveV3.js') }}"></script>
<script>
 let current_price =   $('#users_bid').val();

 function reduce_bid(){
  
   
    let new_bid = parseInt(current_price)-parseInt({{$product['bid_price']}});
        current_price = new_bid;
        $('#users_bid').val( new_bid );
   
    if(current_price == parseInt({{$product['bid_price']}})){
        $('#minus_button').prop('disabled',true);
     
    }
    $('#show_box').val(current_price + ' ₺');
 }
 function raise_bid(){
   
   
    if(current_price >0){
        $('#minus_button').prop('disabled',false);
    }else{
        $('#minus_button').prop('disabled',true);
    }
 //   console.log(parseInt($('#users_bid').val())+parseInt({{$product['bid_price']}}))
 let new_bid = parseInt(current_price)+parseInt({{$product['bid_price']}});
        current_price = new_bid;
        $('#users_bid').val( new_bid );
        $('#show_box').val(current_price + ' ₺');
 }

 function make_offer(){
    @if(empty(Session::get('user_code')))
    Swal.fire({
                    icon: 'error',
                    text: 'Lütfen giriş yapın ya da kayıt olun'
                });
                setTimeout(() => {
                        window.open('{{route('user-login')}}','_self')
                }, 2000);
    @else
    let price = parseInt(current_price) + parseInt({{$product['new_price']}});
    price = (parseInt({{$product['buy_now_price']}})<price)?parseInt({{$product['buy_now_price']}}):price;
    
    Swal.fire({
            title:  price + ' ₺ teklif verilecek, emin misiniz?',
         
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                    $('#offer-form').submit();
            }
        });

    
    @endif
 }

 function buy_now(){
    @if(empty(Session::get('user_code')))
    Swal.fire({
                    icon: 'error',
                    text: 'Lütfen giriş yapın ya da kayıt olun'
                });
                setTimeout(() => {
                    window.open('{{route('user-login')}}','_self')
                }, 2000);
    @else
    @endif
 }

 $('#offer-form').submit(function(e) {
            e.preventDefault();
            var error = false;

            
            //function save(formData,route,formID,btn,reload) {
            var formData = new FormData(this);
            save(formData,'{{ route('make_offer') }}','offer-form','','/urun-detay/{{$product['slug']}}/{{$product['id']}}');

        });

    </script>
@endsection