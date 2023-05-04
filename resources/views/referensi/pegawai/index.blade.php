@extends('main')
@section('title')
    <a class="navbar-brand" href="{{url('referensi/pegawai')}}">
        Referensi
    </a>
@endsection
@section('sidebar')
@include('sidebar.admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <br>
            @if (session('success'))
              <div class="alert alert-success">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">×</button>
                <span><b>Success - </b></span>
                  {{ session('success') }}
              </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $table_name }}</h2>
                    <br>
                    <p class="card-category">{{ $table_category }}</p>
                    <legend>
                </div>
                <div class="card-content">
                    <table id="bootstrap-table" class="table table-striped ">
                        <div class="toolbar" >
                            <a class="btn btn-primary" href="{{url('/referensi/pegawai/add')}}">
                                <i class="fa fa-plus-square"></i>
                                Tambah
                            </a>
                        </div>
                        <thead style="height: 100px">
                            <th data-field="no" data-sortable="true" class="text-center">No</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Jabatan</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                                @foreach ($table_data as $item) 
                                <tr>
                                    <td>{{$loop -> iteration}}</td>
                                    <td>{{$item -> nip}}</td>
                                    <td>{{$item -> email}}</td>
                                    <td>{{$item -> nama}}</td>
                                    <td>{{$item -> seksi}}</td>
                                    <td>{{$item -> jabatan}}</td>
                                    <td>
                                        <div class="table-icons">
                                            <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" 
                                                href="{{url('/referensi/pegawai/edit/'.$item->id)}}">

                                                <i class="ti-pencil-alt"></i>
                                            </a>
                                            <a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" 
                                                onclick="demo.deletePegawai('warning-message-and-cancel', {{$item->id}} )">

                                                <i class="ti-close"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script type="text/javascript">

		var $table = $('#bootstrap-table');

	        $().ready(function(){

	            $table.bootstrapTable({
	                toolbar: ".toolbar",
                    search: true,
	                clickToSelect: true,
	                showToggle: true,
	                showColumns: true,
	                pagination: true,
                    filterControl: true,
	                pageSize: 8,
	                clickToSelect: false,
	                pageList: [8,10,25,50,100],
                    sortName: 'no', 
                    sortOrder: 'asc',

	                formatShowingRows: function(pageFrom, pageTo, totalRows){
	                    //do nothing here, we don't want to show the text "showing x of y from..."
	                },
	                formatRecordsPerPage: function(pageNumber){
	                    return pageNumber + " rows visible";
	                },
	                icons: {
	                    refresh: 'fa fa-refresh',
	                    toggle: 'fa fa-th-list',
	                    columns: 'fa fa-columns',
	                    detailOpen: 'fa fa-plus-circle',
	                    detailClose: 'ti-close'
	                }
                    
	            });

	            //activate the tooltips after the data table is initialized
	            $('[rel="tooltip"]').tooltip();

	            $(window).resize(function () {
	                $table.bootstrapTable('resetView');
	            });

			});

	</script>
    
@endsection