<!-- #HEADER -->
<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo">
            <img src="{{url('assets/logo.png')}}" alt="E-Reporting" style="float: left;width: 45px; margin-top: -11px;">
            <h1 style="color: white;margin: 0px;"><strong>BIG POP</strong></h1>
        </span>

        <!-- END LOGO PLACEHOLDER -->
    </div>

    <!-- #TOGGLE LAYOUT BUTTONS -->
    <!-- pulled right: nav area -->
    
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->

        <!-- #MOBILE -->
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="#" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" title="Sign Out"><i class="fa fa-sign-out"></i></a> </span>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <!-- end logout button -->

        <!-- notif -->

        <!-- <div class="dropdown" style="float: right; padding: 13px">
            <a role="button" data-toggle="dropdown" id="dropdownMenu1" data-target="uldropdown" style="float: left; padding: 4px" aria-expanded="true">
                <i class="fa fa-bell-o" style="font-size: 20px; float: left; color: black">
                </i>
            </a>
            <span class="badge badge-danger">8</span>
            <ul style="width: 300px;" id="uldropdown" class="dropdown-menu dropdown-menu-left pull-right" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation">
                    <a href="#" class="dropdown-menu-header">Notifikasi</a>
                </li>
                <ul class="timeline timeline-icons timeline-sm" style="margin:10px;height:200px;overflow-y:scroll;">
                    <li>
                        <p>
                            Your “Volume Trendline” PDF is ready <a href="">here</a>
                            <span class="timeline-icon"><i class="fa fa-file-pdf-o" style="color:green"></i></span>
                            <span class="timeline-date">Dec 10, 22:00</span>
                        </p>
                    </li>
                    <li>
                        <p>
                            Your “Marketplace Report” PDF is ready <a href="">here</a>
                            <span class="timeline-icon"><i class="fa fa-file-pdf-o"  style="color:green"></i></span>
                            <span class="timeline-date">Dec 6, 10:17</span>
                        </p>
                    </li>
                    <li>
                        <p>
                            Your “Top Words” spreadsheet is ready <a href="">here</a>
                            <span class="timeline-icon"><i class="fa fa-file-excel-o"  style="color:green"></i></span>
                            <span class="timeline-date">Dec 5, 04:36</span>
                        </p>
                    </li>
                </ul>
                <li role="presentation">
                    <a href="#" class="dropdown-menu-header"></a>
                </li>
            </ul>
        </div> -->

        <!-- end notif -->

    </div>
    <!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->
