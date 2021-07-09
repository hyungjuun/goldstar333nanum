<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $pagetitle }}</title>
    <base href="{{ LibreNMS\Config::get('base_url') }}" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(!LibreNMS\Config::get('favicon', false))
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16">
        <link rel="mask-icon" href="{{ asset('images/safari-pinned-tab.svg') }}" color="#5bbad5">
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    @else
        <link rel="shortcut icon" href="{{ LibreNMS\Config::get('favicon') }}" />
    @endif

    <link rel="manifest" href="{{ asset('images/manifest.json') }}" crossorigin="use-credentials">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-config" content="{{ asset('images/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

{{--    LTE --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/nw/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/nw/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/nw/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="/nw/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
{{--    <link rel="stylesheet" href="/nw/dist/css/adminlte.min.css">--}}
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/nw/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/nw/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/nw/plugins/summernote/summernote-bs4.min.css">


{{--    기존 --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/jquery.bootgrid.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/tagmanager.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/mktree.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/vis.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('css/jquery.gridster.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/leaflet.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/MarkerCluster.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/MarkerCluster.Default.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/L.Control.Locate.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/leaflet.awesome-markers.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />--}}
{{--    <link href="{{ asset('css/query-builder.default.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset(LibreNMS\Config::get('stylesheet', 'css/styles.css')) }}?ver=20191124" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/' . LibreNMS\Config::get('applied_site_style', 'light') . '.css?ver=632417642') }}" rel="stylesheet" type="text/css" />
{{--    hyungjuun --}}
    <link href="{{ asset('css/nwadmin.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
{{--    <link rel="stylesheet" href="http://210.116.101.13:8080/resources/dist/css/adminlte.min.css">--}}

    <!-- DataTables -->
    <link href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    @foreach(LibreNMS\Config::get('webui.custom_css', []) as $custom_css)
        <link href="{{ $custom_css }}" rel="stylesheet" type="text/css" />
    @endforeach
    @yield('css')
    @stack('styles')

    <script src="{{ asset('js/polyfill.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('js/hogan-2.0.0.js') }}"></script>
    <script src="{{ asset('js/jquery.cycle2.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/tagmanager.js') }}"></script>
    <script src="{{ asset('js/mktree.js') }}"></script>
    <script src="{{ asset('js/jquery.bootgrid.min.js') }}"></script>
    <script src="{{ asset('js/handlebars.min.js') }}"></script>
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    {{-- hyungjuun add   --}}
    <script src="{{ asset('js/chart/Chart.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>


<!-- jQuery -->
{{--    <script src="/nw/plugins/jquery/jquery.min.js"></script>--}}
    <!-- jQuery UI 1.11.4 -->
{{--    <script src="/nw/plugins/jquery-ui/jquery-ui.min.js"></script>--}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{--    <script>--}}
{{--        $.widget.bridge('uibutton', $.ui.button)--}}
{{--    </script>--}}
    <!-- Bootstrap 4 -->
{{--    <script src="/nw/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

    <!-- Sparkline -->
{{--    <script src="/nw/plugins/sparklines/sparkline.js"></script>--}}
    <!-- JQVMap -->
{{--    <script src="/nw/plugins/jqvmap/jquery.vmap.min.js"></script>--}}
{{--    <script src="/nw/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>--}}
    <!-- jQuery Knob Chart -->
{{--    <script src="/nw/plugins/jquery-knob/jquery.knob.min.js"></script>--}}
    <!-- daterangepicker -->
    <script src="/nw/plugins/moment/moment.min.js"></script>
    <script src="/nw/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Tempusdominus Bootstrap 4 -->
{{--    <script src="/nw/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
    <!-- Summernote -->
{{--    <script src="/nw/plugins/summernote/summernote-bs4.min.js"></script>--}}
    <!-- overlayScrollbars -->
{{--    <script src="/nw/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}



    <!-- Ekko Lightbox -->
    <script src="/nw/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/nw/dist/js/adminlte.js"></script>
    <!-- Filterizr-->
    <script src="/nw/plugins/filterizr/jquery.filterizr.min.js"></script>


    {{-- AdminLTE for demo purposes --}}
    {{--    <script src="/nw/dist/js/demo.js"></script>--}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--    <script src="/nw/dist/js/pages/dashboard.js"></script>--}}


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var ajax_url = "{{ url('/ajax') }}";
    </script>
    <script src="{{ asset('js/librenms.js?ver=20200501') }}"></script>
    <script type="text/javascript">
        <!-- Begin
        function popUp(URL)
        {
            day = new Date();
            id = day.getTime();
            eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=550,height=600');");
        }
        // End -->
    </script>
    <script type="text/javascript" src="{{ asset('js/overlib_mini.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/boot.js') }}"></script>
    @yield('javascript')
</head>
<body>
@if(Auth::check())
    <script>updateResolution();</script>
@endif

@if(Request::get('bare') == 'yes')
    <style>body { padding-top: 0 !important; padding-bottom: 0 !important; }</style>
@elseif($show_menu)

    @include('layouts.menu')
    1111

@endif

<br />

@yield('content')

@include('layouts.footer')

@yield('scripts')

{!! Toastr::render() !!}

@stack('scripts')
</body>
</html>
