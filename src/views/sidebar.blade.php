<!-- Left side column. contains the sidebar -->
<style>
    #appoienment .modal-header .close span {
        position: relative;
        top: -18px;
        border: 3px solid #fff;
        padding: 1px 10px;
        color: #fff;
    }
    #appoienment .modal-footer {
        padding: 15px;
        text-align: center !important;
        border-top: 1px solid #e5e5e5;
    }
    #appoienment .modal-body{
        margin:20px;
        text-align: justify;
    }
</style>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <div class="user-panel text-center">
        @if(CRUDBooster::myPrivilegeId() == 3)
          <a href="#" data-step="14" data-intro='Sichere Dir hier Deinen kostenloses Erstgespräch mit Mentor Fabian & Jasmin. Außerdem kannst du jederzeit weitere Calls optional hinzufügen.' style="font-size:17px;color:white; cursor: pointer; float:left;" data-toggle="modal" data-target="#appoienment"><i class="fa fa-desktop text-normal" style="margin-right:5px;"></i> Mentoring</a><br><br>
        @else
        <a href="{{ url('admin/inbox/mentoring') }}" style="font-size:17px;color:white; cursor: pointer; float:left;"><i class="fa fa-desktop text-normal" style="margin-right:5px;"></i> Mentoring</a><br><br>
        @endif
          <a href="https://www.gotomeet.me/expertiserocks" target="_blank " style="font-size:16px;color:white; cursor: pointer; "> <i class="fa fa-star" style="margin-right:5px; font-size:14px;"></i>Jetzt deinen Termin starten! </a> <br>

        @if(CRUDBooster::myPrivilegeId() == 3)
            <a class="btn btn-orange hide" href="javascript:void(0);" onclick="javascript:introJs().start();" style="color: #fff;margin-top: 10px;margin-bottom: 5px;">IntroJs</a>
        @endif

        </div>


        <!-- Mentor Appointment Popup -->
        <div class="modal fade" id="appoienment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="margin-top: 100px;">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12; color: #fff;">
                <h4 class="modal-title" id="exampleModalLabel">Mentor Appointment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @php
                        $userStatus = App\User::find(CRUDBooster::myId());
                        $payment_date = App\takeappointment::where('user_id',CRUDBooster::myId())->first();

                        $status = $userStatus->plan_status;
                    @endphp
                    @if($payment_date->payment_date_remaining > 0)
                    <span style="color:#f39c12;">Your Mentor Appointment Remaining Dates is <u>{{ $payment_date->payment_date_remaining  }}</u> Dates </span><br>
                    "You can still ( {{ $payment_date->payment_date_remaining  }} ) arrange for you paid mentor appointment. <br>
                     Would you like to make an appointment now?"
                    @else
                    "You can still ( {{ $payment_date->payment_date_remaining  }} ) arrange for you paid mentor appointment. <br>
                     Would you like to make an appointment now?"
                    @endif
                </div>
                <div class="modal-footer text-center">
                    @if($payment_date->payment_date_remaining > 0)
                    <button type="button" class="btn btn-primary" ><a style="color:#fff;" href="{{ url('admin/inbox/mentoring') }}"><i class="fa fa-check-square-o" aria-hidden="true"></i> Yes</a></button>
                    @endif
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><a style="color:#fff;" href="{{ url('admin') }}"><i class="fa fa-times" aria-hidden="true"></i> No</a></button>
                    <button type="button" class="btn btn-orange" ><a style="color:#fff;" href="{{ url('admin/appointment-plan') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy</a></button>
                </div>
            </div>
            </div>
        </div>

        <div class='main-menu'>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <!--<li class="header">{{trans("crudbooster.menu_navigation")}}</li>-->
                <li class="header">Menü</li>
                <!-- Optionally, you can add icons to the links -->

                <?php $dashboard = CRUDBooster::sidebarDashboard();?>
                @if($dashboard)
                    <li data-id='{{$dashboard->id}}' class="{{ (Request::is(config('crudbooster.ADMIN_PATH'))) ? 'active' : '' }}"><a
                                href='{{CRUDBooster::adminPath()}}' class='{{($dashboard->color)?"text-".$dashboard->color:""}}'><i class='fa fa-dashboard'></i>
                            <span>{{trans("crudbooster.text_dashboard")}}</span> </a></li>
                @endif
                @php
                    $dataCheck=DB::table('cms_users')->where('id',Crudbooster::myId())->first();
                    if($dataCheck){
                        $total_notification = App\User::find(Crudbooster::myId())->unreadNotifications()->count();
                    }
                @endphp

                @foreach(CRUDBooster::sidebarMenu() as $menu)

                @php
                if(CRUDBooster::myPrivilegeId() ==3){
                    $hide='';
                    $app=DB::table('app_stores')->where('cms_modul_id',$menu->id)->first();

                    $subs=DB::table('purchase_apps')
                    ->where('cms_user_id',CRUDBooster::myId())
                    ->where('cms_modul_id',$menu->id)
                    ->where('status',1)
                    ->where(function($query) {
                            $query->where('subscription_date_end','>=', date('Y-m-d'))
                                  ->orWhere('subscription_life_time',1);
                    })
                    ->latest()->first();
                    if(($subs==null) && ($app->cms_modul_id==$menu->id)){
                       continue;
                    }else{
                        $remain_days=0;
                        if($subs->type=='Free Trial'){
                                $start=strtotime(date('Y-m-d'));
                                $end = strtotime($subs->subscription_date_end);
                                    $remain_days=($end - $start) / (60 * 60 * 24);                       }
                    }
                }
                $data=DB::table('drm_products')
                ->where('user_id',CRUDBooster::myId())
                ->select('created_at')
                ->orderby('id','asc')
                ->first();

                $free_days=0;
                if(!empty($data)){

                $date=date("Y-m-d", strtotime($data->created_at));
                $time=strtotime($date);
                $days=date("Y-m-d", strtotime("+1 days", $time));

                $start=strtotime(date('Y-m-d'));
                $end=strtotime($days);
                $free_days +=($end - $start) / (60 * 60 * 24);
               }
                @endphp

                    <li data-id='{{$menu->id}}' class='{{(!empty($menu->children))?"treeview":""}} {{ (Request::is($menu->url_path."*"))?"active":""}}'>
                        <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$menu->url }}'
                           class='{{($menu->color)?"text-".$menu->color:""}}'>
                            <i class='{{$menu->icon}} {{($menu->color)?"text-".$menu->color:""}}'></i>
                            <span>
                                @if (preg_match('#^[A-Z]+$#',$menu->name))
                                    {{ trans("menu.".$menu->name) }}
                                @else
                                    {{ $menu->name }}
                                @endif

                                <?php
                                if($remain_days >0){
                                    echo '<span style="color:red">Remain Days '.$remain_days.'</sapn>';
                                }
                                ?>
                                @if(($menu->name == "MENUPRODUCTS") and ($free_days>0) and (CRUDBooster::myId()=='98'))
                                    <span style="color:red">Unlimited</span>
                                @endif

                                @if($menu->name == "MENUCUSTOMER")
                                <i data-step="15" data-intro="Hier findest du all deine Verkäufe, die von dir automatisch erstellten Rechnungen und Lieferscheine sowie deine Kunden."></i>
                                @endif
                                @if($menu->name == "MENUPRODUCTS")
                                <i data-step="16" data-intro="Hier verwaltest du dein Lagerbestand und fügst neue Verkaufskanäle hinzu. Verwalte jetzt dein Sortiment, füge deinen ersten Lieferanten hinzu und übersetzte vollautomatisch deine Produkte in verschiedene Sprachen um auch diese zum Verkauf anzubieten."></i>
                                @endif
                                @if($menu->name == "MENUSUPLIERS")
                                <i data-step="17" data-intro="Hier findest du eine Übersicht deiner Dropshipping-Lieferanten. Verwalte deine Gewinn-Kalkulationen, Update deine Lagerbestände und vieles mehr."></i>
                                @endif
                            </span>
                            @if ($menu->name == 'Mail')
                                <button class="pb-btn" style="float: right;position: relative;right: 40px;margin-top: -2px;" data-toggle="modal" data-target="#iframeMailModal"><i class="fa fa-play-circle" aria-hidden="true"></i>Play</button>
                                <!-- MODAL -->
                                    <div class="modal fade video_mail_modal" id="iframeMailModal" tabindex="-1" role="dialog" aria-labelledby="modal-video-label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopVideo()">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-video">
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe src="https://player.vimeo.com/video/384761456" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                ...
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                            @endif
                            @if(!empty($menu->children))<i class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i>@endif
                        </a>
                        @if(!empty($menu->children))



                            <ul class="treeview-menu">
                                @foreach($menu->children as $child)

                                    @php
                                        if(CRUDBooster::myPrivilegeId() ==3){
                                            $hide='';
                                            $app=DB::table('app_stores')->where('cms_modul_id',$child->id)->first();

                                            $subs=DB::table('purchase_apps')
                                            ->where('cms_user_id',CRUDBooster::myId())
                                            ->where('cms_modul_id',$child->id)
                                            ->where('status',1)
                                            ->where(function($query) {
                                                    $query->where('subscription_date_end','>=', date('Y-m-d'))
                                                          ->orWhere('subscription_life_time',1);
                                            })
                                            ->latest()->first();
                                            if(($subs==null) && ($app->cms_modul_id==$child->id)){
                                               continue;
                                            }else{
                                                $remain_days=0;
                                                if($subs->type=='Free Trial'){
                                                        $start=strtotime(date('Y-m-d'));
                                                        $end = strtotime($subs->subscription_date_end);
                                                            $remain_days=($end - $start) / (60 * 60 * 24);                       }
                                            }
                                        }
                                    @endphp

                                    @if ($child->id == '91')
                                    <li data-id='{{$child->id}}'
                                        class="{{ ($_GET['lang'] == 'en') ? 'active' : '' }} {{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}} ">


                                    @elseif ($child->id == '100')
                                    <li data-id='{{$child->id}}'
                                        class='{{  ($_GET['lang'] == 'nl') ? 'active' : '' }} {{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}} '>

                                    @elseif ($child->id == '99')
                                    <li data-id='{{$child->id}}'
                                        class='{{  ($_GET['lang'] == 'it') ? 'active' : '' }} {{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}} '>

                                    @elseif ($child->id == '98')
                                    <li data-id='{{$child->id}}'
                                        class='{{  ($_GET['lang'] == 'fr') ? 'active' : '' }} {{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}} '>

                                    @elseif ($child->id == '101')
                                    <li data-id='{{$child->id}}'
                                        class='{{  ($_GET['lang'] == 'es') ? 'active' : '' }} {{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}} '>

                                    @elseif ($child->id == '102')
                                    <li data-id='{{$child->id}}'
                                        class='{{  ($_GET['lang'] == 'sv') ? 'active' : '' }} {{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}} '>

                                    @else

                                        <li data-id='{{$child->id}}' class='{{(!empty($child->children))?"treeview":""}} {{(Request::is($child->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}}'>

                                    @endif

                                        <a href='{{ ($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url}}'
                                           class='{{($child->color)?"text-".$child->color:""}}'>

                                            @if($child->name == 'Subscription Orders' && Crudbooster::myId() == 98)
                                            <i class='{{$child->icon}}'></i>
                                            @elseif($child->name != 'Subscription Orders')
                                            <i class='{{$child->icon}}'></i>
                                            @elseif($child->name == 'Subscription Orders' && CRUDBooster::myPrivilegeId() == 7 || CRUDBooster::myPrivilegeId() == 1)
                                            <i class='{{$child->icon}}'></i>
                                            @endif
                                            <!--<i class='{{$child->icon}}'></i>-->
                                            @if (preg_match('/(\.jpg|\.png|\.bmp)$/i',$child->icon))
                                                <img src="{{$child->icon}}">
                                            @endif
                                                <span>
                                                    @if (preg_match('#^[A-Z]+$#',$child->name))
                                                        {{ trans("menu.".$child->name) }}
                                                        @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $child->icon_img))
                                                            <img src="{{$child->icon_img}}">
                                                        @endif

                                                        @if($child->name=='MENUDRMORDER' || $child->name=='MENUDRMPRODUCTSDE' || $child->name=='MENUNOTIFICATIONADD')
                                                            @php
                                                                $dataCheck=DB::table('cms_users')->where('id',Crudbooster::myId())->first();
                                                                if($dataCheck){
                                                                    $totalnotification = DB::table('notifications')->where('notifiable_id',Crudbooster::myId())->whereNull('read_at')->get();

                                                                    $total_notification=0;
                                                                    foreach($totalnotification as $notification){
                                                                        $hook=json_decode($notification->data,true);
                                                                        if($child->name == $hook['hook']){
                                                                            $total_notification++;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            @if($total_notification != 0)
                                                                <span class="badge" id="notificationlabel" style="background: #E50000;"> {{ $total_notification }}</span>
                                                            @endif
                                                        @endif

                                                    @else

                                                    @if($child->name == 'Subscription Orders' && Crudbooster::myId() == 98)
                                                        {{ $child->name }}
                                                    @elseif($child->name != 'Subscription Orders')
                                                        {{ $child->name }}
                                                    @elseif($child->name == 'Subscription Orders' && CRUDBooster::myPrivilegeId() == 7 || CRUDBooster::myPrivilegeId() == 1)
                                                        {{ $child->name }}
                                                    @endif

                                                    @if($remain_days >0)
                                                        <span style="color:red">{{$remain_days}} Days</sapn>
                                                    @endif

                                                    <!--{{ $child->name }} -->
                                                        @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $child->icon_img))
                                                            <img src="{{$child->icon_img}}">
                                                        @endif

                                                        @if($child->name=='NotificaitonAdd')
                                                            @php
                                                                $dataCheck=DB::table('cms_users')->where('id',Crudbooster::myId())->first();
                                                                if($dataCheck){
                                                                    $totalnotification = DB::table('notifications')->where('notifiable_id',Crudbooster::myId())->whereNull('read_at')->get();

                                                                    $total_notification=0;
                                                                    foreach($totalnotification as $notification){
                                                                        $hook=json_decode($notification->data,true);
                                                                        if($child->name == $hook['hook']){
                                                                            $total_notification++;
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            @if($total_notification != 0)
                                                                <span class="badge" id="notificationlabel" style="background: #E50000;"> {{ $total_notification }}</span>
                                                            @endif
                                                        @endif

                                                    @endif
                                                </span>
                                          @if(!empty($child->children))<i class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i>@endif

                                          @if(($child->name =="MENUPRODUCTIMPORT")  and ($free_days>0) and (CRUDBooster::myId()=='98'))
                                            <span style="color:red">{{$free_days}} Days Trial</span>
                                          @endif
                                        </a>

                                        @if ($child->name == 'MENUDRMPRODUCTSDE')
                                        <ul id="ProductChannel" style="margin-left: -15px;" class="{{ (request()->is('admin/drm_products') || request()->is('admin/drm_products/add') || request()->is('admin/drm_products/detail/*') || Request::fullUrl() === url('admin/shop_setting/add?id='.$_GET['id']) || Request::fullUrl() === url('admin/shop_setting?id='.$_GET['id']) || Request::fullUrl() === url('admin/shop_setting/*') ) ? '' : 'drm_products_show_menu' }}">
                                            <li class="{{ (Request::fullUrl() === url('admin/shop_setting/add?id='.$_GET['id']) ) ? 'active' : '' }} stockChannel">
                                                <a href="#" data-toggle="modal"  data-target="#MENUADDCHANNEL" class="text-normal"><i class="fa fa-list-alt"></i> <span>Channel hinzufügen</span></a>

                                                <button class="pb-btn" style="float: right;position: relative; right: 0px;font-size: 12px;margin-top: 0px;padding: 2px 6px;" data-toggle="modal" data-target="#iFrameShopModal"><i class="fa fa-play-circle" aria-hidden="true"></i>Play</button>

                                                <!-- MODAL -->
                                                <div class="modal fade video_mail_modal" id="iFrameShopModal" tabindex="-1" role="dialog" aria-labelledby="modal-video-label" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopVideo()">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-video">
                                                                    <div class="embed-responsive embed-responsive-16by9">
                                                                    <iframe src="https://player.vimeo.com/video/393471491" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                            @php
                                                if(!CRUDBooster::isSuperadmin()){
                                                    $shop = DB::table('gambio_shop')->where('userid', '=', CRUDBooster::myId())->groupBy('shopType')->get();
                                                }else{
                                                    $shop = DB::table('gambio_shop')->groupBy('shopType')->get();
                                                }
                                            @endphp
                                               <div class="modal fade" id="MENUADDCHANNEL" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="margin-top: 6.5em;border-radius: 8px;">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                           <div class="menuadd-style">
                                                                <div class="modal-body" >
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2 ">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/gambio.jpg') }}" alt="Gambio Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            GAMBIO
                                                                        </h4>
                                                                        <p class="product-text-style" style="color:black;">
                                                                            Verbinde deinen Gambio-Shop (inkl. Gambio-Cloud) und verkaufe in deinem eigenen Shop. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        @if($shop[0]->shopType == '1')
                                                                            <a class="btn btn-success" type="button" href="#"><i class="fa fa-check-circle fa-lg" style="color:white;"></i></a>
                                                                        @else
                                                                            <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=1')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/lengow.jpg') }}" alt="Lengow Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            LENGOW
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Verbinde dich mit Lengow und verkaufe in über 45 Ländern auf bis zu 2.000 Vertriebsplattformen. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        @if($shop[1]->shopType == '2')
                                                                            <a class="btn btn-success" type="button" href="#"><i class="fa fa-check-circle fa-lg" style="color:white;"></i></a>
                                                                        @else
                                                                            <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=2')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/yatego.jpg') }}" alt="Yatego Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            YATEGO
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Yatego ist einer der größten deutschen Online-Marktplätze. Liste deine Angebote für mehr Reichweite. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        @if($shop[2]->shopType?:$shop[1]->shopType == '3' || $shop[2]->shopType?:$shop[0]->shopType == '3')
                                                                            <a class="btn btn-success" type="button" href="#"><i class="fa fa-check-circle fa-lg" style="color:white;"></i></a>
                                                                        @else
                                                                            <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=3')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/ebay.jpg') }}" alt="eBay Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            EBAY
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Verkaufe im führenden Auktionshaus eBay. Deine Angebote werden auf eBay-Deutschland übertragen. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        @if($shop[3]->shopType?:$shop[0]->shopType == '4' || $shop[3]->shopType?:$shop[1]->shopType == '4' || $shop[3]->shopType?:$shop[2]->shopType == '4')
                                                                            <a class="btn btn-success" type="button" href="#"><i class="fa fa-check-circle fa-lg" style="color:white;"></i></a>
                                                                        @else
                                                                            <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=4')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/amazon.jpg') }}" alt="Amazon Image">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            AMAZON (Cooming soon)
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Verkaufe auf dem größten Marketplace und biete deine Produkte einem Millionen-Publikum an. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        @if($shop[4]->shopType?:$shop[0]->shopType == '5' || $shop[4]->shopType?:$shop[1]->shopType == '5' || $shop[4]->shopType?:$shop[2]->shopType == '5' || $shop[4]->shopType?:$shop[3]->shopType == '5')
                                                                            <a class="btn btn-success" type="button" href="#"><i class="fa fa-check-circle fa-lg" style="color:white;"></i></a>
                                                                        @else
                                                                            <a class="btn btn-warning" type="button" href="#"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/shopify.jpg') }}" alt="Shopify Image">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            SHOPIFY
                                                                        </h4>
                                                                        <p  class="product-text-style">
                                                                            Verbinde deinen Shopify-Shop und verkaufe in deinem eigenen Shop. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        @if($shop[5]->shopType?:$shop[0]->shopType == '6' || $shop[5]->shopType?:$shop[1]->shopType == '6' || $shop[5]->shopType?:$shop[2]->shopType == '6' || $shop[5]->shopType?:$shop[3]->shopType == '6'  || $shop[5]->shopType?:$shop[4]->shopType == '6')
                                                                            <a class="btn btn-success" type="button" href="#"><i class="fa fa-check-circle fa-lg" style="color:white;"></i></a>
                                                                        @else
                                                                            <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=6')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <!-- /.Modal End-->

                                            @foreach($shop as $shopname)
                                                @if($shopname->shopType == '1')
                                                    <li class="{{ (Request::fullUrl() === url('admin/shop_setting?id=1')) ? 'active stockChannelActive' : '' }} stockChannel"><a href="{{ url('admin/shop_setting?id=1') }}" class="text-normal" style="color: {{ (Request::fullUrl() === url('admin/shop_setting?id=1')) ? '#fff' : '' }}"><span>GAMBIO</span></a></li>
                                                @elseif($shopname->shopType == '2')
                                                    <li class="{{ (Request::fullUrl() === url('admin/shop_setting?id=2')) ? 'active stockChannelActive' : '' }} stockChannel"><a href="{{ url('admin/shop_setting?id=2') }}" class="text-normal" style="color: {{ (Request::fullUrl() === url('admin/shop_setting?id=2')) ? '#fff' : '' }}"><span>LENGOW</span></a></li>
                                                @elseif($shopname->shopType == '3')
                                                    <li class="{{ (Request::fullUrl() === url('admin/shop_setting?id=3')) ? 'active stockChannelActive' : '' }} stockChannel"><a href="{{ url('admin/shop_setting?id=3') }}" class="text-normal" style="color: {{ (Request::fullUrl() === url('admin/shop_setting?id=3')) ? '#fff' : '' }}"><span>YATEGO</span></a></li>
                                                @elseif($shopname->shopType == '4')
                                                    <li class="{{ (Request::fullUrl() === url('admin/shop_setting?id=4')) ? 'active stockChannelActive' : '' }} stockChannel"><a href="{{ url('admin/shop_setting?id=4') }}" class="text-normal" style="color: {{ (Request::fullUrl() === url('admin/shop_setting?id=4')) ? '#fff' : '' }}"><span>EBAY</span></a></li>
                                                @elseif($shopname->shopType == '5')
                                                    <li class="{{ (Request::fullUrl() === url('admin/shop_setting?id=5')) ? 'active stockChannelActive' : '' }} stockChannel"><a href="{{ url('admin/shop_setting?id=5') }}" class="text-normal" style="color: {{ (Request::fullUrl() === url('admin/shop_setting?id=5')) ? '#fff' : '' }}"><span>AMAZON (Cooming soon)</span></a></li>
                                                @elseif($shopname->shopType == '6')
                                                    <li class="{{ (Request::fullUrl() === url('admin/shop_setting?id=6')) ? 'active stockChannelActive' : '' }} stockChannel"><a href="{{ url('admin/shop_setting?id=6') }}" class="text-normal" style="color: {{ (Request::fullUrl() === url('admin/shop_setting?id=6')) ? '#fff' : '' }}"><span>SHOPIFY</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <style>
                                            .stockChannel{
                                                margin-top: -8px;
                                                list-style: none;
                                                margin-left: 9px;
                                                padding-top: 8px;
                                            }
                                            .drm_products_show_menu{
                                                display: none;
                                            }

                                        </style>
                                        @endif


                                        @if(!empty($child->children))
                                         <ul class="treeview-menu">
                                             @foreach($child->children as $thirdchild)
                                            @if($thirdchild->id == '95')
                                            <li data-id='{{$thirdchild->id}}' class="{{ (Request::fullUrl() === url('admin/shop_setting/add?id=1') || Request::fullUrl() === url('admin/shop_setting/add?id=2')) ? 'active' : '' }}" class='{{(!empty($thirdchild->children))?"treeview":""}} {{(Request::is($thirdchild->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $thirdchild->url_path) ? "/*" : ""))?"active":""}}'
                                                data-toggle="modal"  data-target="#{{$thirdchild->name}}">
                                            @else
                                            <li data-id='{{$thirdchild->id}}' class='{{(!empty($thirdchild->children))?"treeview":""}} {{(Request::is($thirdchild->url_path .= !Illuminate\Support\Str::endsWith(Request::decodedPath(), $thirdchild->url_path) ? "/*" : ""))?"active":""}}' >
                                            @endif
                                                <a href='{{ ($thirdchild->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$thirdchild->url}}'
                                                   class='{{($thirdchild->color)?"text-".$thirdchild->color:""}}'>
                                                    <i class='{{$thirdchild->icon}}'></i>
                                                    @if (preg_match('/(\.jpg|\.png|\.bmp)$/i',$thirdchild->icon))
                                                        <img src="{{$thirdchild->icon}}">
                                                    @endif
                                                        <span>
                                                            @if (preg_match('#^[A-Z]+$#',$thirdchild->name))
                                                                {{ trans("menu.".$thirdchild->name) }}
                                                                @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $thirdchild->icon_img))
                                                                    <img src="{{$thirdchild->icon_img}}">
                                                                @endif
                                                            @else
                                                                {{ $thirdchild->name }}
                                                                @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $thirdchild->icon_img))
                                                                    <img src="{{$thirdchild->icon_img}}">
                                                                @endif
                                                            @endif
                                                        </span>
                                                </a>

                                                <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->

                                                <!--<button data-toggle="modal" data-target="#add_channel"><i class='{{$thirdchild->icon}}'></i>  Add Channel</button>-->


                                            </li>
                                              @endforeach
                                         </ul>


                                        @endif
                                    </li>

                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                   <!-- only customer can view this menu list -->

                @if(CRUDBooster::myPrivilegeId()==3)

                <!-- Projektmanagement -->
                <!--<li class='treeview'>-->
                <!--    <a href='{{CRUDBooster::adminPath('common/project-management')}}'> <i class="fa fa-tasks" aria-hidden="true"></i> <span>@lang('Projectmanagement')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("#") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->

                <!--</li>-->
                <!-- Kunden -->

                <!--<li class='treeview'>-->
                <!--    <a href='{{CRUDBooster::adminPath('common/kunden')}}'><i class="fa fa-users" aria-hidden="true"></i> <span>@lang('CUSTOMER')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("#") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->

                <!--</li>-->

                <!-- Lieferanten -->

                <!--<li class='treeview'>-->
                <!--    <a href='#'><i class="fa fa-industry" aria-hidden="true"></i> <span>@lang('Suppliers')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->
                <!--    <ul class='treeview-menu'>-->
                <!--        <li class="#"><a href='{{CRUDBooster::adminPath('common/lieferanten')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Contacts')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Orders')</span></a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!-- Lagerverwaltung -->

                <!--<li class='treeview'>-->
                <!--    <a href='#'> <i class="fa fa-home" aria-hidden="true"></i><span>@lang('Warehouse Management')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->
                <!--    <ul class='treeview-menu'>-->
                <!--        <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/users/add*')) ? 'active' : '' }}"><a-->
                <!--                    href='{{CRUDBooster::adminPath('common/sortiment')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Range')</span></a></li>-->
                <!--        <li class="#"><a  href='{{CRUDBooster::adminPath('common/gruppen')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Groups')</span></a></li>-->
                <!--        <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/users/add*')) ? 'active' : '' }}"><a-->
                <!--                    href='{{CRUDBooster::adminPath('common/produkte-importieren')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Import Products')</span></a></li>-->
                <!--        <li class="#"><a  href='{{CRUDBooster::adminPath('common/importverwaltung')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Import Administration')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('EAN cache')</span></a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!-- Landingpages -->
                <!--<li class='treeview'>-->
                <!--    <a href='#'><i class="fa fa-clone" aria-hidden="true"></i><span>@lang('Landing Pages')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->
                <!--    <ul class='treeview-menu'>-->
                <!--        <li class="#"><a href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Add Landing Page')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Active Pages')</span></a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!-- Bestellungen -->
                <!--<li class='treeview'>-->
                <!--    <a href='#'><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>@lang('Orders')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->
                <!--    <ul class='treeview-menu'>-->
                <!--        <li class="#"><a-->
                <!--                    href='{{CRUDBooster::adminPath('common/order-overview')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Order overview')</span></a></li>-->
                <!--        <li class="#"><a  href='{{CRUDBooster::adminPath('common/new-order')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('New Order')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Reports')</span></a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!-- Buchhaltung -->
                <!--<li class='treeview'>-->
                <!--    <a href='#'><i class="fa fa-arrows" aria-hidden="true"></i><span>@lang('Accounting')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->
                <!--    <ul class='treeview-menu'>-->
                <!--        <li class="#"><a-->
                <!--                    href='{{CRUDBooster::adminPath('common/ausgangsrechnung')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Invoice')</span></a></li>-->
                <!--        <li class="#"><a  href='{{CRUDBooster::adminPath('common/buch-two')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Invoices')</span></a></li>-->
                <!--        <li class="#"><a  href='{{CRUDBooster::adminPath('common/gutschriften')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Credits')</span></a></li>-->
                <!--        <li class="#"><a  href='{{CRUDBooster::adminPath('common/reporting')}}'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Reporting')</span></a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <!-- Posteingang -->
                <!--<li class='treeview'>-->
                <!--    <a href='{{CRUDBooster::adminPath('common/mail')}}'><i class="fa fa-inbox" aria-hidden="true"></i><span>@lang('Inbox')</span> <i-->
                <!--                class="#"></i></a>-->

                <!--</li>-->
                <!-- Marketplace -->
                <!--<li class='treeview'>-->
                <!--    <a href='#'><i class="fa fa-clone" aria-hidden="true"></i><span>@lang('Marketplace')</span> <i-->
                <!--                class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>-->
                <!--    <ul class='treeview-menu'>-->
                <!--        <li class="#"><a-->
                <!--                    href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Subcategory of Marketplace 1')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Subcategory of Marketplace 2')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('E-mail Templates')</span></a></li>-->
                <!--        <li class="#"><a  href='#'><i class='fa fa-circle-o'></i>-->
                <!--                <span>@lang('Track Order')</span></a></li>-->

                <!--    </ul>-->
                <!--</li>-->

                <!-- Video-Training -->
                <li class='treeview'>
                    <a href='https://vod.dropshipping.university/' target="_blank"> <i class="fa fa-video-camera" aria-hidden="true"></i> <span>@lang('Video-Training')</span> <i
                                class="#"></i></a>

                </li>
                <!--Lengow-Mentoring-->

                <!--<li class='treeview'>-->
                <!--    <a href='{{CRUDBooster::adminPath('common/lengow-mentoring')}}'><i class="fa fa-desktop" aria-hidden="true"></i> <span>@lang('Lengow-Mentoring')</span> <i-->
                <!--                class="#"></i></a>-->

                <!--</li>-->
                @endif


                @if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeName()=='Developer')
                    <li class="header">{{ CRUDBooster::myPrivilegeName() }}</li>

                     <!-- Custom menu -->
                     @if(CRUDBooster::myPrivilegeName()=='Developer')
                     <li class='treeview'>
                         <a href='#'><i class="fa fa-university" aria-hidden="true"></i><span>Digistore24 Payment</span> <i
                                     class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                         <ul class='treeview-menu'>
                             <li class="#"><a href='{{CRUDBooster::adminPath('common/subscription')}}'><i class='fa fa-circle-o'></i>
                                 <span>{{ trans('Subscription-Forecast') }}</span></a></li>
                             <li class="#"><a  href='{{CRUDBooster::adminPath('common/cancellation')}}'><i class='fa fa-circle-o'></i>
                                     <span>{{ trans('Subscription-Cancellations') }}</span></a></li>
                             <li class="#"><a  href='{{CRUDBooster::adminPath('common/drm-member')}}'><i class='fa fa-circle-o'></i>
                                     <span>{{ trans('DRM Member') }}</span></a></li>
                             <li class="#"><a  href='{{CRUDBooster::adminPath('common/all-order')}}'><i class='fa fa-circle-o'></i>
                                     <span>{{ trans('All Orders') }}</span></a></li>
                         </ul>
                     </li>

                     <li class='treeview'>
                         <a href='#'><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Project Management</span> <i
                                     class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                         <ul class='treeview-menu'>
                             <li class="#"> <a href='{{CRUDBooster::adminPath('common/board')}}'> <i class="fa fa-tasks" aria-hidden="true"></i> <span>@lang('Board')</span> <i
                                class="fa fa-angle-{{ trans("#") }} pull-{{ trans("crudbooster.right") }}"></i></a></li>

                         </ul>
                     </li>
                     @endif




                     <!-- Custom Menue end here -->
                    @if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeName()=='Developer')
                    <li class='treeview'>
                        <a href='#'><i class='fa fa-key'></i> <span>{{ trans('crudbooster.Privileges_Roles') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class='treeview-menu'>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/privileges/add*')) ? 'active' : '' }}"><a
                                        href='{{Route("PrivilegesControllerGetAdd")}}'>{{ $current_path }}<i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.Add_New_Privilege') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/privileges')) ? 'active' : '' }}"><a
                                        href='{{Route("PrivilegesControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.List_Privilege') }}</span></a></li>
                        </ul>
                    </li>





                    <li class='treeview'>
                        <a href='#'><i class='fa fa-users'></i> <span>{{ trans('crudbooster.Users_Management') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class='treeview-menu'>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/users/add*')) ? 'active' : '' }}"><a
                                        href='{{Route("AdminCmsUsersControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.add_user') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/users')) ? 'active' : '' }}"><a
                                        href='{{Route("AdminCmsUsersControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.List_users') }}</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/menu_management*')) ? 'active' : '' }}"><a
                                href='{{Route("MenusControllerGetIndex")}}'><i class='fa fa-bars'></i>
                            <span>{{ trans('crudbooster.Menu_Management') }}</span></a>
                    </li>
                    @endif

                    @if(CRUDBooster::myPrivilegeName()=='Developer')
                    <li class="treeview">
                        <a href="#"><i class='fa fa-wrench'></i> <span>{{ trans('crudbooster.settings') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class="treeview-menu">
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/settings/add*')) ? 'active' : '' }}"><a
                                        href='{{route("SettingsControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.Add_New_Setting') }}</span></a></li>
                            <?php
                            $groupSetting = DB::table('cms_settings')->groupby('group_setting')->pluck('group_setting');
                            foreach($groupSetting as $gs):
                            ?>
                            <li class="<?=($gs == Request::get('group')) ? 'active' : ''?>"><a
                                        href='{{route("SettingsControllerGetShow")}}?group={{urlencode($gs)}}&m=0'><i class='fa fa-wrench'></i>
                                    <span>{{$gs}}</span></a></li>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <li class='treeview'>
                        <a href='#'><i class='fa fa-th'></i> <span>{{ trans('crudbooster.Module_Generator') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class='treeview-menu'>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/module_generator/step1')) ? 'active' : '' }}"><a
                                        href='{{Route("ModulsControllerGetStep1")}}'><i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.Add_New_Module') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/module_generator')) ? 'active' : '' }}"><a
                                        href='{{Route("ModulsControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.List_Module') }}</span></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-dashboard'></i> <span>{{ trans('crudbooster.Statistic_Builder') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class='treeview-menu'>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder/add')) ? 'active' : '' }}"><a
                                        href='{{Route("StatisticBuilderControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.Add_New_Statistic') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder')) ? 'active' : '' }}"><a
                                        href='{{Route("StatisticBuilderControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.List_Statistic') }}</span></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-fire'></i> <span>{{ trans('crudbooster.API_Generator') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class='treeview-menu'>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/generator*')) ? 'active' : '' }}"><a
                                        href='{{Route("ApiCustomControllerGetGenerator")}}'><i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.Add_New_API') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator')) ? 'active' : '' }}"><a
                                        href='{{Route("ApiCustomControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.list_API') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/screet-key*')) ? 'active' : '' }}"><a
                                        href='{{Route("ApiCustomControllerGetScreetKey")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.Generate_Screet_Key') }}</span></a></li>
                        </ul>
                    </li>

                    <li class='treeview'>
                        <a href='#'><i class='fa fa-envelope-o'></i> <span>{{ trans('crudbooster.Email_Templates') }}</span> <i
                                    class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        <ul class='treeview-menu'>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/email_templates/add*')) ? 'active' : '' }}"><a
                                        href='{{Route("EmailTemplatesControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                    <span>{{ trans('crudbooster.Add_New_Email') }}</span></a></li>
                            <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/email_templates')) ? 'active' : '' }}"><a
                                        href='{{Route("EmailTemplatesControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                    <span>{{ trans('crudbooster.List_Email_Template') }}</span></a></li>
                        </ul>
                    </li>

                    <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/logs*')) ? 'active' : '' }}"><a href='{{Route("LogsControllerGetIndex")}}'><i
                                    class='fa fa-flag'></i> <span>{{ trans('crudbooster.Log_User_Access') }}</span></a>
                    </li>
                    @endif
                @endif

            </ul><!-- /.sidebar-menu -->

        </div>

    </section>
      <!-- Modal -->
                                                    <div class="modal fade" id="MENUADDCHANNEL" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="margin-top: 6.5em;border-radius: 8px;">
                                                            <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            </div>
                                                           <div class="menuadd-style">
                                                                <div class="modal-body" >
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2 ">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/gambio.jpg') }}" alt="Gambio Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            GAMBIO
                                                                        </h4>
                                                                        <p class="product-text-style" style="color:black;">
                                                                            Verbinde deinen Gambio-Shop (inkl. Gambio-Cloud) und verkaufe in deinem eigenen Shop. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                    <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=1')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/lengow.jpg') }}" alt="Lengow Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            LENGOW
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Verbinde dich mit Lengow und verkaufe in über 45 Ländern auf bis zu 2.000 Vertriebsplattformen. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        <a class="btn btn-warning" type="button" href="{{url('admin/shop_setting/add?id=2')}}"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/yatego.jpg') }}" alt="Yatego Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            YATEGO (Cooming soon)
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Yatego ist einer der größten deutschen Online-Marktplätze. Liste deine Angebote für mehr Reichweite. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        <a class="btn btn-warning" type="button" href="#"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/ebay.jpg') }}" alt="eBay Logo">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            EBAY (Cooming soon)
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Verkaufe im führenden Auktionshaus eBay. Deine Angebote werden auf eBay-Deutschland übertragen. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        <a class="btn btn-warning" type="button" href="#"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="border-bottom: 1px solid;width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/amazon.jpg') }}" alt="Amazon Image">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            AMAZON (Cooming soon)
                                                                        </h4>
                                                                        <p class="product-text-style">
                                                                            Verkaufe auf dem größten Marketplace und biete deine Produkte einem Millionen-Publikum an. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        <a class="btn btn-warning" type="button" href="#"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="width: 98%;margin: 0 auto;margin-bottom: 10px;">
                                                                    <div class="col-md-2">
                                                                        <img style="width:50px;height:50px" src="{{ asset('images/shop_logo/shopify.jpg') }}" alt="Shopify Image">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h4 style="color:blue;">
                                                                            SHOPIFY (Cooming soon)
                                                                        </h4>
                                                                        <p  class="product-text-style">
                                                                            Verbinde deinen Shopify-Shop und verkaufe in deinem eigenen Shop. Deine Produkte werden in deutscher Sprache gelistet.
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-2 text-right">
                                                                        <a class="btn btn-warning" type="button" href="#"><i class="fa fa-plus-square" style="color:white;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           </div>
                                                    </div>
                                                <!-- /.Modal End-->
    <!-- /.sidebar -->
    <style>
    .menuadd-style{
        max-height: 600px;
        width: 100%;
        overflow-x: hidden;
        overflow-y: auto;
      }
         .menuadd-style::-webkit-scrollbar {
            width: 10px;
         }
        .menuadd-style::-webkit-scrollbar-thumb {
            background-color: #A8A8A8;
            border-radius: 0 !important;
            box-shadow: none !important;
        }
        .menuadd-style::-webkit-scrollbar-track {
            background-color: #D9DBDC;
            border-radius: 0 !important;
            box-shadow: none !important;
        }
        .product-text-style{
            width: 423px;
            white-space: normal !important;
        }
        .pb-btn {
            border-radius: 5px;
            outline: none !important;
            box-shadow: none;
            border: none;
            color: black;
        }

        .modal-backdrop {
            z-index: -1;
        }
         #iframeMailModal .modal-content,
         #iFrameShopModal .modal-content{
            background: no-repeat;
            outline: 0;
            box-shadow: none;
        }
        .video_mail_modal .modal-header {
            border-bottom-color: none !important;
            border: none !important;
        }
        .video_mail_modal .close span {
            position: relative;
            top: 36px;
            right: -44px;
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
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
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
            -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%;
            -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
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
            -moz-border-radius: 50%; -webkit-border-radius: 50%; border-radius: 50%;
        }

        a:hover .video-link-icon,
        a:focus .video-link-icon {
            outline: 0;
            background: #fff;
            color: #e89a3e;
        }
        /*#notificationlabel {*/
        /*    background: red !important;*/
        /*    border-radius: 50%;*/
        /*    position: relative;*/
        /*    padding: 3px 5px;*/
        /*}*/
        </style>
</aside>

@push('bottom')
<script>

		if("{{$_GET['lang']}}" != "" && "{{$_GET['lang']}}" != 'de' ){
				$('ul.sidebar-menu li[data-id="16"]').removeClass('active');
				$('#ProductChannel').hide();
				console.log(("{{$_GET['lang']}}" != 'de'));
		}


</script>
@endpush
