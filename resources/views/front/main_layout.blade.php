<!DOCTYPE html>
<html lang="en">

@include("front.partials.head")

<body>
 
    @include("front.partials.topbar")
    @include("front.partials.navbar")
    @yield('main')
    @include('front.partials.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
   @include('front.partials.scripts')
</body>

</html>