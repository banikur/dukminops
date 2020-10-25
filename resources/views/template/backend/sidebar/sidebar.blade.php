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
            <li>
                <a href="{{url('/daftar-sarpas-unras')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Intelijen Terpusat</span></a>
            </li>
            <li>
                <a href="{{url('/operasi-inteligen-wilayah')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Intelijen Wilayah</span></a>
            </li>
            <li>
                <a href="{{url('/entry-operasi')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Wilayah</span></a>
            </li>
            @elseif(Auth::guard('hrd')->check())
            <?php
            $data = DB::table('users_detail')->where('id_user', Auth::guard('hrd')->user()->id)->count();
            ?>
            <li>
                <a href="{{url('/dashboard-hrd')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-tachometer"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            @if($data == 0)

            <li>
                <a href="{{url('master/provinsi-dashboard')}}" title="Master Provinsi"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Provinsi</span></a>
            </li>
            <!-- <li>
                <a href="{{url('master/pangkat-dashboard')}}" title="Master Pangkat"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Pangkat</span></a>
            </li> -->
            <li>
                <a href="{{url('master/jenis-peralatan-dashboard')}}" title="Master Jenis Peralatan"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Jenis Peralatan</span></a>
            </li>
            <li>
                <a href="{{url('/user-management')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">User Management</span></a>
            </li>
            @else
            <li>
                <a href="{{url('/list-operasi-all')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Pusat</span></a>
            </li>
            @endif

            @endif
        </ul>


    </nav>



</aside>
<!-- END NAVIGATION -->