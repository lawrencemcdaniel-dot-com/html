<?php
// block direct access to plugin PHP files:
defined( 'ABSPATH' ) or die();
?>
<div id="opinionstage-content">
	<div class="opinionstage-header-wrapper">
		<div class="opinionstage-logo-wrapper">
			<div class="opinionstage-logo"></div>
		</div>
		<?php if ( !$os_client_logged_in ) {?>
			<div class="opinionstage-status-content">
				<div class='opinionstage-status-title'><b>Connect WordPress with Opinion Stage to Get Started</b></div>
				<form action="<?php echo OPINIONSTAGE_LOGIN_PATH ?>" method="get" class="opinionstage-connect-form">
					<i class="os-icon icon-os-poll-client"></i>
					<input type="hidden" name="utm_source" value="<?php echo OPINIONSTAGE_UTM_SOURCE ?>">
					<input type="hidden" name="utm_campaign" value="<?php echo OPINIONSTAGE_UTM_CAMPAIGN ?>">
					<input type="hidden" name="utm_medium" value="<?php echo OPINIONSTAGE_UTM_MEDIUM ?>">
					<input type="hidden" name="o" value="<?php echo OPINIONSTAGE_WIDGET_API_KEY ?>">
					<input type="hidden" name="callback" value="<?php echo opinionstage_callback_url()?>">
					<input id="os-email" type="email" name="email" placeholder="Enter Your Email" data-os-email-input>
					<button class="opinionstage-connect-btn opinionstage-blue-btn" type="submit" id="os-start-login" data-os-login>CONNECT</button>
				</form>
			</div>
		<?php } else { ?>
			<div class="opinionstage-status-content-connected">
				<div class='opinionstage-status-title'>You are connected to Opinion Stage with the following email</div>
				<i class="os-icon icon-os-form-success"></i>
				<label class="checked" for="user-email"></label>
				<input id="os-email" type="email" disabled value="<?php echo($os_options["email"]) ?>">
				<form method="POST" action="<?php echo get_admin_url(null, 'admin.php?page=opinionstage-disconnect-page')?>" class="opinionstage-connect-form">
					<button class="opinionstage-connect-btn opinionstage-blue-btn" type="submit" id="os-disconnect">DISCONNECT</button>
				</form>
			</div>
		<?php } ?>
	</div>
	<?php if( $os_client_logged_in ){  ?>
		<div class="gettingStartedSection">
			<div class="Video-Section">
				<p><b>We recommend that you start by viewing this short introduction video</b></p>
				<iframe class="iframe-new" width="600" height="338" src="https://www.youtube.com/embed/zwcRWGsOxxQ?rel=0&showinfo=0" frameborder="0" allowfullscreen=""></iframe>
				<a href="<?php echo admin_url( 'admin.php?page='.OPINIONSTAGE_MENU_SLUG); ?>" class="gettingStartedCreate button">Start Creating Interactive Content</a>
			</div>
		</div>
	<?php }else{ ?>
		<div class="gettingStartedSection">
			<div class="Video-Section">
				<iframe class="iframe-new" width="600" height="338" src="https://www.youtube.com/embed/zwcRWGsOxxQ?rel=0&showinfo=0" frameborder="0" allowfullscreen=""></iframe>
			</div>
			<div class="text-section-getting-stared-os">
				<p><b>Need more information?</b></p>
				<ul>
					<li><a href="https://www.opinionstage.com/blog/how-to-add-interactive-content-on-wordpress/?utm_campaign=WPMainPI&amp;utm_medium=linkgettingstarted&amp;utm_source=wordpress&amp;o=wp35e8" target="_blank">Getting started tutorial</a></li>
					<li><a href="https://www.opinionstage.com/discover?utm_campaign=WPMainPI&amp;utm_medium=linkexamples&amp;utm_source=wordpress&amp;o=wp35e8" target="_blank">View examples</a></li>
					<li><a href="https://help.opinionstage.com/?utm_campaign=WPMainPI&amp;utm_medium=linkhelpcenter&amp;utm_source=wordpress&amp;o=wp35e8" target="_blank">Opinion Stage help center</a></li>
				</ul>
			</div>
		</div>
	<?php } ?>
</div>