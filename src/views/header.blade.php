<!-- Main Header -->
<header class="main-header">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('vendor/crudbooster/assets/bootstrap-toggle/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.css"
        integrity="sha256-OYXGS5m4oWZAAqoAKpf7Y3bIdzdd9jBfly/xCavEpGw=" crossorigin="anonymous" />

    <style>
        .notification-header {
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            background-color: #ffffff;
            padding: 7px 10px;
            border-bottom: 1px solid #f4f4f4;
            color: #444444;
            font-size: 14px;
        }

        .dropdown-menu>li>a:hover {
            background-color: #f39c12;
            color: #fff;
            transition: .5s;
        }

        .dropdown-menu>li {
            transition: .5s;
        }

        /******Toggle Button******/

        .onoffswitch {
            position: relative;
            width: 56px;
            margin: 11px 0;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .onoffswitch-checkbox {
            display: none;
        }

        .onoffswitch-label {
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #ffffff;
            border-radius: 20px;
        }

        .onoffswitch-inner {
            display: block;
            width: 200%;
            margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }

        .onoffswitch-inner:before,
        .onoffswitch-inner:after {
            display: block;
            float: left;
            width: 50%;
            height: 22px;
            padding: 0;
            line-height: 22px;
            font-size: 12px;
            color: black;
            font-family: Trebuchet, Arial, sans-serif;
            font-weight: bold;
            box-sizing: border-box;
        }

        .onoffswitch-inner:before {
            content: "ON";
            padding-left: 6px;
            background-color: #398439;
            color: #ffffff;
        }

        .onoffswitch-inner:after {
            content: "OFF";
            padding-right: 6px;
            background-color: #E50000;
            color: #ffffff;
            text-align: right;
        }

        .onoffswitch-switch {
            display: block;
            width: 12px;
            margin: 5px;
            background: #ffffff;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 30px;
            border: 2px solid #ffffff;
            border-radius: 20px;
            transition: all 0.3s ease-in 0s;
        }

        .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }

        .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-switch {
            right: 0px;
        }

        .pb-btn {
            border-radius: 5px;
            outline: none !important;
            box-shadow: none;
            border: none;
            margin: 11px 6px 0 0;
            padding: 3px 8px;
        }

        #iframeModal .modal-content {
            background: no-repeat;
            outline: 0;
            box-shadow: none;
        }

        .video_modal .modal-header {
            border-bottom-color: none !important;
            border: none !important;
        }

        .video_modal .close span {
            position: relative;
            top: 58px;
            right: -115px;
            border: 1px solid #fff;
            padding: 5px 10px;
            color: #fff !important;
            z-index: 999;
        }

        .video-link {
            padding-top: 70px;
        }

        .video-link a:hover,
        .video-link a:focus {
            outline: 0;
        }

        a .video-link-text {
            color: #fff;
            opacity: 0.8;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            -ms-transition: all .3s;
            transition: all .3s;
        }

        a:hover .video-link-text,
        a:focus .video-link-text {
            outline: 0;
            color: #fff;
            opacity: 1;
            border-bottom: 1px dotted #fff;
        }

        a .video-link-icon {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 50px;
            margin-right: 10px;
            background: #e89a3e;
            color: #fff;
            line-height: 50px;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
            -ms-transition: all .3s;
            transition: all .3s;
        }

        a .video-link-icon:after {
            position: absolute;
            content: "";
            top: -6px;
            left: -6px;
            width: 66px;
            height: 66px;
            background: #444;
            background: rgba(0, 0, 0, 0.1);
            z-index: -99;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        a:hover .video-link-icon,
        a:focus .video-link-icon {
            outline: 0;
            background: #fff;
            color: #e89a3e;
        }

        a:hover,
        span:hover {
            text-decoration: none !important;
        }

        a:focus,
        span:focus {
            text-decoration: none !important;
        }

        /*notification list hove style*/
        .slimScrollDiv ul li a {
            transition: .5s;
        }

        .slimScrollDiv ul li a:hover {
            background: #f39c12 !important;
            color: #fff !important;
            transition: .5s;
        }

        .slimScrollDiv ul li a:hover i {
            color: #fff !important;
        }

        .slimScrollDiv ul li a i {
            transition: .5s;
            color: #f39c12 !important;
        }

        /*Notification scroll bar style*/
        .slimScrollDiv>.menu::-webkit-scrollbar {
            width: 10px;
        }

        .slimScrollDiv>.menu::-webkit-scrollbar-thumb {
            background-color: #E0E0E0;
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .slimScrollDiv>.menu::-webkit-scrollbar-track {
            background-color: #F1F1F1;
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .fs-button-input-style {
            background: #d2d2d2 !important;
            color: #fff;
            font-weight: 500;
            padding: 6px 12px;
            cursor: pointer;
        }

        .fs-button-input-style input {
            position: relative;
            top: 2px;
        }

        .all-noti-btn:hover {
            color: #f39c12 !important;
        }

        /* Intro Js Style */
        .introjs-helperNumberLayer {
            top: 4px;
            left: -10px;
        }

        .dropdown-style li a {
            padding: 8px 20px;
            border-bottom: 1px solid #dedbdb;
        }

        .logout-btn {
            background: #f39c12 !important;
            color: #fff !important;
        }

        .logout-btn:hover {
            background: #e28b03 !important;
            transition: .5s;
        }
    </style>
    <!-- Logo -->
    <!--<a  href="{{url(config('crudbooster.ADMIN_PATH'))}}" title='{{Session::get('appname')}}' class="logo">{{CRUDBooster::getSetting('appname')}}</a>-->

    <a href="{{url(config('crudbooster.ADMIN_PATH'))}}" title='{{Session::get('appname')}}' class="logo">
        <img src="/images/logo.png" width="50px" height="50px" style="margin-left: -90px;">
        <h1 style="margin-top: -48px;margin-left: 37px;">DRM</h1>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">

            @php
            $data = Session::all();
            $logged_as_old = $data["logged_as_old"];

            @endphp

            @if(Session::get('logged_as'))

            <ul class="nav navbar-nav" style="background:red;">
                <li class="active">
                    <a href="{{ route('AdminCmsUsersControllerGetProfile') }}" class="btn btn-default btn-flat"><i
                            class='fa fa-user'></i>Logout</a>

                    <!--<a href="javascript:void(0)" onclick="swal({-->
                    <!--title: '{{trans('crudbooster.alert_want_to_logout')}}',-->
                    <!--type:'info',-->
                    <!--showCancelButton:true,-->
                    <!--allowOutsideClick:true,-->
                    <!--confirmButtonColor: '#DD6B55',-->
                    <!--confirmButtonText: '{{trans('crudbooster.button_logout')}}',-->
                    <!--cancelButtonText: '{{trans('crudbooster.button_cancel')}}',-->
                    <!--closeOnConfirm: false-->
                    <!--}, function(){-->
                    <!--location.href = '{{ CRUDBooster::mainpath('users/loginas-user/').$logged_as_old }}';-->

                    <!--    });" class="btn btn-default btn-flat"><i class='fa fa-user'></i>Logout</a> -->
                </li>
            </ul>

            @endif




            <ul class="nav navbar-nav">
                @php
                $dataCheck=DB::table('cms_users')->where('id',Crudbooster::myId())->first();
                if($dataCheck){
                $total_notification = App\User::find(Crudbooster::myId())->unreadNotifications()->count();
                }
                @endphp

                <li class="sync_details_btn" style="color: #fff; margin: 15px 5px;display:none">CSV Sync Process is
                    Running </li>
                <li style="display:none" class="sync_details_btn">
                    <button type="button" class="btn btn-primary pb-btn" data-toggle="modal" data-target="#sync_modal">
                        Details
                    </button>
                </li>

                <li class="play-button" id="play_button" data-step="3"
                    data-intro='An vielen Stellen findest du Hilfevideos.
                    Diese erklären dir das DRM direkt an der richtigen Funktion. Du kannst hier die Hilfevideos jederzeit vollständig ausblenden damit Sie dich nicht stören.'>
                    <button class="pb-btn" data-toggle="modal" data-target="#iframeModal"><i class="fa fa-play-circle"
                            aria-hidden="true"></i>
                        play</button>
                </li>
                <li class="help-btn-text" style="color: #fff; margin: 15px 5px;">Hilfevideos </li>
                <li>
                    <div class="onoffswitch">
                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch"
                            checked>
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                        </label>
                    </div>
                </li>

                <li class="dropdown notifications-menu" id="notification_menu" data-step="4"
                    data-intro='Aktuelle Neuigkeiten & Updates.
                        Hier informieren wir dich, wenn sich dein Lagerbestand aktualisiert uvm. Du solltest regelmässig ein Auge auf die Benachrichtigungen werfen.'>
                    <a href="#" id="no_id" class="dropdown-toggle" data-toggle="dropdown" title='Notifications'
                        aria-expanded="false">
                        <i class="fa fa-bell-o text-bold"></i>
                        @if (!is_null($total_notification))
                        <span class="label label-info" id="notification-label"
                            style="background: #E50000;">{{ $total_notification }}</span>
                        @endif
                    </a>

                    <ul class="dropdown-menu">
                        <li class="notification-header text-bold" style="background: #f39c12;color: #fff; margin: 5px;">
                            <i class="fa fa-bullhorn"></i> Notifications ({{ $total_notification }})</li>
                        {{-- <li class="header"><i class="fa fa-bullhorn"></i>You Have  Notifications</li> --}}
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <div class="slimScrollDiv"
                                style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;overflow-y: auto;">
                                    @if ($dataCheck)
                                    @foreach(App\User::find(Crudbooster::myId())->notifications()->latest()->take(5)->get() as $notification)
                                    @php
                                    $n_url=$notification->data['url'];
                                    // dump($n_url);
                                    if($n_url==null || $n_url=="" || $n_url=="#"){

                                    $n_url=url()->current();
                                    //dump($n_url);
                                    }
                                    // dump($n_url);
                                    if(strpos($notification->data['url'],"?")===false){
                                    $mark="?";
                                    }else{
                                    $mark="&";
                                    }
                                    $n_url=str_replace("#","",$n_url);
                                    $n_url=$n_url.$mark."notification_id=".$notification->id;
                                    //dump($n_url);
                                    @endphp
                                    @if (!$notification->read_at)
                                    <li style="background-color: #d8f3ff;margin-bottom: 2px;">
                                        <a href="{{$n_url}}">
                                            <i class="fa fa-envelope-o text-aqua"></i>
                                            {{ str_limit($notification->data['data'], 70) }}
                                        </a>
                                    </li>
                                    @else
                                    <li style="margin-bottom: 2px;">
                                        <a href="{{ $n_url }}">
                                            <i class="fa fa-envelope-o text-aqua"></i> {{ $notification->data['data'] }}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                </ul>
                                <div class="slimScrollBar"
                                    style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px; background: rgb(0, 0, 0);">
                                </div>
                                <div class="slimScrollRail"
                                    style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);">
                                </div>
                            </div>
                        </li>
                        <li class="footer"><a class="all-noti-btn"
                                href="{{route('NotificationsControllerGetIndex')}}">{{trans("crudbooster.text_view_all_notification")}}</a>
                            <center class="fs-button-input-style">
                                @php
                                $value =
                                DB::table('cms_users')->where('id',Crudbooster::myId())->first()->email_notification;
                                @endphp
                                @if($value == '1')
                                <input type="checkbox" id="email_notification" name="email_notification"
                                    class="custom-control-label" checked />
                                @else
                                <input type="checkbox" id="email_notification" name="email_notification" />
                                @endif
                                Receive Notification by Email
                            </center>
                        </li>
                    </ul>
                </li>




                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav" style="background:red;">
                        <li class="active"><a href="https://www.youtube.com/channel/UCJR9DIInIDOdOT24ILsFT1w/"
                                target="_blank"><span><i class="fa fa-youtube" aria-hidden="true"></i></span>&nbsp;
                                Youtube <span class="sr-only">(current)</span></a></li>
                    </ul>




                    <?php

                    $country = DB::table('countries')->get();


                  ?>


                    <!-- dropdown -->
                    <ul class="nav navbar-nav" data-step="2"
                        data-intro='Wähle die passende Sprache für deine Benutzeroberfläche'>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @foreach($country as $co)
                                @if ( Config::get('app.locale') == $co->language_shortcode )
                                <img src="{{url($co->flag)}}" height="15" width="20" /> {{ $co->language }}
                                @endif
                                @endforeach

                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ( $country as $co)
                                <li><a href="{{CRUDBooster::adminPath('language/set-lang/'.$co->language_shortcode)}}"><span><img
                                                src="{{url($co->flag)}}" height="15" width="20" /></span>
                                        {{$co->language }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>





                    <!-- search -->
                    <!--<form class="navbar-form navbar-left border-warning" role="search">-->
                    <!--  <div class="form-group border-warning">-->
                    <!-- <input type="text" class="form-control color-succecss" id="navbar-search-input" placeholder="Search"> -->
                    <!--    <input style="border:none;" class="form-control border-warning" type="text" placeholder="Search" aria-label="Search">-->
                    <!--  </div>-->
                    <!--</form>-->

                </div>


                <!-- User Account Menu -->
                <li class="dropdown user user-menu" data-step="1" data-intro='Dein Account: Verwalte deine Zahlungsmittel,
                    lade neue Benutzer ein und aktualisiere deinen Login.' data-position='bottom'>
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ CRUDBooster::myPhoto() }}" class="user-image" alt="User Image" />
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ CRUDBooster::myName() }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-style" style="width:auto !important;">
                        <li><a href="{{ route('AdminCmsUsersControllerGetProfile') }}"><i class="fa fa-cog"></i>
                                {{trans("crudbooster.label_button_profile")}}</a></li>
                        <li><a href="{{ url('/subscription') }}"><i class="fa fa-money"></i> Billing And Plans</a></li>
                        <li><a href="https://www.drm.software/admin/affiliate"><i class="fa fa-hand-o-right"></i>
                                Affiliate Program</a></li>
                        <li><a href="https://www.drm.software/admin/notifications"><i class="fa fa-bell"></i>
                                Notifications (ALL)</a></li>
                        <li><a href="#"><i class="fa fa-share-alt"></i> Share account access</a></li>
                        @if(CRUDBooster::myPrivilegeId() == 3)
                        <li><a href="javascript:void(0);" onclick="javascript:introJs().start();"><i
                                    class="fa fa-steam"></i> First-Steps/DRM-Trainings</a></li>
                        @endif
                        <li>
                            <a class="logout-btn" href="javascript:void(0)" onclick="swal({
                             title: '{{trans('crudbooster.alert_want_to_logout')}}',
                             type:'info',
                             showCancelButton:true,
                             allowOutsideClick:true,
                             confirmButtonColor: '#DD6B55',
                             confirmButtonText: '{{trans('crudbooster.button_logout')}}',
                             cancelButtonText: '{{trans('crudbooster.button_cancel')}}',
                             closeOnConfirm: false
                             }, function(){
                             location.href = '{{ route("getLogout") }}';

                                 });"><i class="fa fa fa-power-off"></i> {{trans('crudbooster.button_logout')}}</a>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
    </nav>
