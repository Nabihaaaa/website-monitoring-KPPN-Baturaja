@extends('main')
@section('title')
    <a class="navbar-brand" href="{{url('user')}}">
        User
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
                    <form id="allInputsFormValidation" method="post" enctype="multipart/form-data" action="{{url('user/update/'.$table_data->id)}}"
                    onsubmit="submitBtn.disabled = true; return true;">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" placeholder="nip" class="form-control" id="nip" name="nip" value="{{$table_data->nip}}" required="required">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" placeholder="nama" class="form-control" id="nama" name="nama" value="{{$table_data->nama}}" required="required">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="selectpicker" id="role" name="role"  data-style="btn btn-block" required>
                            <option value="Bagian Umum" <?php if($table_data->seksi == 'Bagian Umum') echo 'selected'; ?> >Bagian Umum</option>
                            <option value="Seksi Bank" <?php if($table_data->seksi == 'Seksi Bank') echo 'selected'; ?> >Seksi Bank</option>
                            <option value="Seksi MSKI" <?php if($table_data->seksi == 'Seksi MSKI') echo 'selected'; ?> >Seksi MSKI</option>
                            <option value="Seksi Pencairan Dana" <?php if($table_data->seksi == 'Seksi Pencairan Dana') echo 'selected'; ?> >Seksi Pencairan Dana</option>
                            <option value="Seksi Vera" <?php if($table_data->seksi == 'Seksi Vera') echo 'selected'; ?> >Seksi Vera</option>
                            <option value="Semua Role" <?php if($table_data->seksi == 'Semua Role') echo 'selected'; ?> >Semua Role</option>
                            <option value="Admin" <?php if($table_data->seksi == 'Admin') echo 'selected'; ?> >Admin</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" placeholder="jabatan" class="form-control" id="jabatan" name="jabatan" value="{{$table_data->jabatan}}" required>
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