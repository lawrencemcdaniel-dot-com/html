<?php

class AQ_Map_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Map',
			'size' => 'span12',
			'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_map_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'image' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description note">
			<?php _e('Use this block to add a map to your page.', 'marble') ?>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				<?php _e('Upload a Marker Image', 'marble'); ?>
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Address for map, use plain text, e.g: <code>Lord Mayors Walk, York, England</code><br /><code>Note: You require a Google Maps API key for this to work, please see the settings in <a href="<?php echo admin_url('/customize.php'); ?>">Appearance => Customize</a></code>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>


		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo '<div class="map-' . $block_id . ' map"></div>'; 
		echo "<script type='text/javascript'>
				jQuery(document).ready(function($){
				'use strict';
				
					jQuery('.map-" . $block_id . "').goMap({ address: '$title',
					  zoom: 14,
					  mapTypeControl: false,
				      draggable: false,
				      scrollwheel: false,
				      streetViewControl: false,
				      maptype: 'ROADMAP',
			    	  markers: [
			    		{ 'address' : '$title' }
			    	  ],
					  icon: '$image', 
					  addMarker: false
					});
				
				});
			</script>";
			
	}
	
}