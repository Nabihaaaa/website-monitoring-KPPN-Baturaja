@extends('main')
@section('head')
    <title>Tambah Referensi Kegiatan</title>
@endsection
@section('title')
    <a class="navbar-brand" href="{{url('referensi/kegiatan')}}">
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
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $table_name }}</h2>
                    <br>
                    <p class="card-category">{{ $table_category }}</p>
                    <legend>
                </div>
                <div class="card-content">
                    <form id="allInputsFormValidation" method="post" enctype="multipart/form-data" action="{{url('referensi/kegiatan/store')}}"
                    onsubmit="submitBtn.disabled = true; return true;">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <input type="text" placeholder="kegiatan" class="form-control" id="kegiatan" name="kegiatan" required="required">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-fill btn-info">Submit</button>
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