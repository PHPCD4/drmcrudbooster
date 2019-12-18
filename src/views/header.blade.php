<!-- Main Header -->
<header class="main-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!-- Logo -->
    <a href="{{url(config('crudbooster.ADMIN_PATH'))}}" title='{{Session::get('appname')}}' class="logo">{{CRUDBooster::getSetting('appname')}}</a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" title='Notifications' aria-expanded="false">
                        <i id='icon_notification' class="fa fa-bell-o"></i>
                        <span id='notification_count' class="label label-danger" style="display:none">0</span>
                    </a>
                    <ul id='list_notifications' class="dropdown-menu">
                        <li class="header">{{trans("crudbooster.text_no_notification")}}</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                    <li>
                                        <a href="#">
                                            <em>{{trans("crudbooster.text_no_notification")}}</em>
                                        </a>
                                    </li>

                                </ul>
                                <div class="slimScrollBar"
                                     style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px; background: rgb(0, 0, 0);"></div>
                                <div class="slimScrollRail"
                                     style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                            </div>
                        </li>
                        <li class="footer"><a href="{{route('NotificationsControllerGetIndex')}}">{{trans("crudbooster.text_view_all_notification")}}</a>
                                        <center>
                                            @php
                                                $value = DB::table('cms_users')->where('id',Crudbooster::myId())->first()->email_notification;
                                            @endphp
                                            @if($value == '1')
                                                <input type="checkbox" id="email_notification" name="email_notification" checked />
                                                @else
                                                <input type="checkbox" id="email_notification" name="email_notification"/>
                                            @endif
                                            Receive Notification by Email</center>
                        
                        </li>
                    </ul>
                </li>



                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                  <ul class="nav navbar-nav" style="background:red;">
                    <li class="active"><a href="https://www.youtube.com/channel/UCJR9DIInIDOdOT24ILsFT1w/" target="_blank"><span><i class="fa fa-youtube" aria-hidden="true"></i></span>&nbsp; Youtube <span class="sr-only">(current)</span></a></li>
                  </ul>

                  <!-- dropdown -->
                    <ul class="nav navbar-nav">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                          @if ( Config::get('app.locale') == 'en')

                          <img src="https://lipis.github.io/flag-icon-css/flags/4x3/gb.svg" height="15" width="30"/> {{ 'English' }}

                           @elseif ( Config::get('app.locale') == 'de' )

                          <img src="https://lipis.github.io/flag-icon-css/flags/4x3/de.svg" height="15" width="30" /> {{ 'Germany' }}

                           @endif


                          <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{CRUDBooster::adminPath('language/set-lang/en')}}"><span><img src="https://lipis.github.io/flag-icon-css/flags/4x3/gb.svg" height="15" width="30"/></span>English</a></li>
                          <li><a href="{{CRUDBooster::adminPath('language/set-lang/de')}}"><span><img src="https://lipis.github.io/flag-icon-css/flags/4x3/de.svg" height="15" width="30" /></span>Germany</a></li>
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
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ CRUDBooster::myPhoto() }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ CRUDBooster::myName() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ CRUDBooster::myPhoto() }}" class="img-circle" alt="User Image"/>
                            <p>
                                {{ CRUDBooster::myName() }}
                                <small>{{ CRUDBooster::myPrivilegeName() }}</small>
                                <small><em><?php echo date('d F Y')?></em></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-{{ trans('crudbooster.left') }}">
                                <a href="{{ route('AdminCmsUsersControllerGetProfile') }}" class="btn btn-default btn-flat"><i
                                            class='fa fa-user'></i> {{trans("crudbooster.label_button_profile")}}</a>
                            </div>
                            <div class="pull-{{ trans('crudbooster.right') }}">
                                <a title='Lock Screen' href="{{ route('getLockScreen') }}" class='btn btn-default btn-flat'><i class='fa fa-key'></i></a>
                                <a href="javascript:void(0)" onclick="swal({
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

                                        });" title="{{trans('crudbooster.button_logout')}}" class="btn btn-danger btn-flat"><i class='fa fa-power-off'></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

@push('bottom')
    <script>
        $('#email_notification').click(function(){
            var checked = $('#email_notification').prop('checked');
            
            $.ajax({
              method: "GET",
              url: "{{url('admin/set-email-notification?value=')}}"+checked,
            });
        });
    </script>
@endpush
