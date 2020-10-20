<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">
    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->
        <ul>
            <br /><br /><br />
        </ul>
        <ul>
            @if(Auth::guard('perusahaan')->check())

            @elseif(Auth::guard('user')->check())
            <li>
                <a href="{{url('/dashboard-user')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <!-- <li>
                <a href="{{url('/daftar-sarpas-unras')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Data SARPAS UNRAS</span></a>
            </li> -->
            <li>
                <a href="{{url('/entry-operasi')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Wilayah</span></a>
            </li>
            @elseif(Auth::guard('hrd')->check())
            <li>
                <a href="{{url('/dashboard-hrd')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-tachometer"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            <!-- <li>
                <a href="{{url('/employee-dashboard')}}" title="Data Pegawai"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Pegawai</span></a>
            </li>
            <li>
                <a href="{{url('/absence-dashboard')}}" title="Data Absensi Pegawai"><i class="fa fa-lg fa-fw fa-archive"></i> <span class="menu-item-parent">Absensi Pegawai</span></a>
            </li>
            <li>
                <a href="{{url('/payroll-dashboard')}}" title="Master Gaji"><i class="fa fa-lg fa-fw fa-credit-card "></i> <span class="menu-item-parent">Upah Pegawai</span></a>
            </li>
            <li>
                <a href="{{url('/penilaian-pegawai-dashboard')}}" title="Peniliain Pegawai"><i class="fa fa-lg fa-fw fa-check"></i> <span class="menu-item-parent">Penilaian Pegawai</span></a>
            </li> -->
            <li>
                <a href="{{url('master/provinsi-dashboard')}}" title="Master Provinsi"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Provinsi</span></a>
            </li>
            <li>
                <a href="{{url('master/pangkat-dashboard')}}" title="Master Pangkat"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Pangkat</span></a>
            </li>
            <li>
                <a href="{{url('master/jenis-peralatan-dashboard')}}" title="Master Jenis Peralatan"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Jenis Peralatan</span></a>
            </li>
            <li>
                <a href="{{url('/list-operasi-all')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Pusat</span></a>
            </li>
            <li>
                <a href="{{url('/user-management')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">User Management</span></a>
            </li>
            @endif
        </ul>


    </nav>



</aside>
<!-- END NAVIGATION -->