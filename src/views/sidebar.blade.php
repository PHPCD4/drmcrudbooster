<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-{{ trans('crudbooster.left') }} image">
                <img src="{{ CRUDBooster::myPhoto() }}" class="img-circle" alt="{{ trans('crudbooster.user_image') }}"/>
            </div>
            <div class="pull-{{ trans('crudbooster.left') }} info">
                <p>{{ CRUDBooster::myName() }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('crudbooster.online') }}</a>
            </div>
        </div>


        <div class='main-menu'>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">{{trans("crudbooster.menu_navigation")}}</li>
                <!-- Optionally, you can add icons to the links -->

                <?php $dashboard = CRUDBooster::sidebarDashboard();?>
                @if($dashboard)
                    <li data-id='{{$dashboard->id}}' class="{{ (Request::is(config('crudbooster.ADMIN_PATH'))) ? 'active' : '' }}"><a
                                href='{{CRUDBooster::adminPath()}}' class='{{($dashboard->color)?"text-".$dashboard->color:""}}'><i class='fa fa-dashboard'></i>
                            <span>{{trans("crudbooster.text_dashboard")}}</span> </a></li>
                @endif

                @foreach(CRUDBooster::sidebarMenu() as $menu)
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
                            </span>
                            @if(!empty($menu->children))<i class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i>@endif
                        </a>
                        @if(!empty($menu->children))
                            <ul class="treeview-menu">
                                @foreach($menu->children as $child)
                                    <li data-id='{{$child->id}}' class='{{(Request::is($child->url_path .= !ends_with(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}}'>
                                        <a href='{{ ($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url}}'
                                           class='{{($child->color)?"text-".$child->color:""}}'>
                                            <i class='{{$child->icon}}'></i>
                                                <span>
                                                    @if (preg_match('#^[A-Z]+$#',$child->name))
                                                        {{ trans("menu.".$child->name) }}
                                                        @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $child->icon_img))
                                                            <img src="{{$child->icon_img}}">
                                                        @endif
                                                    @else
                                                        {{ $child->name }}
                                                        @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $child->icon_img))
                                                            <img src="{{$child->icon_img}}">
                                                        @endif
                                                    @endif
                                                </span>
                                        </a>
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
                    <a href='https://dropshipping.university/login/' target="_blank"> <i class="fa fa-video-camera" aria-hidden="true"></i> <span>@lang('Video-Training')</span> <i
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
    <!-- /.sidebar -->
