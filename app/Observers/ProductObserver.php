<?php

namespace App\Observers;

use App\Mail\ProductUpdatedMail;
//use App\Mail\UserCreatedEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
 
    public function created(Product $product){

    if(empty($product['verified'])){
        $txt = $product['title'] ." isimli ürününüz sitemize eklenmiştir. Yayını onaylandığında bilgilendirleceksiniz";
    }else{
        $txt = $product['title'] ." isimli ürününüz sitemize eklenmiş ve onaylanmıştır";
    }
     
           Mail::to($product->user()->first()->email)->send(new ProductUpdatedMail($txt,'ürününüz eklendi'));

         //  Log::channel('data_check')->info($txt."::".$product->user()->first()->email);
    }

    public function saved(Product $product){
        Log::channel('data_check')->info($product['name']." güncellendi::");
    }

}
