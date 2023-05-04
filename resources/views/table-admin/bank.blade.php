@extends('main')
@section('head')
    <title>Table - Monitoring Kegiatan KPPN Baturaja</title>
@endsection
@section('title')
    <a class="navbar-brand" href="{{url('table-kegiatan/seksi-bank')}}">
        Tabel Kegiatan
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

                        <thead style="height: 100px">
                                <th data-field="Kegiatan" data-sortable="true">Kegiatan</th>
                                <th data-field="Nama Kegiatan" data-sortable="true">Nama Kegiatan</th>
                                <th data-field="Tanggal" data-sortable="true">Tanggal Pelaksanaan</th>
                                <th data-field="Pukul" data-sortable="true">Pukul</th>
                                <th data-field="Tempat" data-sortable="true">Tempat Pelaksanaan</th>
                                <th data-field="PIC" data-sortable="true">PIC</th>
                        </thead>
                        <tbody>
                                @foreach ($table_data as $item) 
                                <tr>
                                    <td>{{$item -> kegiatan}}</td>
                                    <td>{{$item -> nama_kegiatan}}</td>
                                    <td>{{ date('d F Y', strtotime($item->tgl_pelaksanaan)) }}</td>
                                    <td>{{ substr($item->pukul, 0, 5) }}</td>
                                    <td>{{$item -> tempat}}</td>
                                    <td>{{$item -> pic}}</td>
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
                    sortName: 'Tanggal', 
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