</aside>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-{{ trans('crudbooster.left') }} image">
                <img src="{{ CRUDBooster::myPhoto() }}" class="img-circle"
                    alt="{{ trans('crudbooster.user_image') }}" />
            </div>
            <div class="pull-{{ trans('crudbooster.left') }} info">
                <p>{{ CRUDBooster::myName() }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('crudbooster.online') }}</a>
            </div>
        </div>


        <div class='main-menu'>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">{{trans("crudbooster.menu_navigation")}}</li>
                <!-- Optionally, you can add icons to the links -->

                <?php $dashboard = CRUDBooster::sidebarDashboard();?>
                @if($dashboard)
                <li data-id='{{$dashboard->id}}'
                    class="{{ (Request::is(config('crudbooster.ADMIN_PATH'))) ? 'active' : '' }}"><a
                        href='{{CRUDBooster::adminPath()}}'
                        class='{{($dashboard->color)?"text-".$dashboard->color:""}}'><i class='fa fa-dashboard'></i>
                        <span>{{trans("crudbooster.text_dashboard")}}</span> </a></li>
                @endif

                @foreach(CRUDBooster::sidebarMenu() as $menu)
                <li data-id='{{$menu->id}}'
                    class='{{(!empty($menu->children))?"treeview":""}} {{ (Request::is($menu->url_path."*"))?"active":""}}'>
                    <a href='{{ ($menu->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$menu->url }}'
                        class='{{($menu->color)?"text-".$menu->color:""}}'>
                        <i class='{{$menu->icon}} {{($menu->color)?"text-".$menu->color:""}}'></i>
                        <span>
                            @if (preg_match('#^[A-Z]+$#',$menu->name))
                            {{ trans("menu.".$menu->name) }}
                            @else
                            {{ $menu->name }}
                            @endif
                        </span>
                        @if(!empty($menu->children))<i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i>@endif
                    </a>
                    @if(!empty($menu->children))
                    <ul class="treeview-menu">
                        @foreach($menu->children as $child)
                        <li data-id='{{$child->id}}'
                            class='{{(Request::is($child->url_path .= !ends_with(Request::decodedPath(), $child->url_path) ? "/*" : ""))?"active":""}}'>
                            <a href='{{ ($child->is_broken)?"javascript:alert('".trans('crudbooster.controller_route_404')."')":$child->url}}'
                                class='{{($child->color)?"text-".$child->color:""}}'>
                                <i class='{{$child->icon}}'></i>
                                <span>
                                    @if (preg_match('#^[A-Z]+$#',$child->name))
                                    {{ trans("menu.".$child->name) }}
                                    @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $child->icon_img))
                                    <img src="{{$child->icon_img}}">
                                    @endif
                                    @else
                                    {{ $child->name }}
                                    @if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $child->icon_img))
                                    <img src="{{$child->icon_img}}">
                                    @endif
                                    @endif
                                </span>
                            </a>
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
                    <a href='https://dropshipping.university/login/' target="_blank"> <i class="fa fa-video-camera"
                            aria-hidden="true"></i> <span>@lang('Video-Training')</span> <i class="#"></i></a>

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
                        <li class="#"><a href='{{CRUDBooster::adminPath('common/subscription')}}'><i
                                    class='fa fa-circle-o'></i>
                                <span>{{ trans('Subscription-Forecast') }}</span></a></li>
                        <li class="#"><a href='{{CRUDBooster::adminPath('common/cancellation')}}'><i
                                    class='fa fa-circle-o'></i>
                                <span>{{ trans('Subscription-Cancellations') }}</span></a></li>
                        <li class="#"><a href='{{CRUDBooster::adminPath('common/drm-member')}}'><i
                                    class='fa fa-circle-o'></i>
                                <span>{{ trans('DRM Member') }}</span></a></li>
                        <li class="#"><a href='{{CRUDBooster::adminPath('common/all-order')}}'><i
                                    class='fa fa-circle-o'></i>
                                <span>{{ trans('All Orders') }}</span></a></li>
                    </ul>
                </li>

                <li class='treeview'>
                    <a href='#'><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Project Management</span> <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li class="#"> <a href='{{CRUDBooster::adminPath('common/board')}}'> <i class="fa fa-tasks"
                                    aria-hidden="true"></i> <span>@lang('Board')</span> <i
                                    class="fa fa-angle-{{ trans("#") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                        </li>

                    </ul>
                </li>
                @endif




                <!-- Custom Menue end here -->
                @if(CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeName()=='Developer')
                <li class='treeview'>
                    <a href='#'><i class='fa fa-key'></i> <span>{{ trans('crudbooster.Privileges_Roles') }}</span> <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/privileges/add*')) ? 'active' : '' }}">
                            <a href='{{Route("PrivilegesControllerGetAdd")}}'>{{ $current_path }}<i
                                    class='fa fa-plus'></i>
                                <span>{{ trans('crudbooster.Add_New_Privilege') }}</span></a></li>
                        <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/privileges')) ? 'active' : '' }}">
                            <a href='{{Route("PrivilegesControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                <span>{{ trans('crudbooster.List_Privilege') }}</span></a></li>
                    </ul>
                </li>





                <li class='treeview'>
                    <a href='#'><i class='fa fa-users'></i> <span>{{ trans('crudbooster.Users_Management') }}</span> <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/users/add*')) ? 'active' : '' }}">
                            <a href='{{Route("AdminCmsUsersControllerGetAdd")}}'><i class='fa fa-plus'></i>
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
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/settings/add*')) ? 'active' : '' }}">
                            <a href='{{route("SettingsControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                <span>{{ trans('crudbooster.Add_New_Setting') }}</span></a></li>
                        <?php
                            $groupSetting = DB::table('cms_settings')->groupby('group_setting')->pluck('group_setting');
                            foreach($groupSetting as $gs):
                            ?>
                        <li class="<?=($gs == Request::get('group')) ? 'active' : ''?>"><a
                                href='{{route("SettingsControllerGetShow")}}?group={{urlencode($gs)}}&m=0'><i
                                    class='fa fa-wrench'></i>
                                <span>{{$gs}}</span></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li class='treeview'>
                    <a href='#'><i class='fa fa-th'></i> <span>{{ trans('crudbooster.Module_Generator') }}</span> <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/module_generator/step1')) ? 'active' : '' }}">
                            <a href='{{Route("ModulsControllerGetStep1")}}'><i class='fa fa-plus'></i>
                                <span>{{ trans('crudbooster.Add_New_Module') }}</span></a></li>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/module_generator')) ? 'active' : '' }}">
                            <a href='{{Route("ModulsControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                <span>{{ trans('crudbooster.List_Module') }}</span></a></li>
                    </ul>
                </li>

                <li class='treeview'>
                    <a href='#'><i class='fa fa-dashboard'></i>
                        <span>{{ trans('crudbooster.Statistic_Builder') }}</span> <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder/add')) ? 'active' : '' }}">
                            <a href='{{Route("StatisticBuilderControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                <span>{{ trans('crudbooster.Add_New_Statistic') }}</span></a></li>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/statistic_builder')) ? 'active' : '' }}">
                            <a href='{{Route("StatisticBuilderControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                <span>{{ trans('crudbooster.List_Statistic') }}</span></a></li>
                    </ul>
                </li>

                <li class='treeview'>
                    <a href='#'><i class='fa fa-fire'></i> <span>{{ trans('crudbooster.API_Generator') }}</span> <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/generator*')) ? 'active' : '' }}">
                            <a href='{{Route("ApiCustomControllerGetGenerator")}}'><i class='fa fa-plus'></i>
                                <span>{{ trans('crudbooster.Add_New_API') }}</span></a></li>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator')) ? 'active' : '' }}">
                            <a href='{{Route("ApiCustomControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                <span>{{ trans('crudbooster.list_API') }}</span></a></li>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/api_generator/screet-key*')) ? 'active' : '' }}">
                            <a href='{{Route("ApiCustomControllerGetScreetKey")}}'><i class='fa fa-bars'></i>
                                <span>{{ trans('crudbooster.Generate_Screet_Key') }}</span></a></li>
                    </ul>
                </li>

                <li class='treeview'>
                    <a href='#'><i class='fa fa-envelope-o'></i> <span>{{ trans('crudbooster.Email_Templates') }}</span>
                        <i
                            class="fa fa-angle-{{ trans("crudbooster.right") }} pull-{{ trans("crudbooster.right") }}"></i></a>
                    <ul class='treeview-menu'>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/email_templates/add*')) ? 'active' : '' }}">
                            <a href='{{Route("EmailTemplatesControllerGetAdd")}}'><i class='fa fa-plus'></i>
                                <span>{{ trans('crudbooster.Add_New_Email') }}</span></a></li>
                        <li
                            class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/email_templates')) ? 'active' : '' }}">
                            <a href='{{Route("EmailTemplatesControllerGetIndex")}}'><i class='fa fa-bars'></i>
                                <span>{{ trans('crudbooster.List_Email_Template') }}</span></a></li>
                    </ul>
                </li>

                <li class="{{ (Request::is(config('crudbooster.ADMIN_PATH').'/logs*')) ? 'active' : '' }}"><a
                        href='{{Route("LogsControllerGetIndex")}}'><i class='fa fa-flag'></i>
                        <span>{{ trans('crudbooster.Log_User_Access') }}</span></a>
                </li>
                @endif
                @endif

            </ul><!-- /.sidebar-menu -->

        </div>

    </section>
    <!-- /.sidebar -->
</aside>
