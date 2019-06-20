<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attendance Portal | "@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-sm.ico">
    <!-- Pignose Calender -->
    <!-- <link href="/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet"> -->
    <!-- Chartist -->
    <link rel="stylesheet" href="/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="/icon/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/icon/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="/icon/weather-icons/css/weather-icons.min.css" rel="stylesheet">
    <link href="/icon/cryptocoins/css/cryptocoins.css" rel="stylesheet">
    <link href="/icon/cryptocoins/css/cryptocoins-colors.css" rel="stylesheet">
    <link href="/icon/linea-icons/linea.css" rel="stylesheet">
    <link href="/icon/ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/icon/themify-icons/themify-icons.css" rel="stylesheet">
    <link href="/icon/flag-icon-css/flag-icon.min.css" rel="stylesheet">
    <link href="/icon/material-design-iconic-font/materialdesignicons.min.css" rel="stylesheet">
    <link href="/icon/pe-icon-set-weather/css/pe-icon-set-weather.min.css" rel="stylesheet">
    <link href="/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet">
    <link href="/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

</head>

<body data-page-id="@yield('data-page-id')">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        @include('includes.app.navbar')
        @include('includes.app.sidebar')
        <div class="content-body" style="min-height: 788px;">
        <!-- Main -->
            @yield('content')
        </div>
        @include('includes.app.footer')

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    
<!-- <script type="text/javascript" src="/js/admin/all.js"></script> -->
<script type="text/javascript" src="/plugins/common/common.min.js"></script>
<script type="text/javascript" src="/js/custom.min.js"></script>
<script type="text/javascript" src="/js/settings.js"></script>
<script type="text/javascript" src="/js/gleek.js"></script>
<script type="text/javascript" src="/js/styleSwitcher.js"></script>

<!-- Chartjs -->
<script type="text/javascript" src="/plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script type="text/javascript" src="/plugins/circle-progress/circle-progress.min.js"></script>
<!-- Morrisjs -->
<script type="text/javascript" src="/plugins/raphael/raphael.min.js"></script>
<script type="text/javascript" src="/plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script type="text/javascript" src="/plugins/moment/moment.min.js"></script>
<script type="text/javascript" src="/plugins/pg-calendar/js/pignose.calendar.min.js"></script>

<!-- <script type="text/javascript" src="/js/dashboard/dashboard-1.js"></script> -->


</body>
</html>