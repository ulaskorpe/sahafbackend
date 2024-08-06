<table id="bootstrap-data-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Resim</th>
            <th>Başlık </th>
            <th>Kategori</th>
            <th>Yazar</th>
            
           
            <th>#</th>
        </tr>
    </thead>
    <tbody>
       
     @foreach($product->comments()->get() as $product)
     <tr>
        <td>

            <form id="deleteform{{$product['id']}}"
                action=" {{ route('products-delete') }}" method="POST">
                <input type="hidden" name="_token" id="_token"
                    value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="id"
                    value="{{ $product['id'] }}">
            </form>

          
           
    </td>
    <td><b>{{$product['title']}}</b><br>
    
    {{substr($product['prologue'],0,50)}}
    </td>
    <td>
   
         
    </td>
    <td> </td>
    
    


    <td style="width: 200px">


        <button type="button" class="btn btn-primary"
            >Güncelle</button>


        <button type="button"  
            class="btn btn-danger">Sil</button>


    </td>
</tr>
     @endforeach
   
    
    </tbody>
</table>