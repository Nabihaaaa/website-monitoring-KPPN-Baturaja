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
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ $table_name }}</h2>
                    <br>
                    <p class="card-category">{{ $table_category }}</p>
                    <legend>
                </div>
                <div class="card-content">
                    <form id="allInputsFormValidation" method="post" enctype="multipart/form-data" action="{{url('referensi/pegawai/update/'.$id)}}"
                    onsubmit="submitBtn.disabled = true; return true;">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label>Role</label>
                        <select class="selectpicker" id="seksireferensi" name="seksireferensi"  data-style="btn btn-block" title="Pilih Role" required>
                            <option value="Bagian Umum">Bagian Umum</option>
                            <option value="Seksi Bank">Seksi Bank</option>
                            <option value="Seksi MSKI">Seksi MSKI</option>
                            <option value="Seksi Pencairan Dana">Seksi Pencairan Dana</option>
                            <option value="Seksi Vera">Seksi Vera</option>
                            <option value="Semua Role">Semua Role</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Nama</label>
                        <div id="nama-container">
                            <input type="text" placeholder="nama" class="form-control" id="nama" name="nama" disabled>
                        </div>
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

@section('script')
    <script type="text/javascript">
        $().ready(function(){
            $('#allInputsFormValidation').validate();
        });
    </script>
@endsection