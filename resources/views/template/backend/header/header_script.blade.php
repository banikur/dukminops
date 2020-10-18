<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/font-awesome.min.css')}}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/smartadmin-production-plugins.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/smartadmin-production.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/smartadmin-skins.min.css')}}">

    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/smartadmin-rtl.min.css')}}">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    {{-- <link rel="stylesheet" type="text/css" media="screen" href="{{url('backend_layout/css/demo.min.css')}}">--}}
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{url('backend_layout/img/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('backend_layout/img/favicon/favicon.ico')}}" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #FLATPICKR -->
    <link rel="stylesheet" type="text/css" href="{{url('backend_layout/css/flatpickr/flatpickr.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('backend_layout/css/flatpickr/style.css')}}">

    <!-- #NOTIF -->
    <link rel="stylesheet" type="text/css" href="{{url('backend_layout/css/notif/notif.css')}}">

    <!-- #Loader -->
    <link rel="stylesheet" type="text/css" href="{{url('backend_layout/css/loader/style.css')}}">
    @yield('css')
    <style>
        .login100-form-logo img {
            max-height: 120px;
            max-width: 120px
        }

        .btnround {
            display: block;
            height: 170px;
            width: 170px;
            border-radius: 50%;
            border: 3px solid #2C3742;
            justify-content: center;
            align-items: center;
        }

        .btnround:hover {
            border: 3px solid #e4e4e4;
        }

        .btn img {
            margin-top: 10px;
            max-height: 130px;
            max-width: 130px;
        }

        .jarviswidget-color-magenta .nav-tabs li:not(.active) a,
        .jarviswidget-color-magenta>header>.jarviswidget-ctrls a {
            color: #000 !important;
        }
    </style>

</head>