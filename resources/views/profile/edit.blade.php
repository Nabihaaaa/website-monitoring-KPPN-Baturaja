@extends('main')

@section('title')
<a class="navbar-brand" href="{{url('profile')}}">
    Edit Profile
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
@include('profile.partials.update-profile-information-form')
    
@include('profile.partials.update-password-form')
@endsection