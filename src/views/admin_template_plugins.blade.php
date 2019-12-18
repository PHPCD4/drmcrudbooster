<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->


<script src="{{ asset ('vendor/crudbooster/custom/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>

<script src="{{ asset ('vendor/crudbooster/custom/bower_components/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/Flot/jquery.flot.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/Flot/jquery.flot.resize.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/Flot/jquery.flot.categories.js')}}"></script>

<script src="{{ asset ('vendor/crudbooster/custom/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

<script src="{{ asset ('vendor/crudbooster/custom/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('vendor/crudbooster/jquery.price_format.2.0.min.js')}}"></script>
<script src="{{asset('vendor/crudbooster/assets/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/dist/js/app.js') }}" type="text/javascript"></script>

<!--BOOTSTRAP DATEPICKER-->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datepicker/datepicker3.css') }}">

<!--BOOTSTRAP DATERANGEPICKER-->
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }}">

<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}">
<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<link rel='stylesheet' href='{{ asset("vendor/crudbooster/assets/lightbox/dist/css/lightbox.min.css") }}'/>
<script src="{{ asset('vendor/crudbooster/assets/lightbox/dist/js/lightbox.min.js')}}"></script>

<!--SWEET ALERT-->

<link rel="stylesheet" type="text/css" href="{{asset('vendor/crudbooster/assets/sweetalert/dist/sweetalert.css')}}">

<!--MONEY FORMAT-->


<!--DATATABLE-->
<link rel="stylesheet" href="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datatables/dataTables.bootstrap.css')}}">

<script src="{{ asset ('vendor/crudbooster/assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<!--custom link js-->
<!-- jQuery 3 -->


<script src="{{ asset ('vendor/crudbooster/custom/bower_components/fastclick/lib/fastclick.js')}}"></script>

<script src="{{ asset ('vendor/crudbooster/custom/dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset ('vendor/crudbooster/custom/bower_components/chart.js/Chart.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/chart.js/Chart.Bar.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/chart.js/Chart.Doughnut.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/chart.js/Chart.Line.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/chart.js/Chart.PolarArea.js')}}"></script>
<script src="{{ asset ('vendor/crudbooster/custom/bower_components/chart.js/Chart.Radar.js')}}"></script>



<!-- <script src="{{ asset ('vendor/crudbooster/custom/dist/js/pages/dashboard2.js')}}"></script> -->

<script src="{{ asset ('vendor/crudbooster/custom/dist/js/demo.js')}}"></script>

<script>
    var ASSET_URL = "{{asset('/')}}";
    var APP_NAME = "{{Session::get('appname')}}";
    var ADMIN_PATH = '{{url(config("crudbooster.ADMIN_PATH")) }}';
    var NOTIFICATION_JSON = "{{route('NotificationsControllerGetLatestJson')}}";
    var NOTIFICATION_INDEX = "{{route('NotificationsControllerGetIndex')}}";

    var NOTIFICATION_YOU_HAVE = "{{trans('crudbooster.notification_you_have')}}";
    var NOTIFICATION_NOTIFICATIONS = "{{trans('crudbooster.notification_notification')}}";
    var NOTIFICATION_NEW = "{{trans('crudbooster.notification_new')}}";

    $(function () {
        $('.datatables-simple').DataTable();
    })
    </script>
<script src="{{asset('vendor/crudbooster/assets/js/main.js').'?r='.time()}}"></script>
