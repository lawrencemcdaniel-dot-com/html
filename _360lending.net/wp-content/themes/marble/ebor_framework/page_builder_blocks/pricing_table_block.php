<?php

	class AQ_Pricing_Table_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Pricing Table',
				'size' => 'span3',
			);
			
			//create the block
			parent::__construct('aq_pricing_table_block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_table_add_new', array($this, 'add_table'));
		}
		
		function form($instance) {
			
			$defaults = array(
				'tabs' => array(
					1 => array(
						'title' => __('Table Detail','marble')
					)
				),
				'currency' => '$',
				'price' => '3',
				'button_link' => 'http://',
				'button_text' => 'Button'
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<p class="description note">
				<?php _e('Use this block to add pricing tables to your page.', 'marble') ?>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title for this Table', 'marble'); ?>
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('currency') ?>">
					<?php _e('Currency', 'marble'); ?>
					<?php echo aq_field_input('currency', $block_id, $currency, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('price') ?>">
					<?php _e('Price', 'marble'); ?>
					<?php echo aq_field_input('price', $block_id, $price, $size = 'full') ?>
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
					<a href="#" rel="table" class="aq-sortable-add-new button"><?php _e('Add New', 'marble'); ?></a>
					<p></p>
				</div>
				
			<p class="description">
				<label for="<?php echo $this->get_field_id('button_link') ?>">
					<?php _e('Button Link', 'marble'); ?>
					<?php echo aq_field_input('button_link', $block_id, $button_link, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('button_text') ?>">
					<?php _e('Button Text', 'marble'); ?>
					<?php echo aq_field_input('button_text', $block_id, $button_text, $size = 'full') ?>
				</label>
			</p>
			
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
							<a href="#"><?php _e('Open / Close', 'marble'); ?></a>
						</div>
					</div>
					
					<div class="sortable-body">
						<p class="tab-desc description">
						
							<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							<?php _e("Features","marble"); ?>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]"><?php echo $tab['title'] ?></textarea>
							</label>
							
						</p>
						<p class="tab-desc description"><a href="#" class="sortable-delete"><?php _e('Delete','marble'); ?></a></p>
					</div>
					
				</li>
				<?php
			}
		
		function block($instance) {
			extract($instance);
			
			echo '<div class="pricing plan">
			  <h3>' . $title . '</h3>
			  <h4><span class="amount"><span>' . htmlspecialchars_decode($currency) . '</span>' . htmlspecialchars_decode($price) . '</span></h4>
			  <div class="features"><ul>';
			
			foreach($tabs as $tab){
			   echo '<li>' . htmlspecialchars_decode( $tab['title'] ) . '</li>';
			}
			
			echo '</ul>
			  </div>
			  <div class="select">
			    <div> <a href="'.esc_url($button_link).'" class="btn inverse">'. htmlspecialchars_decode($button_text) .'</a> </div>
			  </div>
			</div>';

		}
		
		/* AJAX add tab */
		function add_table() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$tab = array(
				'title' => __('Table Detail','marble')
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