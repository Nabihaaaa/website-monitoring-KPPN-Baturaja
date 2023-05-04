@extends('main')
@section('head')
    <title>Upload Bukti</title>
@endsection
@section('title')
    @if ($role == 'all')
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
@if ($role == 'all')
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
                    <form id="allInputsFormValidation" method="post" action="{{ ($role == 'all') ? url('/table-kegiatan-all/'.$table.'/store/'.$id) 
                        : url('table-kegiatan/store/'.$id) }}" 
                            enctype="multipart/form-data" onsubmit="return validateForm()">
                            @method('patch')
                            @csrf

                        <div class="form-group">
                            <label for="tanggal">Realisasi Pelaksanaan</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control datepicker" placeholder="Realisasi Pelakasanaan Kegiatan" required />
                        </div>

                        <div class="form-group">
                            <label for="absensi">Absensi</label>
                            <input type="file" class="form-control" id="absensi" name="absensi">
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>

                        <div class="form-group">
                            <label for="notulensi">Notulensi</label>
                            <input type="file" class="form-control" id="notulensi" name="notulensi">
                        </div>

                        <div class="form-group">
                            <label for="tambahan">Tambahan</label>
                            <input type="file" class="form-control" id="tambahan" name="tambahan[]" multiple>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-fill btn-info">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $().ready(function(){
            $('#allInputsFormValidation').validate();
        });
    </script>
@endsection