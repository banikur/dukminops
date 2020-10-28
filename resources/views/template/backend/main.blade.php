<!DOCTYPE html>
<html lang="en-us">
    @include('template.backend.header.header_script') {{-- CSS --}}
    <body class="desktop-detected pace-done smart-style-1 fixed-page-footer">
        @include('template.backend.header.header') {{-- Header --}}
        @include('template.backend.sidebar.sidebar') {{-- Sidebar --}}
        <div id="main" role="main">
            <!-- MAIN CONTENT -->
            <div id="content">
                <ol class="breadcrumb">
                    @yield('ribbon')
                </ol>
                @yield('content')
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        @include('template.backend.footer.footer') {{-- Footer --}}
        @include('template.backend.footer.footer_script') {{-- JS --}}
        @yield('js')
    </body>
</html>
