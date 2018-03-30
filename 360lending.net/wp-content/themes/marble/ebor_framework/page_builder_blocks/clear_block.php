<?php
/** "Clear" block 
 * 
 * Clear the floats vertically
 * Optional to use horizontal lines/images
**/
class AQ_Ebor_Clear_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Clear',
			'size' => 'span12'
		);
		
		//create the block
		parent::__construct('aq_ebor_clear_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'horizontal_line' => 'none',
			'line_color' => '#dbdbdb',
			'pattern' => '1',
			'height' => ''
		);
		
		$line_options = array(
			'none' => 'No Line',
			'single' => 'Horizontal Line'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$line_color = isset($line_color) ? $line_color : '#dbdbdb';
		
		?>
		<p class="description note">
			<?php _e('Use this block to clear the floats between two or more separate blocks vertically.', 'marble') ?>
		</p>
		<p class="description fourth">
			<label for="<?php echo $this->get_field_id('horizontal_line') ?>">
				Pick a horizontal line<br/>
				<?php echo aq_field_select('horizontal_line', $block_id, $line_options, $horizontal_line, $block_id); ?>
			</label>
		</p>
		<div class="description fourth">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Height (optional)<br/>
				<?php echo aq_field_input('height', $block_id, $height, 'min', 'number') ?> px
			</label>
		</div>
		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		
		switch($horizontal_line) {
			case 'none':
				echo '<div class="clear"></div><div style="width:100%;height:'.$height.'px;"></div>';
				break;
			case 'single':
				echo '<div class="clear"></div><div style="width:100%;height:'.($height / 2).'px;"></div><hr /><div style="width:100%;height:'.($height / 2).'px;"></div>';
				break;
		}
		
		if($height) {
			echo '';
		}
		
	}
}