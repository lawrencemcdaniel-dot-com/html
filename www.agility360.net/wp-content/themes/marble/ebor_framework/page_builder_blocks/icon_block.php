<?php

class AQ_Icon_Column_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Icon Column',
			'size' => 'span3',
			//'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_icon_column_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'color' => '#9D9ABF',
			'image' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description note">
			<?php _e('Use this block to add columns of text with an icon above.', 'marble') ?>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				<?php _e('Upload an Icon', 'marble'); ?>
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('color') ?>">
				Icon Background Colour
				<?php echo aq_field_color_picker('color', $block_id, $color, $default = '#9D9ABF') ?>
			</label>
		</p>

		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo '<div class="services">';
			  echo '<div class="icon-wrapper" style="background: '.$color.';"><div class="icon"><img src="'.$image.'" alt="icon-'.$block_id.'" /></div></div>';
			  if($title) echo '<h4>'.$title.'</h4>';
			  echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
		echo '</div>';
			
	}
	
}