@extends('main')
@section('head')
    <title>Edit Table</title>
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
                    <form method="post" enctype="multipart/form-data" action="{{ ($r == 'all') ? url('table-kegiatan-all/'.$table.'/update/tabel/'.$id) : url('table-kegiatan/update/tabel/'.$id)}}"
                    onsubmit="submitBtn.disabled = true; return true;">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label>Kegiatan</label>
                       
                        <select class="selectpicker" data-style="btn btn-block" title={{ $role->kegiatan }} id="kegiatan" name="kegiatan">
                            @foreach($referensi_kegiatan as $kegiatan)
                                <option value="{{ $kegiatan->nama }}" >{{ $kegiatan->nama }}</option>
                            @endforeach
                            <option value="lainnya" >-- Lainnya --</option>
                        </select>
                        
                        <input type="text" class="form-control" id="kegiatan_lainnya" name="kegiatan_lainnya" style="display: none;">
                    </div>
                    
                    <br>
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" placeholder="nama kegiatan" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{$role->nama_kegiatan}}">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Tanggal Pelaksanaan</label>
                        <input type="text" id="tanggal" name="tanggal" class="form-control datepicker" placeholder="Tanggal Pelakasanaan Kegiatan" value="{{date('d-m-y', strtotime($role->tgl_pelaksanaan)) }}" />
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Pukul</label>
                        <input type="text" id="pukul" name="pukul" class="form-control timepicker" placeholder="Pukul Pelakasanaan Kegiatan" value="{{$role->pukul}}"/>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Tempat</label>
                        <input type="text" placeholder="tempat" class="form-control" id="tempat" name="tempat" value="{{$role->tempat}}">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>PIC</label>
                        
                        <select class="selectpicker" data-style="btn btn-block" title={{ $role->pic }} id="pic" name="pic">
                            @foreach($referensi_pegawai as $pegawai)
                                <option value="{{ $pegawai->nama }}" >{{ $pegawai->nama }}</option>
                            @endforeach
                            <option value="lainnya" >-- Lainnya --</option>
                        </select>
                       
                        <input type="text" class="form-control" id="pic_lainnya" name="pic_lainnya" style="display: none;">
                    </div>
                    <br>      
                    <button type="submit" class="btn btn-fill btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection