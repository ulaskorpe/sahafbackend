@extends('admin.panel.main_layout');

@section("css-section")
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
  
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection
@section("main")
 
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Kategoriler</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <button type="button" onclick="window.open('{{route('categories.create')}}','_self')" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Kategori Ekle</button>
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
                                    <th>Name</th>
                                    <th>Position</th>
                                     
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($categories as $category)
                                <tr  style="cursor: pointer">
                                    <td>
                                        @if($category['icon'])
                                            <img src="{{url('files/categories/'.$category['slug'].'/'.$category['icon'])}}">
                                        @endif
                                        </td>
                                    <td>{{$category['name']}}</td>
                                    
                                    <td>Edinburgh</td>
                                     
                                    <td>2011-04-25</td>
                                    <td>
                                        <button type="button" class="btn btn-primary">Güncelle</button>
                                        <button type="button" onclick="showSubs({{$category->id}})" class="btn btn-secondary">Alt Kategorier</button>
                                        <button type="button" onclick="deleteCategory({{$category->id}})" class="btn btn-danger">Sil</button>


                                    </td>
                                </tr>
                                <tr style="display: none"><td colspan="6"></td></tr>
                               
                                <tr id="tr{{$category->id}}" style="display: none;backgroud-color:white"><td colspan="6"><div id="sub{{$category->id}}"></div></td></tr>
                                @endforeach
                               
                        </table>
                    </div>
                </div>
            </div>

<input type="hidden" id="row_count" name="row_count" value="{{$count}}">
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
 
@endsection

@section("scripts")
 
@if(false)

<script src="{{url('assets/js/lib/data-table/datatables.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/jszip.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
<script src="{{url('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
<script src="{{url('assets/js/init/datatables-init.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#bootstrap-data-table-export').DataTable();
  } );
</script>

<script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap4.js"></script>
 
@else
 


 

<script type="text/javascript">

    function deleteCategory(id){
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
             
                Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            }
        });
    }

   async function showSubs(id){
         for(i=0;i<$('#row_count').val();i++){
            console.log(i);
            $('#tr'+i).hide();    
         }
        $('#tr'+id).show();

     await $.get('/admin-panel/categories/show-sub-categories/' + id, function(data, status) {
                console.log(data);
                  
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
  } );
</script>

@endif 

@endsection