<?php /*Template Name: DT Events Template*/
get_header();?>
<?php 
	  $page_layout 	= dttheme_option('specialty','archives-layout');
  	  $page_layout 	= !empty($page_layout) ? $page_layout : "content-full-width";
	 
  	  $show_sidebar = false;
	  $sidebar_class= "";
	  
	  switch($page_layout):
		case 'with-left-sidebar':
			$page_layout 	=	"page-with-sidebar with-left-sidebar";
			$show_sidebar 	= 	true;
			$sidebar_class 	=	"left-sidebar";
		break;
		
		case 'with-right-sidebar':
			$show_sidebar 	= 	true;
			$page_layout 	=	"page-with-sidebar with-right-sidebar";
		break;
	  endswitch;?>
      
      <!-- **Primary Section** -->
      <section id="primary" class="<?php echo esc_attr( $page_layout );?>">
<?php	if( have_posts() ):
			while( have_posts() ):
				the_post();
				get_template_part( 'framework/loops/content', 'event' );
			endwhile;
		endif;?>     
      </section><!-- **Primary Section** -->
        
<?php if($show_sidebar): ?>
	  <!-- **Secondary Section ** -->
      <section id="secondary" class="<?php echo esc_attr( $sidebar_class ); ?>">
<?php 	get_sidebar();?>      
      </section><!-- **Secondary Section - End** -->
<?php endif; ?>

<?php get_footer();?>