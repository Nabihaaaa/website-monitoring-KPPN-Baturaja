@extends('main')

@section('title')
<a class="navbar-brand" href="{{url('/profile/my-profile')}}">
    Profile Anda
</a>
@endsection

@section('sidebar')
    @if ($user->seksi == 'Admin')
        @include('sidebar.admin')
    @elseif($user->seksi == 'Semua Role')
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
                    <h2 class="card-title">My Profile</h2>
                    <br>
                    <p class="card-category">Informasi akun anda.</p>
                    <legend>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-md-4 ">
                            @if($user->photo == null)
                                <img src="{{asset('assets/img/faces/user1.png')}}" style="border: 2px solid #66615b; padding: 5px;"/>
                            @else
                                <?php
                                    $resizedImage = Image::make($user->photo)->fit(400, 400)->encode('data-url');
                                ?>
                                <img src="{{$resizedImage}}" style=" border: 2px solid #66615b; padding: 5px;"/>
                            @endif
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                            <div class="row">
                                <div class="form-group">
                                    <label for="nama" >NIP</label>
                                    <p class="form-control">{{$user->nip}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="nama" >Nama</label>
                                    <p class="form-control">{{$user->nama}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="seksi" >Bagian / Seksi</label>
                                    <p class="form-control">{{$user->seksi}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <p class="form-control">{{$user->jabatan}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="email" >Email</label>
                                    <p class="form-control">{{$user->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
