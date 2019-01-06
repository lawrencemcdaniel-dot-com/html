<?php

	class AQ_Skills_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Skill Bars',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AQ_Skills_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_skill_add_new', array($this, 'add_skill'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'tabs' => array(
					1 => array(
						'title' => 'Skill Bar',
						'content' => '90%',
					)
				),
				'responsive_first' => 0,
				'text' => '',
				'alignment' => 'left'
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$tab_types = array(
				'tab' => 'Tabs',
				'side-tab' => 'Side Tabs',
				'toggle' => 'Toggles'
			);
			
			$align_types = array(
				'left' => 'Left',
				'centered' => 'Centered',
			);
			
			?>
			<p class="description note">
				<?php _e('Use this block to add skill bars to the page.', 'marble') ?>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Block Title (optional)
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('text') ?>">
					Content Above Tabs (optional)
					<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('alignment') ?>">
					Block Title & Content Above Tabs Alignment<br/>
					<?php echo aq_field_select('alignment', $block_id, $align_types, $alignment) ?>
				</label>
			</p>
			
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
					$count = 1;
					foreach($tabs as $tab) {	
						$this->tab($tab, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="skill" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
			<?php
		}
		
		function tab($tab = array(), $count = 0) {
				
			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $tab['title'] ?></strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							Skill Bar Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							Skill ability in % e.g; 90%<br/>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" rows="1"><?php echo $tab['content'] ?></textarea>
						</label>
					</p>
					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			$output = '';
			
			if($text || $title){
				if( $alignment == 'left' ){
					$output .= '<div>';
				} else {
					$output .= '<div class="text-center">';
				}
				if($title) $output .= '<h3 class="section-title">' . do_shortcode($title) . '</h3>';
				if($text) $output .= wpautop(do_shortcode($text));
				
				$output .= '</div><div class="divide10"></div>';
			}

			$output .= '<ul class="progress-list">';
			
			foreach($tabs as $tab){
				$output .= '<li>
			      <p>'.$tab['title'].' <em>'.$tab['content'].'</em></p>
			      <div class="progress plain">
			        <div class="bar" style="width: '.$tab['content'].';"></div>
			      </div>
			    </li>';
			}
			    
			$output .= '</ul>';
			
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_skill() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$tab = array(
				'title' => 'New Skill Bar',
				'content' => '90%'
			);
			
			if($count) {
				$this->tab($tab, $count);
			} else {
				die(-1);
			}
			
			die();
		}
		
		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}
	}