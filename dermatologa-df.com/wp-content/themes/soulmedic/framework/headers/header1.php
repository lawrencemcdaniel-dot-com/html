    <div id="bbar-wrapper">
    	<div id="bbar-body">
        	<div class="container">
            	<div class="column dt-sc-one-half first"><?php
					if (function_exists('wp_nav_menu')) :
						$topMenu = wp_nav_menu(array('theme_location'=>'top_menu','menu_id'=>'','menu_class'=>'top-menu','container'=>false, 'depth' => 1, 'fallback_cb'=>'dttheme_default_navigation'));
                    endif;
                    if(!empty($topMenu))	//echo $topMenu;?></div>
                <div class="column dt-sc-one-half alignright"><?php
					$top_msg = stripslashes(dttheme_option('general','top-message'));
					echo do_shortcode($top_msg);
				?></div>
            </div>
        </div>
    </div>