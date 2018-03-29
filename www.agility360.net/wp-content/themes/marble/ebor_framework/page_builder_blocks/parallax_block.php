<?php

class AQ_Parallax_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => '1Page - Parallax',
			'size' => 'span12',
			'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_parallax_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'subtitle' => '',
			'image' => '',
			'link' => '',
			'buttontext' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description note">
			<?php _e('Use this block to add columns of text with an icon above.', 'marble') ?>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				<?php _e('Upload a Background Image (Required)', 'marble'); ?>
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('subtitle') ?>">
				Subtitle (optional)
				<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('buttontext') ?>">
				Button Text
				<?php echo aq_field_input('buttontext', $block_id, $buttontext, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('link') ?>">
				Button Link
				<?php echo aq_field_input('link', $block_id, $link, $size = 'full') ?>
			</label>
		</p>

		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo '<div class="parallax" style="background-image: url('.$image.' );"><div class="container inner">';
		if($title) echo '<h1>'.htmlspecialchars_decode($title).'</h1><div class="divide20"></div>';
		if($subtitle) echo '<p class="lead">'.htmlspecialchars_decode($subtitle).'</p><div class="divide15"></div>';
		if($buttontext) echo '<div class="scroll"><a href="'.$link.'" class="btn btn-large">'.$buttontext.'</a></div>';
		echo '</div></div>';
			
	}
	
}