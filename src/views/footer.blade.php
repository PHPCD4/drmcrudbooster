@push('bottom')
<style>
    #cookie-msg{
       z-index:999; 
    }
</style>
<script src="{{asset('resources/assets/js/jquery.cookieMessage.min.js')}}"></script>

<script>
$.cookieMessage({
  'mainMessage': '{!!trans('common.cookie_warning')!!}',
  'acceptButton': '{!!trans('common.cookie_accept') !!}',
  'backgroundColor': '#666',
  'fontSize': '14px',
  'fontColor': 'white',
  'btnBackgroundColor': '#f2a920',
  'btnFontSize': '11px',
  'btnFontColor': 'white',
  'linkFontColor': '#ffff00',
  'expirationDays': 20,
  'cookieName': 'cookieMessage'
});
</script>

<p align="left">
<!-- Start of expertiserocks Zendesk Widget script -->
<script>/**/window.zE||(function(e,t,s){var n=window.zE=window.zEmbed=function(){n._.push(arguments)}, a=n.s=e.createElement(t),r=e.getElementsByTagName(t)[0];n.set=function(e){ n.set._.push(e)},n._=[],n.set._=[],a.async=true,a.setAttribute("charset","utf-8"), a.src="https://static.zdassets.com/ekr/asset_composer.js?key="+s, n.t=+new Date,a.type="text/javascript",r.parentNode.insertBefore(a,r)})(document,"script","ec996b43-e9cc-43bc-93f4-6d0e07ece6c2");/**/</script>
<!-- End of expertiserocks Zendesk Widget script -->
</p align="left">

@endpush
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-{{ trans('crudbooster.right') }} hidden-xs">
        {{ trans('crudbooster.powered_by') }} {{Session::get('appname')}}
        
   
        
    </div>
    
    
    
    <!-- Default to the left -->
    <strong>{{ trans('crudbooster.copyright') }} &copy; <?php echo date('Y') ?>. {{ trans('crudbooster.all_rights_reserved') }} .</strong>
    
    <a href="{{url('admin/drm_pages/page/imprint')}}" class="" style="" > <strong>Imprint  </strong> </a>
    
    
</footer>
