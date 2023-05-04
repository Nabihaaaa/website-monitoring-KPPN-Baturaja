<li class="{{Request::is('dashboard') ? 'active' : '' }}">
    <a href="{{url('dashboard')}}">
        <i class="ti-panel"></i>
        <p>Dashboard</p>
    </a>
    
</li>

<li class="{{ Request::is('table-kegiatan*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#tablesExamples" aria-expanded="{{ Request::is('table-kegiatan*') ? 'true' : 'false' }}">
        <i class="ti-view-list-alt"></i>
        <p>
            Table list
            <b class="caret"></b>
        </p>
    </a>
    <div class="{{ Request::is('table-kegiatan*') ? 'collapse in' : 'collapse' }}" id="tablesExamples" >
        <ul class="nav">
            <li class="{{Request::is('table-kegiatan/bagian-umum') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan/bagian-umum')}}">
                    <span class="sidebar-mini">BU</span>
                    <span class="sidebar-normal">Bagian Umum</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan/seksi-bank') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan/seksi-bank')}}">
                    <span class="sidebar-mini">SB</span>
                    <span class="sidebar-normal">Seksi Bank</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan/seksi-mski') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan/seksi-mski')}}">
                    <span class="sidebar-mini">SM</span>
                    <span class="sidebar-normal">Seksi MSKI</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan/seksi-pencairan-dana') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan/seksi-pencairan-dana')}}">
                    <span class="sidebar-mini">SPD</span>
                    <span class="sidebar-normal">Seksi Pencairan Dana</span>
                </a>
            </li>
            <li class="{{Request::is('table-kegiatan/seksi-vera') ? 'active' : '' }}">
                <a href="{{url('table-kegiatan/seksi-vera')}}">
                    <span class="sidebar-mini">SV</span>
                    <span class="sidebar-normal">Seksi Vera</span>
                </a>
            </li>
        </ul>
    </div>
</li>


<li class="{{ Request::is('referensi*') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#referensi" aria-expanded="{{ Request::is('referensi*') ? 'true' : 'false' }}">
        <i class="ti-clipboard"></i>
        <p>
            Referensi
            <b class="caret"></b>
        </p>
    </a>
    <div class="{{ Request::is('referensi*') ? 'collapse in' : 'collapse' }}" id="referensi">
        <ul class="nav">
            <li class="{{Request::is('referensi/kegiatan') ? 'active' : '' }}">
                <a href="{{url('referensi/kegiatan')}}">
                    <span class="sidebar-mini">K</span>
                    <span class="sidebar-normal">Kegiatan</span>
                </a>
            </li>
            <li class="{{Request::is('referensi/pegawai') ? 'active' : '' }}">
                <a href="{{url('referensi/pegawai')}}">
                    <span class="sidebar-mini">P</span>
                    <span class="sidebar-normal">Pegawai</span>
                </a>
            </li>
        </ul>
    </div>    
</li>

<li class="{{ Request::is('user*') ? 'active' : '' }}">
    <a href="{{url('user')}}">
        <i class="ti-user"></i>
        <p>
            User
        </p>
    </a>
</li>

