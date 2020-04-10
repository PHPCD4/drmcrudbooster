<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">

    <title>{{ ($page_title)?Session::get('appname').': '.strip_tags($page_title):"Admin Area" }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name='generator' content='CRUDBooster 5.4.6'/>
    <meta name='robots' content='noindex,nofollow'/>
    <link rel="shortcut icon"
          href="{{ CRUDBooster::getSetting('favicon')?asset(CRUDBooster::getSetting('favicon')):asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="{{asset("vendor/crudbooster/assets/adminlte/font-awesome/css")}}/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="{{asset("vendor/crudbooster/ionic/css/ionicons.min.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css"/>

    <!-- support rtl-->
    @if (in_array(App::getLocale(), ['ar', 'fa']))
        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
        <link href="{{ asset("vendor/crudbooster/assets/rtl.css")}}" rel="stylesheet" type="text/css"/>
    @endif

    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/main.css")}}'/>
    <link rel='stylesheet' href='{{asset("vendor/crudbooster/assets/css/custom.css")}}'/>

    <!--custom link-->

    <link rel="stylesheet" href="{{ asset("vendor/crudbooster/assets/adminlte/dist/css/jvectormap/jquery-jvectormap.css")}}">


    <!-- load css -->
    <style type="text/css">
        @if($style_css)
            {!! $style_css !!}
        @endif
    </style>
    @if($load_css)
        @foreach($load_css as $css)
            <link href="{{$css}}" rel="stylesheet" type="text/css"/>
        @endforeach
    @endif

    <style type="text/css">
        .dropdown-menu-action {
            left: -130%;
        }

        .btn-group-action .btn-action {
            cursor: default
        }

        #box-header-module {
            box-shadow: 10px 10px 10px #dddddd;
        }

        .sub-module-tab li {
            background: #F9F9F9;
            cursor: pointer;
        }

        .sub-module-tab li.active {
            background: #ffffff;
            box-shadow: 0px -5px 10px #cccccc
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
            border: none;
        }

        .nav-tabs > li > a {
            border: none;
        }

        .breadcrumb {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
        }

        .form-group > label:first-child {
            display: block
        }
        .btn-orange{
            background-color: #f39c12;
            color: #fff;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .14), 0 3px 3px -2px rgba(0, 0, 0, .2), 0 1px 8px 0 rgba(0, 0, 0, .12) !important;
            transition: .5s;
        }
        .btn-orange:hover {
            background: #e89716;
            border: 1px solid #F39C12;
            color: #fff;
            transition: .5s;
        }
    </style>

    @stack('head')
</head>
<body class="@php echo (Session::get('theme_color'))?:'skin-blue'; echo ' '; echo config('crudbooster.ADMIN_LAYOUT'); @endphp {{($sidebar_mode)?:''}}">
<div id='app' class="wrapper">

    <!-- Header -->
@include('crudbooster::header')

