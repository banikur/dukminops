<!DOCTYPE html>
<html lang="en-us">
    @include('template.backend.header.header_script') {{-- CSS --}}
    <body class="desktop-detected pace-done smart-style-2 fixed-page-footer">
            <!-- MAIN CONTENT -->
            <div id="content">
                <ol class="breadcrumb">
                    @yield('ribbon')
                </ol>
                @yield('content')
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        @include('template.backend.footer.footer_script') {{-- JS --}}
        @yield('js')
    </body>
</html>
