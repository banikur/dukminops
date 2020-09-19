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
            @elseif(Auth::guard('hrd')->check())
            <li>
                <a href="{{url('master/provinsi-dashboard')}}" title="Master Procinsi"><i class="fa fa-lg fa-fw fa-clone"></i> <span class="menu-item-parent">Master Provinsi</span></a>
            </li>
            <li>
                <a href="{{url('/pangkat-dashboard')}}" title="Master Pangkat"><i class="fa fa-lg fa-fw fa-calculator"></i> <span class="menu-item-parent">Master Pangkat</span></a>
            </li>
            <li>
                <a href="{{url('/jenis-peralatan-dashboard')}}" title="Master Jenis Peralatan"><i class="fa fa-lg fa-fw fa-exclamation-circle"></i> <span class="menu-item-parent">Master Jenis Peralatan</span></a>
            </li>
            @endif
        </ul>


    </nav>



</aside>
<!-- END NAVIGATION -->