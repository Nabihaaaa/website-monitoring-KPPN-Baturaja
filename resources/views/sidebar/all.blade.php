<li class="{{Request::is('dashboard') ? 'active' : '' }}">
    <a href="{{url('dashboard')}}">
        <i class="ti-panel"></i>
        <p>Dashboard</p>
    </a>
</li>

<li class="{{ Request::is('table-kegiatan-all*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#tablesExamples" aria-expanded="{{ Request::is('table-kegiatan-all*') ? 'true' : 'false' }}">
        <i class="ti-view-list-alt"></i>
        <p>
            Table list
            <b class="caret"></b>
        </p>
    </a>
    <div class="{{ Request::is('table-kegiatan-all*') ? 'collapse in' : 'collapse' }}" id="tablesExamples" >
        <ul class="nav">
            <li class="{{Request::is('table-kegiatan-all/umum') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan-all/umum')}}">
                    <span class="sidebar-mini">BU</span>
                    <span class="sidebar-normal">Bagian Umum</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan-all/bank') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan-all/bank')}}">
                    <span class="sidebar-mini">SB</span>
                    <span class="sidebar-normal">Seksi Bank</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan-all/mski') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan-all/mski')}}">
                    <span class="sidebar-mini">SM</span>
                    <span class="sidebar-normal">Seksi MSKI</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan-all/dana') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan-all/dana')}}">
                    <span class="sidebar-mini">SPD</span>
                    <span class="sidebar-normal">Seksi Pencairan Dana</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan-all/vera') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan-all/vera')}}">
                    <span class="sidebar-mini">SV</span>
                    <span class="sidebar-normal">Seksi Vera</span>
                </a>
            </li>
        </ul>
    </div>
</li>

