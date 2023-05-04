<li class="{{Request::is('dashboard') ? 'active' : '' }}">
    <a href="{{url('dashboard')}}">
        <i class="ti-panel"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="{{Request::is('table-kegiatan') ? 'active' : '' }}">
    <a href="{{url('table-kegiatan')}}">
        <i class="ti-view-list-alt"></i>
        <p>Table</p>
    </a>
</li>

