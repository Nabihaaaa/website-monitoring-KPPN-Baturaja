<div class="info">
    <div class="photo">
        @if($user->photo == null)
            <img src="{{asset('assets/img/faces/user.png')}}" />
        @else
            <img src="{{'data:image/jpeg;base64,' . base64_encode($user->photo)}}" />
        @endif
    </div>
    <a data-toggle="collapse" href="#collapseExample" aria-expanded="{{ Request::is('profile*') ? 'true' : 'false' }}">
        <span>
            {{$user->nama}}
            <b class="caret"></b>
        </span>
    </a>
    <div class="clearfix"></div>
    <div id="collapseExample" class="{{ Request::is('profile*') ? 'collapse in' : 'collapse' }}">
        <ul class="nav">
            <li class="{{Request::is('profile/my-profile') ? 'active' : '' }}">
                <a href="{{url('/profile/my-profile')}}">
                    <span class="sidebar-mini">Mp</span>
                    <span class="sidebar-normal">My Profile</span>
                </a>
            </li>
            <li class="{{Request::is('profile') ? 'active' : '' }}">
                <a href="{{url('/profile')}}">
                    <span class="sidebar-mini">Ep</span>
                    <span class="sidebar-normal">Edit Profile</span>
                </a>
            </li>
        </ul>
    </div>
</div>