<?php 
// block direct access to plugin PHP files:
defined( 'ABSPATH' ) or die(1);

if(isset($_POST['submit_tracking']) && $_POST['submit_tracking'] == 'Save Changes'){
	if(isset($_POST['opinionstage_allow_tracking']) && $_POST['opinionstage_allow_tracking'] == 'yes'){
		update_option('oswp_tracking_user_site_data', 'yes');
	}else{
		update_option('oswp_tracking_user_site_data','no');
	}
}
$usage_enabled = get_option('oswp_tracking_user_site_data');
?>

<div class="wrap">
<h1 class="wp-heading-inline">Settings</h1>
<h2>Improve OpinionStage</h2>
<form method="post" action="">
	<table class="form-table">
		<tbody>
			<tr class="opinionstage_allow_tracking">
				<th scope="row">Usage Data Tracking</th>
				<td>
					<label>					
						<input type="checkbox" name="opinionstage_allow_tracking" value="yes" <?php echo ($usage_enabled=='yes') ? 'checked="checked"' : ''; ?> >
						Opt-in to our anonymous plugin data collection and to updates. We guarantee no sensitive data is collected. 
						<a href="https://help.opinionstage.com/wordpress-plugin/wordpress-plugin-usage-data-tracking" target="_blank">Learn more.</a>		
					</label>
				</td>
			</tr>
		</tbody>
	</table>
	<input type="submit" name="submit_tracking" class="button button-primary" value="Save Changes">
</form>
</div>
