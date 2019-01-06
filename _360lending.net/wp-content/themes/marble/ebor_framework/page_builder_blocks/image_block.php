<?php

class AQ_Ebor_Image_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Image',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('aq_ebor_image_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'image' => '',
			'url' => '',
			'target' => 0
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description note">
			<?php _e('Use this to add an image to your page, adjust by resizing this box. This will resize your image to the box size, but not crop your image, please upload a suitably sized image, large images will slow down your page load.', 'marble') ?>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				<?php _e('Upload an Image? (Required)', 'marble'); ?>
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Alt Text<br/>
				<?php echo aq_field_input('title', $block_id, $title) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('url') ?>">
				<?php _e('Link this Image? (Optional) Enter a URL', 'marble'); ?>
				<?php echo aq_field_input('url', $block_id, $url, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('target') ?>">
				<?php _e('Open this link in a new window?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('target', $block_id, $target) ?>
			</label>
		</p>

		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		
		($target == 1) ? $target = 'target="_blank"' : $target = '';
			
			if($url) echo '<a href="'.esc_url($url).'" '.$target.'>';
			echo '<img src="'.$image.'" alt="'.$title.'" />';
			if($url) echo '</a>';
			
	}
	
}