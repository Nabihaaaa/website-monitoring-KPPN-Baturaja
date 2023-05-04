@extends('main')
@section('head')
    <title>Edit Bukti</title>
@endsection
@section('title')
    @if ($r == 'all')
        <a class="navbar-brand" href="{{url('table-kegiatan-all/'.$route)}}">
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
                    <form method="post" action="{{ ($r == 'all') ? url('table-kegiatan-all/'.$route.'/update/'.$id) : url('table-kegiatan/update/'.$id) }}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pelaksanaan</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control datepicker" placeholder="Tanggal Pelakasanaan Kegiatan" value="{{date('d-m-y', strtotime($table->realisasi_pelaksanaan)) }}" />
                        </div>
                        <p>Tanggal Pelaksanaan Sebelumnya:</p>
                        <p class="text-info">{{date('d F Y', strtotime($table->realisasi_pelaksanaan))}}</p>
                        
                        <div class="form-group">
                            <label for="absensi">Absensi</label>
                            <input type="file" class="form-control" id="absensi" name="absensi">
                        </div>

                        <p>File Absensi Sebelumnya:</p> 
                                @if($data->absensi)
                                    <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/absensi')}}" target="_blank" style="font-size: 16px">
                                        {!! getIcon($absensiExt) !!}
                                        {{$data->filename_absensi}}
                                    </a>
                                @else
                                    <p class="text-danger">Belum ada file yang di upload</p> 
                                @endif
                                <br>
                                <br>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <p>File Foto Sebelumnya:</p> 
                                @if($data->foto)
                                    <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/absensi')}}" target="_blank" style="font-size: 16px">
                                        {!! getIcon($fotoExt) !!}
                                        {{$data->filename_foto}}
                                    </a>
                                @else
                                    <p class="text-danger">Belum ada file yang di upload</p> 
                                @endif
                                <br>
                                <br>

                        <div class="form-group">
                            <label for="notulensi">Notulensi</label>
                            <input type="file" class="form-control" id="notulensi" name="notulensi">
                        </div>
                        <p>File Notulensi Sebelumnya:</p> 
                                @if($data->notulensi)
                                    <a href="{{url('/table-kegiatan/bukti/'.$id.'/'.$role.'/absensi')}}" target="_blank" style="font-size: 16px">
                                        {!! getIcon($notulensiExt) !!}
                                        {{$data->filename_notulensi}}
                                    </a>
                                @else
                                    <p class="text-danger">Belum ada file yang di upload</p> 
                                @endif
                                <br>
                                <br>

                        <div class="form-group">
                            <label for="tambahan">Tambahan</label>
                            <input type="file" class="form-control" id="tambahan" name="tambahan[]" multiple>
                        </div>
                        <p>File Tambahan Sebelumnya:</p>
                        @if($tambahan != null)
                                    @foreach ($tambahan as $item)
                                        @php
                                            $tambahanExt = pathinfo($item->filename_tambahan, PATHINFO_EXTENSION);
                                        @endphp
                                        <a href="{{url('table-kegiatan/bukti/'.$id.'/'.$role.'/tambahan/'.$item->id)}}" target="_blank">
                                            {!! getIcon($tambahanExt) !!}
                                            {{$item->filename_tambahan}}
                                        </a>
                                        <br>
                                    @endforeach   
                            @else
                                <p class="text-danger">Belum ada file yang di upload</p> 
                            @endif 

                        <br>
                        <button type="submit" class="btn btn-fill btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection