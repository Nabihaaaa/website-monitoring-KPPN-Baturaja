@extends('main')
@section('head')
    <title>Bukti Kegiatan</title>
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
                        <form method="get" action="{{ ($r == 'all') ? url('/table-kegiatan-all/'.$table.'/edit/'.$id) 
                            : url('table-kegiatan/edit/'.$id)}}">
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
                            <h5>Absensi:</h5>
                                @if($data->absensi)
                                    <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/absensi')}}" target="_blank" style="font-size: 16px">
                                        {!! getIcon($absensiExt) !!}
                                        {{$data->filename_absensi}}
                                    </a>
                                @else
                                    <p class="text-danger">Belum ada file yang di upload</p> 
                                @endif
                            <h5>Foto:</h5>
                                @if($data->foto)
                                    <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/foto')}}" target="_blank" style="font-size: 16px">
                                        {!! getIcon($fotoExt) !!}
                                        {{$data->filename_foto}}
                                    </a>
                                @else
                                    <p class="text-danger">Belum ada file yang di upload</p> 
                                @endif
                            <h5>Notulensi:</h5>
                                @if($data->notulensi)
                                    <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/notulensi')}}" target="_blank" style="font-size: 16px">
                                        {!! getIcon($notulensiExt) !!}
                                        {{$data->filename_notulensi}}
                                    </a>
                                @else
                                    <p class="text-danger">Belum ada file yang di upload</p> 
                                @endif
                            <h5>Tambahan:</h5>
                            @if($tambahan != null)
                                    @foreach ($tambahan as $item)
                                        @php
                                            $tambahanExt = pathinfo($item->filename_tambahan, PATHINFO_EXTENSION);
                                        @endphp
                                        <a href="{{url('table-kegiatan/bukti/'.$id.'/'.$role.'/tambahan/'.$item->id)}}" target="_blank" style="font-size: 16px">
                                            {!! getIcon($tambahanExt) !!}
                                            {{$item->filename_tambahan}}
                                        </a>
                                        <br>
                                    @endforeach   
                            @else
                                <p class="text-danger">Belum ada file yang di upload</p> 
                            @endif          
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

@endsection