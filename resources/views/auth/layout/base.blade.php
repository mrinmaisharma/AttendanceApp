<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>"@yield('title') | Attendance Portal</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-sm.ico">
    <!-- Custom Stylesheet -->
    <link href="/css/all.css" rel="stylesheet">
</head>

<body  class="h-100" data-page-id="@yield('data-page-id')">
    
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
    @yield('content')
    
<script type="text/javascript" src="/js/all.js"></script>
<script type="text/javascript" src="/plugins/common/common.min.js"></script>
<script type="text/javascript" src="/js/custom.min.js"></script>
<script type="text/javascript" src="/js/settings.js"></script>
<script type="text/javascript" src="/js/gleek.js"></script>
<script type="text/javascript" src="/js/styleSwitcher.js"></script>

</body>
</html>