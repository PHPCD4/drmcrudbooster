@push('bottom')
<script src="{{ asset('vendor/crudbooster/assets/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<style>
    /*#cookie-msg{*/
    /*   z-index:999; */
    /*}*/
</style>

@php


$subs=DB::table('purchase_apps')
->join('cms_menus','cms_menus.id','=','purchase_apps.cms_modul_id')
->where('purchase_apps.cms_user_id',CRUDBooster::myId())
->where('purchase_apps.status',1)
->where('cms_menus.name','Live Chat')
->where(function($query) {
$query->where('purchase_apps.subscription_date_end','>', date('Y-m-d'))
->orWhere('purchase_apps.subscription_life_time',1);
})
->first();
@endphp
@if((CRUDBooster::myPrivilegeId() ==3 && $subs!=null) || (CRUDBooster::myPrivilegeId() !=3))
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
    window.__lc = window.__lc || {};
        window.__lc.license = 11672760;
        (function() {
            var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
            lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
        })();
</script>
<noscript>
    <a href="https://www.livechatinc.com/chat-with/11672760/" rel="nofollow">Chat with us</a>,
    powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>
<!-- End of LiveChat code -->
}
@endif

<!--<script src="{{asset('resources/assets/js/jquery.cookieMessage.min.js')}}"></script>-->

<!--<script>-->
<!--$.cookieMessage({-->
<!--  'mainMessage': '{!!trans('common.cookie_warning')!!}',-->
<!--  'acceptButton': '{!!trans('common.cookie_accept') !!}',-->
<!--  'backgroundColor': '#666',-->
<!--  'fontSize': '14px',-->
<!--  'fontColor': 'white',-->
<!--  'btnBackgroundColor': '#f2a920',-->
<!--  'btnFontSize': '11px',-->
<!--  'btnFontColor': 'white',-->
<!--  'linkFontColor': '#ffff00',-->
<!--  'expirationDays': 20,-->
<!--  'cookieName': 'cookieMessage'-->
<!--});-->
<!--</script>-->

<p align="left">
    <!-- Start of expertiserocks Zendesk Widget script -->
    <script>
        /**/window.zE||(function(e,t,s){var n=window.zE=window.zEmbed=function(){n._.push(arguments)}, a=n.s=e.createElement(t),r=e.getElementsByTagName(t)[0];n.set=function(e){ n.set._.push(e)},n._=[],n.set._=[],a.async=true,a.setAttribute("charset","utf-8"), a.src="https://static.zdassets.com/ekr/asset_composer.js?key="+s, n.t=+new Date,a.type="text/javascript",r.parentNode.insertBefore(a,r)})(document,"script","ec996b43-e9cc-43bc-93f4-6d0e07ece6c2");/**/
    </script>
    <!-- End of expertiserocks Zendesk Widget script -->
</p align="left">

<script type="text/javascript">
    (function() { var s = document.createElement("script"); s.type = "text/javascript"; s.async = true; s.src = '//api.usersnap.com/load/429263da-3e0c-4100-b15b-f7be7757c4d5.js';
    var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();
</script>

@if(CRUDBooster::myId() == 1 || CRUDBooster::myId() == 69 || CRUDBooster::myId() == 98)
<script type="text/javascript">
    (function() { var s = document.createElement("script"); s.type = "text/javascript"; s.async = true; s.src = '//api.usersnap.com/load/429263da-3e0c-4100-b15b-f7be7757c4d5.js';
    var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); })();
</script>
@endif

@endpush
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-{{ trans('crudbooster.right') }} hidden-xs">
        <!--{{ trans('crudbooster.powered_by') }} {{Session::get('appname')}}-->

        DRM powered by EXPERTISEROCKS®

    </div>



    <!-- Default to the left -->
    <strong>{{ trans('crudbooster.copyright') }} &copy; <?php echo date('Y') ?>.
        {{ trans('crudbooster.all_rights_reserved') }} .</strong>

    <a href="{{url('admin/drm_pages/page/imprint')}}" class="" style=""> <strong>Impressum </strong> </a>


</footer>
