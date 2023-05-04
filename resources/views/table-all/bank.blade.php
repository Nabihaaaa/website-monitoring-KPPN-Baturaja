@extends('main')
@section('head')
    <title>Table - Monitoring Kegiatan KPPN Baturaja</title>
@endsection
@section('title')
    <a class="navbar-brand" href="{{url('table-kegiatan-all/bank')}}">
        Tabel Kegiatan
    </a>
@endsection
@section('sidebar')
@include('sidebar.all')
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
                            <a class="btn btn-primary" href="{{url('/table-kegiatan-all/bank/add')}}">
                                <i class="fa fa-plus-square"></i>
                                Tambah
                            </a>
                        </div>

                        <thead style="height: 100px">
                                <th data-field="Kegiatan" data-sortable="true">Kegiatan</th>
                                <th data-field="Nama Kegiatan" data-sortable="true">Nama Kegiatan</th>
                                <th data-field="Tanggal" data-sortable="true">Tanggal Pelaksanaan</th>
                                <th data-field="Pukul" data-sortable="true">Pukul</th>
                                <th data-field="Tempat" data-sortable="true">Tempat Pelaksanaan</th>
                                <th data-field="PIC" data-sortable="true">PIC</th>
                                <th >Undangan</th>
                                <th data-field="Sudah/Belum" data-sortable="true">Sudah/Belum</th>
                                <th data-field="Realisasi Pelaksanaan" data-sortable="true" >Realisasi Pelaksanaan</th>
                                <th>Bukti Kegiatan</th>
                                <th>Actions</th>
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
                                    <td>
                                        @if($upload->where($f_key, $item->id)->first() == null)
                                            <form method="get" action="{{url('/table-kegiatan-all/bank/undangan/upload/'.$item->id)}}" enctype="multipart/form-data">
                                                <button class="btn btn-danger btn-fill btn-wd" type="submit" >Upload Undangan</button>
                                            </form>
                                        @elseif($upload->where($f_key, $item->id)->first()->undangan == null)
                                            <form method="get" action="{{url('/table-kegiatan-all/bank/undangan/upload/'.$item->id)}}" enctype="multipart/form-data">
                                                <button class="btn btn-danger btn-fill btn-wd" type="submit">Upload Undangan</button>
                                            </form>
                                        @else
                                            <form method="get" action="{{url('/table-kegiatan-all/bank/undangan/index/'.$item->id)}}" enctype="multipart/form-data">
                                                <button class="btn btn-success btn-fill btn-wd" type="submit">Lihat Undangan</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{$item -> SB}}</td>
                                    <td>
                                    @if ($item-> realisasi_pelaksanaan == null)
                                        Belum
                                    @else
                                        {{date('d F Y', strtotime($item -> realisasi_pelaksanaan)) }}
                                    @endif
                                    </td>
                                    <td>
                                        @if ($item->realisasi_pelaksanaan == null && $upload->where($f_key, $item->id)->first() != null)
                                            <form method="get" action="{{url('/table-kegiatan-all/bank/upload/'.$item->id)}}" enctype="multipart/form-data">
                                                <button class="btn btn-danger btn-fill btn-wd" type="submit">Upload Bukti</button>
                                            </form>
                                        @elseif($item->realisasi_pelaksanaan != null)
                                            <form method="get" action="{{url('/table-kegiatan-all/bank/bukti/'.$item->id)}}" enctype="multipart/form-data">
                                                <button class="btn btn-success btn-fill btn-wd" type="submit">Lihat Bukti</a>
                                            </form>
                                        @else
                                            <button class="btn btn-danger btn-fill btn-wd" onclick="demo.showSwal('basic')">Upload Bukti</button>
                                        @endif
                                    </td>
                                    <td>
                                      <div class="table-icons">
                                        <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="{{url('/table-kegiatan-all/bank/edit/tabel/'.$item->id)}}">
                                            <i class="ti-pencil-alt"></i>
                                        </a>
                                        <a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" onclick="demo.deleteAll('warning-message-and-cancel', {{$item->id}},'bank')">
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