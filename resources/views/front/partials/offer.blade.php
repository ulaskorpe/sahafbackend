<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        @for($i=0;$i<2;$i++)
        @php
             $x = rand(1,2);
        @endphp
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{url('front_assets/img/offer-'.$x.'.jpg')}}" alt="">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Sav {{$i}}e 20%</h6>
                    <h3 class="text-white mb-3">Special Offer</h3>
                    <a href="" class="btn btn-primary">Shop Now</a>
                </div>
            </div>
        </div>
        @endfor
         
    </div>
</div>