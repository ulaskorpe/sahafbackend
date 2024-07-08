<?php

namespace App\Observers;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;

class ProductObserver
{
//    Mail::to($user->email)->send(new UserCreatedEmail($user['name'],$user['admin_code'],'134132'));

    public function created(Product $product){
        $txt = $product->name ." isimli ürününüz sitemize eklenmiştir. Yayını onaylandığında bilgilendirleceksiniz";
           // Mail::to()
    }

}
