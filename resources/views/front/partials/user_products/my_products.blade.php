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
                    <a class="breadcrumb-item text-dark" href="#">Ürünlerim</a>
                    
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
                        <a class="nav-item nav-link text-dark @if($selected==1)active @endif" data-toggle="tab" href="#tab-pane-1">Ürünlerim</a>
                        <a class="nav-item nav-link text-dark @if($selected==2)active @endif" data-toggle="tab" href="#tab-pane-2">Ürün Ekle</a>
                        <a class="nav-item nav-link text-dark @if($selected==3)active @endif" data-toggle="tab" href="#tab-pane-3">Ürün Yorumlarım</a>
                        <a class="nav-item nav-link text-dark @if($selected==4)active @endif" data-toggle="tab" href="#tab-pane-4">Aldığım Teklifler</a>
                        
                     
                    </div>
                    <div class="tab-content">
                        <a href="#" name="user_products"></a>
                        <div class="tab-pane fade  @if($selected==1) show active @endif" id="tab-pane-1">

                           <div id="user_products" ></div>
                        </div>
                        <div class="tab-pane fade @if($selected==2) show active @endif" id="tab-pane-2">
                             
                        </div>
                        <div class="tab-pane fade @if($selected==3) show active @endif" id="tab-pane-3">
                             
                        </div>
                        <div class="tab-pane fade @if($selected==4) show active @endif" id="tab-pane-4">
                            5
                         </div>
                         <div class="tab-pane fade @if($selected==5) show active @endif" id="tab-pane-5">
                           64
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

</div>
@endsection

@section('scripts')
<script>
 

 $( document ).ready(function() {
    
    show_products( 0);
});

 async function show_products(page){

$.get( "/user-products/"+page, function( data ) {

   $('#user_products').html(data);

});

}
</script>
@endsection