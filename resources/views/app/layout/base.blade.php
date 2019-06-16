<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attendance Portal | Arbre Creations</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <!-- <link href="/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet"> -->
    <!-- Chartist -->
    <link rel="stylesheet" href="/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<body data-page-id="@yield('data-page-id')">
    
    <div id="wrapper">

        <!-- Main -->
            @yield('content')

        @include('includes.admin.sidebar')

    </div>
    
<script type="text/javascript" src="/js/admin/all.js"></script>
<script type="text/javascript" src="/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/admin/browser.min.js"></script>
<script type="text/javascript" src="/js/admin/breakpoints.min.js"></script>
<script type="text/javascript" src="/js/admin/util.js"></script>
<script type="text/javascript" src="/js/admin/main.js"></script>
<script type="text/javascript" src="/fontawesome/js/all.js"></script>
<script type="text/javascript" src="/datatables.net/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        var id;
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#selected_image').attr('src', e.target.result);
        }
        var readerCustom = new FileReader();
        readerCustom.onload = function (e) {
            $('#selected_image'+id).attr('src', e.target.result);
        }
        var reader2 = new FileReader();
        reader2.onload = function (e) {
            $('#selected_image2').attr('src', e.target.result);
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
        function readURLCustom(input) {
            if (input.files && input.files[0]) {
                readerCustom.readAsDataURL(input.files[0]);
            }
        }
        function readURL2(input) {
            if (input.files && input.files[0]) {
                reader2.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function(){
            readURL(this);
        });
        $(".imgInp").change(function(){
            id=$(this).data('id');
            readURLCustom(this);
        });
        $("#imgInp2").change(function(){
            readURL2(this);
        });

        $('#category-table').DataTable({
            'ordering' : true
        });
        $('#webinar-links-table').DataTable({
            'ordering' : true
        });
        $('#courses-table').DataTable({
            'ordering' : true
        });
        $('#topic-table').DataTable({
            'ordering' : true
        });
        $('#subtopic-table').DataTable({
            'ordering' : true
        });
        
        $('.ui.accordion')
          .accordion()
        ;
  })
</script>
</body>
</html>