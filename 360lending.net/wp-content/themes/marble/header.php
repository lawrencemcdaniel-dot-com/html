<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="body-wrapper">
	
	  <div id="header" class="navbar navbar-fixed-top header-style <?php echo get_option('header_layout','default'); ?>">
	  
	  <?php
		  	if( get_option('header_layout','default') == 'icons' )
		  		get_template_part('content/header','icons');
		  		
		  	if( get_option('header_layout','default') == 'baricons' )
		  		get_template_part('content/header','baricons');
		  		
		  	do_action('icl_language_selector'); 
	  ?>
	  
	    <div class="navbar-inner">
	      <div class="container relative">
	      
		      <a class="btn responsive-menu pull-right" data-toggle="collapse" data-target=".nav-collapse"><i class='icon-menu-1'></i></a> 
		      
		      <a class="brand" href="<?php echo home_url(); ?>">
		      	<?php if( get_option('custom_logo') ) : ?>
		      		<img src="<?php echo get_option('custom_logo'); ?>" alt="<?php echo get_option('custom_logo_alt_text'); ?>" class="retina" />
		      	<?php else : ?>
		      		<?php echo bloginfo('title'); ?>
		      	<?php endif; ?>
		      </a>
		      
		      <div class="nav-collapse pull-right collapse">
		         <?php	
		         	if ( has_nav_menu( 'single' ) && is_page_template('page_onepage_home.php') ) { 
     					$args = array(
     						'theme_location' => 'single',
     						'container'	 => false,
     						'menu_id' => 'main_menu',
     						'menu_class'	 => 'nav',
     						'walker'	 => new Bootstrap_Walker_Nav_Menu()
     					);
     	
     					wp_nav_menu($args);
     				} elseif ( has_nav_menu( 'primary' ) ) { 
		  				$args = array(
		  					'theme_location' => 'primary',
		  					'container'	 => false,
		  					'menu_id' => 'main_menu',
		  					'menu_class'	 => 'nav',
		  					'walker'	 => new Bootstrap_Walker_Nav_Menu()
		  				);
		  
		  				wp_nav_menu($args);
		  			} 
		  		?>
		       </div>
	       
	        <div id="marker"></div>
			</div>
		</div>
	</div>

<div class="offset"></div>