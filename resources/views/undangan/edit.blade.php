@extends('main')

@section('head')
    <title>Edit Undangan</title>
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
                    <form method="post" action="{{ ($role == 'all') ? url('table-kegiatan-all/'.$table.'/update/undangan/'.$id) 
                        : url('table-kegiatan/update/undangan/'.$id) }}" 
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                        <div class="form-group">
                            <label for="undangan">Undangan</label>
                            <input type="file" class="form-control" id="undangan" name="undangan" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-fill btn-info" style="width: 10%">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection