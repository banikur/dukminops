<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel" >
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
            @if(Auth::guard('user')->user()->id_polda == null && Auth::guard('user')->user()->id_polres == null)
            <li>
                <a href="#pusat"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Terpusat</a>
                <ul>
                    <li>
                        <a href="{{url('/daftar-sarpas-unras/ops-intelejen')}}" title="Operasi Intelijen"><span class="menu-item-parent">Operasi Intelijen</span></a>
                    </li>
                    <li>
                        <a href="{{url('/daftar-sarpas-unras/ops-penegakan')}}" title="Operasi Penegakan Hukum"><span class="menu-item-parent">Operasi Penegakan Hukum</span></a>
                    </li>
                    <li>
                        <a href="{{url('/daftar-sarpas-unras/ops-pengamanan')}}" title="Operasi Pengamanan Kegiatan"><span class="menu-item-parent">Operasi Pengamanan Kegiatan</span></a>
                    </li>
                    <li>
                        <a href="{{url('/daftar-sarpas-unras/ops-pemeliharaan')}}" title="Operasi Pemeliharaan Keamanan"><span class="menu-item-parent">Operasi Pemeliharaan Keamanan</span></a>
                    </li>
                    <li>
                        <a href="{{url('/daftar-sarpas-unras/ops-pemulihan')}}" title="Operasi Kontijensi Keamanan"><span class="menu-item-parent">Operasi Kontijensi Keamanan</span></a>
                    </li>
                </ul>
            </li>
            @endif
            <li>
                <a href="#wilayah"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Operasi Wilayah</a>
                <ul>
                    <li>
                        <a href="{{url('/operasi-inteligen-wilayah/ops-intelejen')}}" title="Operasi Intelijen"><span class="menu-item-parent">Operasi Intelijen</span></a>
                    </li>
                    <li>
                        <a href="{{url('/operasi-inteligen-wilayah/ops-penegakan')}}" title="Operasi Penegakan Hukum"><span class="menu-item-parent">Operasi Penegakan Hukum</span></a>
                    </li>
                    <li>
                        <a href="{{url('/operasi-inteligen-wilayah/ops-pemeliharaan')}}" title="Operasi Pengamanan Kegiatan"><span class="menu-item-parent">Operasi Pengamanan Kegiatan</span></a>
                    </li>
                    <li>
                        <a href="{{url('/operasi-inteligen-wilayah/ops-pemeliharaan')}}" title="Operasi Pemeliharaan Keamanan"><span class="menu-item-parent">Operasi Pemeliharaan Keamanan</span></a>
                    </li>
                    <li>
                        <a href="{{url('/operasi-inteligen-wilayah/ops-pemulihan')}}" title="Operasi Kontijensi Keamanan"><span class="menu-item-parent">Operasi Kontijensi Keamanan</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{url('/entry-operasi')}}" title="Sarpas Unras"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Lapor Operasi</span></a>
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
            <li>
                <a href="{{url('master/pangkat-dashboard')}}" title="Master Pangkat"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Pangkat</span></a>
            </li>
            <li>
                <a href="{{url('master/jenis-peralatan-dashboard')}}" title="Master Jenis Peralatan"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Jenis Peralatan</span></a>
            </li>
            <li>
                <a href="{{url('master/jenis_operasi')}}" title="Master Provinsi"><i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">Master Jenis Operasi</span></a>
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