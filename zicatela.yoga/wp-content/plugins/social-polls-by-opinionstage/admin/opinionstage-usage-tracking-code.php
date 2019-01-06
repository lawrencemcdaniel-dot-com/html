<?php
// block direct access to plugin PHP files:
defined( 'ABSPATH' ) or die();

if(get_option('oswp_tracking_user_site_data') == 'yes'){ ?>
<!-- Hotjar Tracking Code for https://wordpress.org/plugins/social-polls-by-opinionstage/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1142399,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<?php }