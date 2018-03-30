<?php

	class AQ_Ebor_Tabs_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Tabs Testimonials',
				'size' => 'span6',
			);
			
			//create the widget
			parent::__construct('AQ_Ebor_Tabs_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_tab_add_new', array($this, 'add_tab'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'tabs' => array(
					1 => array(
						'title' => 'My New Tab',
						'content' => 'My tab contents',
					)
				),
				'type'	=> 'tab',
				'text' => ''
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			$tab_types = array(
				'tab' => 'Tabs',
				'toggle' => 'Toggles',
				'testimonial' => 'Testimonial'
			);

			?>
			<p class="description note">
				<?php _e('Use this block to add tabs and accordions to the page.', 'marble') ?>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Block Title (optional)
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('text') ?>">
					Content above tabs (optional)
					<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
				</label>
			</p>
			
			<p class="description">
				<label for="<?php echo $this->get_field_id('type') ?>">
					Tabs style<br/>
					<?php echo aq_field_select('type', $block_id, $tab_types, $type) ?>
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
				<a href="#" rel="tab" class="aq-sortable-add-new button">Add New</a>
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
							Tab Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							Tab Content<br/>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="textarea-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]" rows="5"><?php echo $tab['content'] ?></textarea>
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


				$output .= '<div>';
				
				if($title) $output .= '<h3 class="section-title">' . do_shortcode(htmlspecialchars_decode($title)) . '</h3>';
				if($text) $output .= '<p>' . do_shortcode(htmlspecialchars_decode($text)) . '</p>';
				
				$output .= '</div><div class="divide10"></div>';
			}
			
			if($type == 'tab') {
				$rand = wp_rand(0,10000);
				$output .= '<ul id="myTab" class="nav nav-tabs bm0">';
				    				
    				$i = 0;
  					foreach( $tabs as $unique => $tab ){
  						$i++;
  						if($i==1){
  							$output .= '<li class="active"><a href="#tab-'.$rand.'-' . $unique . '" data-toggle="tab">' . $tab['title'] . '</a></li>';
  						} else {
  							$output .= '<li><a href="#tab-'.$rand.'-' . $unique . '" data-toggle="tab">' . $tab['title'] . '</a></li>';
  						}
  					}

				$output .= '</ul><div id="myTabContent" class="tab-content box">';
					
					$i = 0;
					foreach( $tabs as $unique => $tab ){
						$i++;
						if($i==1){
				       		 $output .= '<div class="tab-pane fade in active" id="tab-'.$rand.'-' . $unique . '">'. wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))) .'</div>';
				       	} else {
				       		$output .= '<div class="tab-pane fade" id="tab-'.$rand.'-' . $unique . '">'. wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))) .'</div>';
				       	}
				    }

				$output .= '</div>';
				
			} elseif ($type == 'toggle') {
				$rand = wp_rand(0,10000);
				$output .= '<div class="accordion" id="accordion-'.$rand.'">';
				  	
				  	$i=0;
				  	foreach( $tabs as $unique => $tab ){
				  		if( $i == 0 ){$in = 'in'; $active = 'active';}else{$in = ''; $active = '';}
					    $output .= '<div class="accordion-group">
					      <div class="accordion-heading">
					      	<a class="accordion-toggle '.$active.'" data-toggle="collapse" data-parent="#accordion-'.$rand.'" href="#collapse-'.$rand.'-' . $unique . '">' . $tab['title'] . '</a>
					      </div>
					      <div id="collapse-'.$rand.'-' . $unique . '" class="accordion-body collapse ' . $in . '">
					        <div class="accordion-inner">'. wpautop(do_shortcode(htmlspecialchars_decode($tab['content']))) .'</div>
					      </div>
					    </div>';
					 $i++;
				    }
				    
				$output .= '</div>';
				
			} elseif( $type == 'testimonial' ) {
				
				$rand = wp_rand(0,10000);
				$output .= '<div id="testimonials" class="tab-container '.$rand.'"><div class="panel-container">';
				foreach( $tabs as $index => $tab ){
				    $output .= '<div id="tst'.$index.$rand.'">'.$tab['content'].'<span class="author">'.$tab['title'].'</span></div>';
				}
				$output .= '</div><ul class="etabs">';
				foreach( $tabs as $index => $tab ){
				    $output .= '<li class="tab"><a href="#tst'.$index.$rand.'">1</a></li>';
				}
				$output .= '</ul></div>';
				$output .= '<script type="text/javascript">
				jQuery(document).ready( function($) {
				      jQuery("#testimonials.'.$rand.'").easytabs({
					      animationSpeed: 500,
					      updateHash: false,
					      cycle: 5000
				      });
				});</script>';
				
			}
			echo $output;
			
		}
		
		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the tab
			$tab = array(
				'title' => 'New Tab',
				'content' => ''
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