</header>


@php

$count = DB::table('user_introjs')->where('user_id',Crudbooster::myId())->count();
//dd($status);
if(CRUDBooster::myPrivilegeId()==3){
//dd($data);
if($count == 0){
DB::table('user_introjs')->insert([
'user_id' => CRUDBooster::myId(),
'user_name' => CRUDBooster::myName(),
'status' => 1
]);

$status = 1;
}

}

@endphp


<div class="modal fade" id="sync_modal" tabindex="-1" role="dialog" aria-labelledby="sync_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="margin-top: 10%;" role="document">
        <div class="modal-content" style="border-radius:5px">
            <div class="modal-body">
                <div style="display:none;padding:10px;background:#ffedab" id="sync_progress">

                    <div style="margin-top:20px;margin-bottom:20px;">
                        <center id="feed_name"></center>
                    </div>

                    <div style="display:none" class="progress">
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>

                    <div style="margin-top:20px;color:green">
                        <center id="sync_count"></center>
                    </div>

                    <div id="server_error_box" style="margin-top:20px;display:none;color:red;margin-bottom:20px">
                        <center id="sync_server_error"></center>
                    </div>

                    <div style="margin-top:20px;color:#684104;">
                        <center><label style="display:none" id="sync_importing_label" for="#sync_count">Product
                                Updating: </label></center>
                        <center id="sync_file_name"></center>
                    </div>

                    <div style="margin-top:20px;color:red;margin-bottom:20px">
                        <center id="sync_invalid"></center>
                    </div>

                    <div style="margin-top:20px">
                        <table style="background:#f3f3f3" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Products Updated </th>
                                    <td id="sync_changed_count" style="color:green;font-weight:bold;"></td>
                                </tr>
                                <tr>
                                    <th scope="row">New Products</th>
                                    <td id="sync_new_count" style="color:green;font-weight:bold;"></td>
                                </tr>
                                <!--<tr>-->
                                <!--  <th scope="row">Products Deleted</th>-->
                                <!--  <td id="sync_deleted_count" style="color:red"></td>-->
                                <!--</tr>-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade video_modal" id="iframeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <iframe id="nofocusvideo" src="https://player.vimeo.com/video/387317035" width="640" height="360"
                    frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.js"
    integrity="sha256-SPZP/x8QDPEhRlpJjet4AD5X4ergPWcxjhMn73SwyOE=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script>
    $(document).ready(function(){
            var user_id = "{{CRUDBooster::myId()}}";
            var pusher = new Pusher('6994e84deefb5ad0bd41',{
                cluster: 'eu',
                forceTLS: true
            });

            var channel = pusher.subscribe('sync_progress');
            channel.bind("sync_notification"+user_id+"", function(data){
                  $('.progress').css('display','block');
                  $('#sync_progress').css('display','block');
                  $('.sync_details_btn').css('display','block');

                if(data.message.message == 'end'){
                  $('#sync_modal').modal('hide');
                  $('.progress').css('display','none');
                  $('#sync_progress').css('display','none');
                  $('.sync_details_btn').css('display','none');
                }


                 if(data.message.feed_name!=null){
                     $('#feed_name').html('<strong>Feed: </strong>'+data.message.feed_name);
                 }
                  var error = null;
                  var new_width = (data.message.count / data.message.total) * 100;
                  var html = '<b>'+ data.message.count + ' / '+ data.message.total +' ('+data.message.percent+' %)</b>';

                  if(data.message.text!=null){
                     html = '<b>'+ data.message.text+'</b>';
                  }

                  else{
                     $('#sync_importing_label').css('display','block');
                     $('#sync_file_name').html(data.message.name);
                  }

                  if(data.message.percent!=null){
                     var new_width = data.message.percent;
                  }

                  if(data.message.changed_count!=null){
                     $('#sync_changed_count').html(data.message.changed_count);
                  }

                  if(data.message.new_count!=null){
                     $('#sync_new_count').html(data.message.new_count);
                  }

                  if(data.message.error!=null){
                     var error = data.message.error;
                     $('#sync_server_error_box').css('display','block');
                     $('#sync_server_error').html(error);
                  }

                  $('#sync_count').html(html);
                  $('.progress-bar').css('width',new_width + "%");
              //}
            });
        });

        $('#email_notification').click(function(){
            var checked = $('#email_notification').prop('checked');

            $.ajax({
              method: "GET",
              url: "{{url('admin/set-email-notification?value=')}}"+checked,
            });
        });


        //................  Notification Menu
        $("#notification_menu").click(function(){

            $.ajax({
                type: "get",
                url: "{{ URL::route('totalNotification') }}",
                success: function(data) {
                    $('#notification-label').html(data);
                },
            });

            var Check_notification = $('#notification_menu').attr('class');

            if(Check_notification == 'dropdown notifications-menu open'){
                $("#notification-label").show();
            }else{
                $("#notification-label").hide();
            }
        });

        //......  Video play Button
        $('.onoffswitch-checkbox').on("click", function(){
            if($(".onoffswitch-checkbox").prop('checked') == true){
                $(".pb-btn" ).show();
            }else{
                $(".pb-btn" ).hide();
            }
        });

        // ...... stop modal video function
        function stopVideo() {
            var $frame = $('iframe#nofocusvideo');

            // saves the current iframe source
            var vidsrc = $frame.attr('src');

            // sets the source to nothing, stopping the video
            $frame.attr('src', '');

            // sets it back to the correct link so that it reloads immediately on the next window open
            $frame.attr('src', vidsrc);
            }

            $('#iframeModal').on('hidden.bs.modal', function(e) {
                stopVideo();
            })


            var status = "{{$status}}";

            if(status == 1){

                window.onload = function(){

                introJs().start();

                };

            }

</script>
@endpush
