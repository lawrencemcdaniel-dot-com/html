<?php 
// block direct access to plugin PHP files:
defined( 'ABSPATH' ) or die(1);

add_action( 'admin_init', 'opinionstage_tracking' );
function opinionstage_tracking(){
	add_action('admin_notices', 'opinionstage_tracking_user_info');
}

function opinionstage_tracking_user_info() {
	$message_title_display = 'Love using OpinionStage? Become a super contributor by opting in to our anonymous plugin data collection and to our updates. We guarantee no sensitive data is collected. ';
	if(!get_option('oswp_tracking_user_site_data') && get_option('oswp_tracking_user_site_data') == false){
	echo '<div class="notice" id="oswp_hide_tracking_notice" style="overflow: hidden; padding-top: 10px; padding-bottom: 20px;"><img style="margin-top:8px;float: left;width:70px; " src="' . esc_url( plugins_url( 'admin/images/opinionstage-tracking-notice.png', plugin_dir_path(__FILE__) ) ) . '"><p style="margin-top: 6px;margin-left: 10px;float: none;margin-bottom: 10px;">'.$message_title_display.'&nbsp;<span><a href="https://help.opinionstage.com/wordpress-plugin/wordpress-plugin-usage-data-tracking" target="_blank">Learn more. </a></span></p><button id="track_user_data" type="submit" class="button button-primary button-large">Sure I\'d love to help</button><button style="margin-left: 10px;" id="track_user_data_no_thanks" class="button button-large">No thanks</button></div>';
	}

}

add_action( 'admin_footer', 'tracking_user_js_opinionstage' ); // Write our JS below here

function tracking_user_js_opinionstage() { ?>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('button#track_user_data').on('click', function(event) {
	    event.preventDefault();
	    var $button = $(this);
        $button.addClass('disabled').append('<i class="fa fa-spinner fa-spin" style="font-size: 15px;margin-left: 5px;color: #ffffff;"></i>');
	    // Sending ajax to allow tracking
	   	var data = {
			'action': 'opinionstage_ajax_tracking_user_data',
			'oswp_track_user_data' : 'yes'
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			if(response){
				$('#oswp_hide_tracking_notice').hide(500);
			}
		});
	});
	$('button#track_user_data_no_thanks').on('click', function(event) {
	    event.preventDefault();
	    var $button = $(this);
        $button.addClass('disabled').append('<i class="fa fa-spinner fa-spin" style="font-size: 15px;margin-left: 5px;color: #000000;"></i>');;
	    // Sending ajax to not tracking
	   	var data = {
			'action': 'opinionstage_ajax_tracking_user_data',
			'oswp_track_user_data' : 'no'
		};
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			if(response){
				$('#oswp_hide_tracking_notice').hide(500);
			}
		});
	});
});
</script>
<?php } 