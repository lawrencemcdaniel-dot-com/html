<?php
/** A simple text block **/
class AQ_Ebor_Text_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text',
			'size' => 'span6',
			//'resizable' => 0,
		);
		
		//create the block
		parent::__construct('aq_ebor_text_block', $block_options);
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
			<?php _e('Use this block to add columns of text to your page. Grab the edge of the block to resize to your needs.', 'marble') ?>
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
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('icon') ?>">
				Icon (optional) e.g icon-lamp <small>Full list of icons available <a href="http://www.madeinebor.com/marble/font-icons/">here</a></small>
				<?php echo aq_field_input('icon', $block_id, $icon, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('centered') ?>">
				<?php _e('Center Text?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('centered', $block_id, $centered) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('code_display') ?>">
				<?php _e('Display as preformatted code?', 'marble'); ?><br/>
				<?php echo aq_field_checkbox('code_display', $block_id, $code_display) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('wpautop') ?>">
				Disable Auto Paragraphs? <code>wpautop</code><br/>
				<?php echo aq_field_checkbox('wpautop', $block_id, $wpautop) ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		if($centered == 1){ $center = ' centered '; } else { $center = ''; }
		switch($code_display) {
			case '0':
					if($icon){
						echo '<div class="media"><i class="'.$icon.' large pull-left"></i><div class="media-body">';
						if($title) echo '<h4>'.strip_tags($title).'</h4>';
						echo ($wpautop) ? do_shortcode(htmlspecialchars_decode($text)) : wpautop(do_shortcode(htmlspecialchars_decode($text)));
						echo '</div></div>';
					} else {
						echo '<div class="' . $center . '"><div class="divide10"></div>';
						if($title) echo '<h3 class="section-title">'.strip_tags($title).'</h3>';
						if($subtitle) echo '<p class="lead">'.do_shortcode(htmlspecialchars_decode($subtitle)).'</p><div class="divide20"></div>';
						echo ($wpautop) ? do_shortcode(htmlspecialchars_decode($text)) : wpautop(do_shortcode(htmlspecialchars_decode($text)));
						echo '</div>';
					}
				break;
			case '1':
					echo '<div class="divide10"></div>';
					if($title) echo '<h4 class="section-title">'.strip_tags($title).'</h4>';
					if($subtitle) echo '<p class="lead">'.do_shortcode(htmlspecialchars_decode($subtitle)).'</p><div class="divide20"></div>';
					echo '<pre class="prettyprint linenums">';
					echo $text;
					echo '</pre>';
				break;
		}
	}
	
}