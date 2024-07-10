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
                            <h1>Site Verileri</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <button type="button" onclick="window.open('{{ route('site-data.create') }}','_self')"
                                class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Site Verisi Ekle</button>
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
                                        
                                        <th>Başlık </th>
                                        <th>Değer</th>
                                        <th>Anahtar</th>
                                        
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                 @foreach($site_data as $data)
                                 <tr>
                                    
                                <td style="width: 25%"><b>{{$data['title']}}</b> </td>
                                <td>{{$data['value']}}</td>
                                <td style="width: 25%">{{$data['key']}} </td>
                                
                         
                            
                                <td style="width: 200px">


                                    <button type="button" class="btn btn-primary"
                                        onclick="window.open('{{route('site-data.edit',$data['id'])}}','_self')">Güncelle</button>


                                    


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

     
    </script>
@endsection
