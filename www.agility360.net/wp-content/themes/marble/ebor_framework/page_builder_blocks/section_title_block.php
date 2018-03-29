<?php

class AQ_Section_Title_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => '1Page - Title',
			'size' => 'span12',
			'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_section_title_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'subtitle' => '',
			'icon' => '',
			'responsive_first' => 0,
			'code_display' => 0,
			'centered' => 0,
			'wpautop' => 0
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
		<p class="description note">
			<?php _e("Use this block to add a section title if you're usiing the one pager version of Marble", 'marble') ?>
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
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		echo '<h3 class="main-title">'.$title;
		if($subtitle) echo '<span>'.$subtitle.'</span>';
		echo '</h3>';
		
	}
	
}