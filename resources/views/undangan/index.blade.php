@extends('main')
@section('head')
    <title>Undangan</title>
@endsection
@section('title')
    @if ($r == 'all')
        <a class="navbar-brand" href="{{url('table-kegiatan-all/'.$table)}}">
            Tabel Kegiatan
        </a>
    @else
        <a class="navbar-brand" href="{{url('table-kegiatan')}}">
            Tabel Kegiatan
        </a>
    @endif
@endsection

@section('sidebar')
@if ($r == 'all')
@include('sidebar.all')
@else
@include('sidebar.user')
@endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $table_name }}</h2>
                    <br>
                    <p class="card-category">{{ $table_category }}</p>
                    <legend>
                </div>
                <div class="card-content">
                    <div class="table table-striped table-responsive-sm">
                        <form method="get" action="{{ ($r == 'all') ? url('table-kegiatan-all/'.$table.'/undangan/edit/'.$id) 
                            : url('table-kegiatan/undangan/edit/'.$id)}}">
                            {{ csrf_field() }}
                            @php
                            $undanganExt = pathinfo($data->filename_undangan, PATHINFO_EXTENSION);
                            $absensiExt = pathinfo($data->filename_absensi, PATHINFO_EXTENSION);
                            $fotoExt = pathinfo($data->filename_foto, PATHINFO_EXTENSION);
                            $notulensiExt = pathinfo($data->filename_notulensi, PATHINFO_EXTENSION);

                            function getIcon($ext) {
                            $icons = array(
                            "pdf" => '<i class="fa fa-file-pdf-o"></i>',
                            "doc" => '<i class="fa fa-file-word-o"></i>',
                            "docx" => '<i class="fa fa-file-word-o"></i>',
                            "ppt" => '<i class="fa fa-file-powerpoint-o"></i>',
                            "pptx" => '<i class="fa fa-file-powerpoint-o"></i>',
                            "xls" => '<i class="fa fa-file-excel-o"></i>',
                            "xlsx" => '<i class="fa fa-file-excel-o"></i>',
                            "txt" => '<i class="fa fa-file-text-o"></i>',
                            "zip" => '<i class="fa fa-file-archive-o"></i>',
                            "rar" => '<i class="fa fa-file-archive-o"></i>'
                            );
                            return $icons[$ext] ?? '<i class="fa fa-file-o"></i>';
                            }
                            @endphp
                            <h5>Undangan:</h5>
                            <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/undangan')}}" target="_blank" style="font-size: 16px">
                                {!! getIcon($undanganExt) !!}
                                {{$data->filename_undangan}}
                            </a>
                            <br>
                            <br>
                            <br>
                            <button type="submit" class="btn btn-fill btn-info" style="width: 10%">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection