@extends('admin.panel.main_layout');

@section('css-section')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection
@section('main')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Ürünler</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <button type="button" onclick="window.open('{{ route('products.create') }}','_self')"
                                class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Ürün Ekle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
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
                                   
                                 @foreach($products as $product)
                                 <tr>
                                    <td>

                                        <form id="deleteform{{$product['id']}}"
                                            action=" {{ route('products-delete') }}" method="POST">
                                            <input type="hidden" name="_token" id="_token"
                                                value="{{ csrf_token() }}">
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $product['id'] }}">
                                        </form>

                                      
                                        @if(!empty($product['icon']))
                                        <div class="form-group" id="avatar_pic">
                                            <div class="input-group">
                                               <img src="{{url("files/products/".$product['slug']."/".$product['icon'])}}" style="width:100px">
                                            </div>
                                        </div>
                                        @endif
                                </td>
                                <td><b>{{$product['title']}}</b><br>
                                
                                {{substr($product['prologue'],0,50)}}
                                </td>
                                <td>
                               
                                    @foreach ($product->category->parentTree() as $parentCategory)
                                              {{ $parentCategory->name }}  @if($parentCategory->id  != $product['category_id']) >  @endif
                                       @endforeach
                            

                                </td>
                                <td>{{$product->user()->first()->name}}</td>
                                
                                
                         
                            
                                <td style="width: 200px">


                                    <button type="button" class="btn btn-primary"
                                        onclick="window.open('{{route('products.edit',$product['id'])}}','_self')">Güncelle</button>


                                    <button type="button" onclick="deleteproduct({{$product['id']}})"
                                        class="btn btn-danger">Sil</button>


                                </td>
                            </tr>
                                 @endforeach
                               
                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('scripts')
    @include("admin.panel.partials.datatable_scripts")
 

 

     
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });

        function deleteproduct(id) {
            Swal.fire({
                text: 'product silinecek, emin misin?',
                //text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {

                if (result.isConfirmed) {
                     
                    $('#deleteform' + id).submit();
                       
                }
            });
        }
    </script>
@endsection
