 @extends('front.main_layout')

 @section('main')
        @include("front.partials.carousel")
       
        @include("front.partials.featured")
       
        @include("front.partials.recent")
        @if(true)
        @include("front.partials.categories")
        @include("front.partials.products")
        @include("front.partials.offer")
        
        @endif
       
 @endsection