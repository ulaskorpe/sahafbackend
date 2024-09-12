
<div class="row bg-warning" >

    <div class="col-md-2">  
            Resim
        
            </div>
            <div class="col-md-2">Başlık </div>
            <div class="col-md-2">Görüntülenme Sayısı</div>
            <div class="col-md-3">Eklenme Tarihi</div>
            <div class="col-md-3">İşlem</div>
</div>
@foreach($products as $product)

@php
$bg = ($bg == "secondary"  ) ? "light": "secondary";
@endphp

<div class="row bg-{{$bg}} p-2">
   
    <div class="col-md-2">  
@if(!empty($product['icon']))
<img src="{{url('files/products/'.$product['slug'].'/100h'.$product['icon'])}}" alt="">
@else

@endif

    </div>
    <div class="col-md-2">{{$product['title']}}  </div>
    <div class="col-md-2 pt-3">{{$product['current']}} &#8378;</div>
    <div class="col-md-3 pt-3">{{\Carbon\Carbon::parse($product['created_at'])->format('d.m.Y H:i')}} </div>
    <div class="col-md-3 pt-3">  
        <a href="#"> <i class="fa-regular fa-pen-to-square"></i></a> 
        <a href="#"> <i class="fa-solid fa-trash"></i></a> 
    
    </div>

</div>
@endforeach

<nav aria-label="Page navigation example" style="margin-top:30px">
    <ul class="pagination justify-content-center">
        @if($page>0)
      <li class="page-item"><a class="page-link"  href="#user_products" onclick="show_products( '{{$page-1}}')"><i class="fa fa-solid fa-backward"></i>
        </a></li>
      @endif
      @for($i=0;$i<$page_count;$i++)
      @if($page==$i )
      <li class="page-item active">
        <a class="page-link" href="#">{{$i+1}}</a>
          </li>
      @else
      <li class="page-item  ">
        <a class="page-link" href="#user_products" onclick="show_products('{{$i}}')">{{$i+1}}</a>
          </li>
      @endif

      @endfor

      @if($page<$page_count-1)
      <li class="page-item"><a class="page-link"  href="#user_products" onclick="show_products( '{{$page+1}}')"><i class="fa fa-solid fa-forward"></i></a></li>
      @endif
    </ul>
  </nav>