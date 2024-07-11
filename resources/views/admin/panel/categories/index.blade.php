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
                            <h1>{{($type=='blog')?"Blog":"Ürün"}} Kategorileri</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                           
                            <button type="button" onclick="window.open('{{ route('categories.create',$type) }}','_self')"
                                class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Kategori Ekle</button>
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
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sıra</th>
                                        <th>Kategori Adı</th>
                                        <th>Açıklama</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @php 
                                            $div_array = [];
                                        @endphp 
                                    @foreach ($categories as $category)
                                        <tr  >
                                            <td>
                                                {{$category->rank}}
                                             
                                                <form id="deleteform{{$category->id}}" action="" method="POST">
                                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" id="id" value="{{ $category['id'] }}">
                                                </form>
                                            </td>
                                            <td>
                                                @if ($category['icon'])
                                                    <img
                                                        src="{{ url('files/categories/' . $category['slug'] . '/100' . $category['icon']) }}">
                                                @endif
                                            </td>
                                            <td>{{ $category['name'] }}</td>
                                            <td>{{ $category['description'] }}</td>
                                            <td>
                                               
                                                <button type="button" class="btn btn-primary" onclick="window.open('{{route('categories.edit',$category['slug'])}}','_self')">Güncelle</button>
                                                <button type="button" onclick="showSubs({{ $category->id }},'dv{{$category->id}}','tr{{$category->id}}','{{$category['type']}}')"
                                                    class="btn btn-secondary">Alt Kategorier</button>
                                                  
                                                <button type="button" onclick="deleteCategory({{ $category->id }})"
                                                    class="btn btn-danger">Sil</button>

                                                    <button type="button" onclick="hideCategory('dv{{$category->id}}','tr{{$category->id}}')"
                                                        class="btn btn-success">Gizle</button>
                                            </td>
                                        </tr>
                                    
                                       
                                        <tr id="tr{{$category->id}}" style="display:none;  ">
                                            <td colspan="6">
                                                <div id="dv{{$category->id}}"></div>
                                            </td>
                                        </tr>
                                    @endforeach

                            </table>
                        </div>
                      
                    </div>
                </div>

               
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('scripts')
  
        <script type="text/javascript">
            function deleteCategory(id) {
                Swal.fire({
                    text: 'Kategori silinecek, emin misin?',
                    //text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet',
                    cancelButtonText: 'Hayır'
                }).then((result) => {

                    if (result.isConfirmed) {
                            $('#deleteform'+id).submit();
                     //   Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                    }
                });
            }

            function hideCategory(dv,tr){
                $('#'+tr).hide();
                $('#'+dv).html('');
            }
            async function showSubs(id,dv,tr,type) {
 
                     $('#' + tr).show();
 
                await $.get('/admin-panel/categories/show-sub-categories/' + id+'/'+type, function(data, status) {
              
                    $("#"+dv).html(data);
                });
            }

            $(document).ready(function() {
                //$('#bootstrap-data-table-export').DataTable();
                // new DataTable('#example');
                //var dtable=$('#example thead th').eq(3).attr('width', '30%');

                //  new DataTable('#example', {
                //     //  paging: true,
                //     //  scrollCollapse: true,
                //     //  scrollY: '200px'
                //  });
                // dtable.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)')
            });
        </script>
   
@endsection