<!-- Sidebar -->
@include('crudbooster::sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @php
        if(request()->is('admin/drm_orders')){
            $iframe_url_invoice_settings = 'https://player.vimeo.com/video/390617120';
            $iframe_urlorder_Import  = 'https://player.vimeo.com/video/390614240';
            $iframe_url_products_resend = 'https://player.vimeo.com/video/391580558';
        }elseif(request()->is('admin/fallback_calculation')){
            $iframe_url = 'https://player.vimeo.com/video/390614907';
            $action_add_data_title = 'Add new calculation';
        }elseif(request()->is('admin/price_category')){
            $iframe_url = 'https://player.vimeo.com/video/391566017';
        }elseif(request()->is('admin/common/produkte-importieren')){
            $iframe_url = 'https://player.vimeo.com/video/391571545';
            $page_title = 'Artikel hinzufügen';
        }elseif(request()->is('admin/drm_imports/import')){
            $import_new_product = 'https://player.vimeo.com/video/391571545';
            $product_sync = 'https://player.vimeo.com/video/393321002';
        }
    @endphp

    
    <div class="row">
        <div class="col-md-5">
            
            @if ($iframe_url_invoice_settings)
            <div >
                <div class="play-button" id="play_buttoniframeSuplieVideoModal" style="position: relative;padding-top: 5px;text-align: right;margin-right: 7.5em;left: 0;" >
                    <button class="btn pb-btn" style="margin: 0;background: orange;color: #fff;" data-toggle="modal"
                        data-target="#iframeSuplieVideoModalInvoice"><i class="fa fa-play-circle" aria-hidden="true"></i>
                        Play</button>
                    <!-- Modal -->
                    <div class="modal fade iframeSuplieVideoModal" id="iframeSuplieVideoModalInvoice" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true" onclick="suplieStopVideo()">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <iframe id="supliefocusvideoInvoice" src="{{ $iframe_url_invoice_settings }}" width="640"
                                        height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-md-4">
            @if ($iframe_urlorder_Import)
                <div style="height: 0">
                    <div style="position: relative;padding-top: 0px;text-align: right;margin-right: 20em;left: 0;top: 5px;">
                        <button class="btn pb-btn" style="margin: 0;background: orange;color: #fff;" data-toggle="modal"
                            data-target="#iframeSuplieVideoModalImport"><i class="fa fa-play-circle" aria-hidden="true"></i>
                            Play</button>
                        <!-- Modal -->
                        <div class="modal fade iframeSuplieVideoModal" id="iframeSuplieVideoModalImport" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"
                                                onclick="suplieStopVideo()">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe id="supliefocusvideoImport" src="{{ $iframe_urlorder_Import }}" width="640" height="360"
                                            frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-3">
            @if ($iframe_url_products_resend)
            <div style="height: 0">
                <div style="position: relative;padding-top: 0px;text-align: right;margin-right: 1em;left: 0;top: 5px;">
                    <button class="btn pb-btn" style="margin: 0;background: orange;color: #fff;" data-toggle="modal"
                        data-target="#iframeSuplieVideoModalproducts_resend"><i class="fa fa-play-circle" aria-hidden="true"></i>
                        Products and Resend</button>
                    <!-- Modal -->
                    <div class="modal fade iframeSuplieVideoModal" id="iframeSuplieVideoModalproducts_resend" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true" onclick="suplieStopVideo()">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <iframe id="supliefocusvideoproducts_resend" src="{{ $iframe_url_products_resend }}" width="640"
                                        height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

<div class="btn-content" style="position: absolute;content: ''; width: 85%;margin-top: 13px;z-index: 99;">
    <div class="row">
        <div class="col-md-6">
            @if ($import_new_product)
                <div class="pull-right">
                    <div class="play-button" id="play_buttoniframeSuplieVideoModal" style="position: relative;padding-top: 0px;text-align: right;left: 0;" >
                        <button class="btn pb-btn" style="margin: 0;background: orange;color: #fff;" data-toggle="modal"
                            data-target="#iframeImportNewProduct"><i class="fa fa-play-circle" aria-hidden="true"></i>
                            Import New Product</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade iframeSuplieVideoModal" id="iframeImportNewProduct" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true" onclick="suplieStopVideo()">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <iframe id="" src="{{ $import_new_product }}" width="640"
                                        height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </div>
        <div class="col-md-6">
            @if ($product_sync)
            <div class="pull-left" style="height: 0">
                <div style="position: relative;padding-top: 0px;text-align: right;left: 0;">
                    <button class="btn pb-btn" style="margin: 0;background: orange;color: #fff;" data-toggle="modal"
                        data-target="#iframeProduct_sync"><i class="fa fa-play-circle" aria-hidden="true"></i>
                        product Sync</button>
                    <!-- Modal -->
                    <div class="modal fade iframeSuplieVideoModal" id="iframeProduct_sync" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true" onclick="suplieStopVideo()">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <iframe id="" src="{{ $product_sync }}" width="640"
                                        height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>   
    </div>
</div>



    <section class="content-header">

            <?php
            $module = CRUDBooster::getCurrentModule();
            ?>
            @if($module)
                <h1>
                    <i class='{{($page_icon)?:$module->icon}}'></i> {{($page_title)?:$module->name}} &nbsp;&nbsp;

                    <!--START BUTTON -->

                    @if(CRUDBooster::getCurrentMethod() == 'getIndex')
                        @if($button_show)
                            <a href="{{ CRUDBooster::mainpath().'?'.http_build_query(Request::all()) }}" id='btn_show_data' class="btn btn-sm btn-primary"
                               title="{{trans('crudbooster.action_show_data')}}">
                                <i class="fa fa-table"></i> {{trans('crudbooster.action_show_data')}}
                            </a>
                        @endif

                        @if($button_add && CRUDBooster::isCreate())
                            <a href="{{ CRUDBooster::mainpath('add').'?return_url='.urlencode(Request::fullUrl()).'&parent_id='.g('parent_id').'&parent_field='.$parent_field }}"
                               id='btn_add_new_data' class="btn btn-sm btn-orange" title="{{trans('crudbooster.action_add_data') }}">
                                <i class="fa fa-plus-circle"></i> {{ ($action_add_data_title)?:trans('crudbooster.action_add_data') }}
                            </a>
                        @endif
                    @endif


                    @if($button_export && CRUDBooster::getCurrentMethod() == 'getIndex')
                        <a href="javascript:void(0)" id='btn_export_data' data-url-parameter='{{$build_query}}' title='Export Data'
                           class="btn btn-sm btn-primary btn-export-data">
                            <i class="fa fa-upload"></i> {{trans("crudbooster.button_export")}}
                        </a>
                    @endif

                    @if($button_import && CRUDBooster::getCurrentMethod() == 'getIndex')
                        <a href="{{ CRUDBooster::mainpath('import-data') }}" id='btn_import_data' data-url-parameter='{{$build_query}}' title='Import Data'
                           class="btn btn-sm btn-primary btn-import-data">
                            <i class="fa fa-download"></i> {{trans("crudbooster.button_import")}}
                        </a>
                    @endif

                <!--ADD ACTIon-->
                    @if(!empty($index_button))

                        @foreach($index_button as $ib)
                            <a href='{{$ib["url"]}}' id='{{str_slug($ib["label"])}}' class='btn {{($ib['color'])?'btn-'.$ib['color']:'btn-primary'}} btn-sm'
                               @if($ib['onClick']) onClick='return {{$ib["onClick"]}}' @endif
                               @if($ib['onMouseOver']) onMouseOver='return {{$ib["onMouseOver"]}}' @endif
                               @if($ib['onMouseOut']) onMouseOut='return {{$ib["onMouseOut"]}}' @endif
                               @if($ib['onKeyDown']) onKeyDown='return {{$ib["onKeyDown"]}}' @endif
                               @if($ib['onLoad']) onLoad='return {{$ib["onLoad"]}}' @endif
                            >
                                <i class='{{$ib["icon"]}}'></i> {{$ib["label"]}}
                            </a>
                    @endforeach
                @endif
                <!-- END BUTTON -->
                </h1>

                <style>
                    .iframeSuplieVideoModal .modal-content {
                        position: relative;
                        background: none;
                        outline: 0;
                        box-shadow: none;
                    }
                    .iframeSuplieVideoModal .modal-header {
                        border-bottom-color: none !important;
                        border: none !important;
                    }
                    .iframeSuplieVideoModal .close span {
                        position: absolute;
                        top: 46px;
                        right: -100px;
                        border: 1px solid #fff;
                        padding: 5px 10px;
                        color: #fff !important;
                        z-index: 999;
                    }
                    div#play_buttoniframeSuplieVideoModal {
                        position: absolute;
                        content: '';
                        top: 38%;
                        left: 30%;
                    }
                </style>


                @if ($iframe_url)
                <div class="play-button" id="play_buttoniframeSuplieVideoModal" style="{{ request()->is('admin/fallback_calculation') ? 'margin-left: 6em;':'' }}">
                    <button class="btn pb-btn" style="margin: 0;background: orange;color: #fff;" data-toggle="modal" data-target="#iframeSuplieVideoModal{{ $table }}"><i class="fa fa-play-circle" aria-hidden="true"></i>
                    Play</button>
                    <!-- Modal -->
                    <div class="modal fade iframeSuplieVideoModal" id="iframeSuplieVideoModal{{ $table }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" onclick="suplieStopVideo()">&times;</span></button>
                          </div>
                          <div class="modal-body">
                            <iframe id="supliefocusvideo{{ $table }}" src="{{ $iframe_url }}" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                @endif

                <ol class="breadcrumb">
                    <li><a href="{{CRUDBooster::adminPath()}}"><i class="fa fa-dashboard"></i> {{ trans('crudbooster.home') }}</a></li>
                    <li class="active">{{$module->name}}</li>
                </ol>
            @else
                <h1>{{ ($page_title) ? $page_title : Session::get('appname') }}
                    <!--<small>Information</small>-->
                </h1>
            @endif
        </section>


        <!-- Main content -->
        <section id='content_section' class="content">

            @if(@$alerts)
                @foreach(@$alerts as $alert)
                    <div class='callout callout-{{$alert["type"]}}'>
                        {!! $alert['message'] !!}
                    </div>
                @endforeach
            @endif


            @if (Session::get('message')!='')
                <div class='alert alert-{{ Session::get("message_type") }}'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> {{ trans("crudbooster.alert_".Session::get("message_type")) }}</h4>
                    {!!Session::get('message')!!}
                </div>
            @endif



        <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('crudbooster::footer')

</div><!-- ./wrapper -->


@include('crudbooster::admin_template_plugins')

<!-- load js -->
@if($load_js)
    @foreach($load_js as $js)
        <script src="{{$js}}"></script>
    @endforeach
@endif
<script type="text/javascript">
    var site_url = "{{url('/')}}";
    @if($script_js)
        {!! $script_js !!}
    @endif
</script>

<script>
    // ...... stop modal video function
    function suplieStopVideo() {
        var $frame = $('iframe#supliefocusvideo{{ $table }}');

        // saves the current iframe source
        var vidsrc = $frame.attr('src');

        // sets the source to nothing, stopping the video
        $frame.attr('src', '');

        // sets it back to the correct link so that it reloads immediately on the next window open
        $frame.attr('src', vidsrc);
    }

    $('#iframeSuplieVideoModal{{ $table }}').on('hidden.bs.modal', function(e) {
        suplieStopVideo();
    })
</script>

@stack('bottom')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>

</html>
