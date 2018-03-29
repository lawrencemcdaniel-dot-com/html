<?php 
	get_header();
	  
	do_action('ebor_open_wrapper'); 
?>
	  
<div class="row blog">
  <div class="span12 posts">
  
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      
        <div <?php post_class(); ?>>
          
          <div class="row-fluid">
          
	          <div class="span4">
	          	<?php 
	          		if( has_post_thumbnail() ) :
				?>
				
	          			<figure class="overlay media-wrapper cap-icon more">
	          			
	          				<?php if( get_option('team_link','0') == 1 ) : ?>
	          					<a href="<?php the_permalink(); ?>">
	          				<?php endif; ?>
	          				
	          					<?php the_post_thumbnail('index-large'); ?>
	          					<div></div>
	          				
	          				<?php if( get_option('team_link','0') == 1 ) : ?>	
	          					</a>
	          				<?php endif; ?>
	          				
	          			</figure>
	          			
	          	<?php 
	          		endif;
	          	?>
	          </div>
	          
	          <div class="span8">
	          	<?php if( get_option('team_link','0') == 1 ) : ?>
	          		<h1 class="post-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	          	<?php else : ?>
	          		<h1 class="post-title entry-title"><?php the_title(); ?></h1>
	          	<?php endif; ?>
	          	
	          	<?php 
	          		echo '<span>'. get_post_meta( $post->ID, '_cmb_the_job_title', true ) .'</span><div class="divide20"></div>';
	          		the_content( get_option('blog_continue', 'Continue Reading &rarr;') ); 
	          	?>
	          </div>
          
          </div>
          
        </div>
        
        <div class="divide30"></div>
        <hr />
        <div class="divide40"></div><!--/post-->
          
        <?php 
        	endwhile; 
        	else: 
        ?>
          
          	<p><?php _e('Sorry, no posts matched your criteria.','marble'); ?></p>
          
        <?php 
        	endif;
        	echo function_exists('kriesi_pagination') ? kriesi_pagination() : posts_nav_link(); 
        ?>
    
  </div>
</div>
	
<?php 
	do_action('ebor_close_wrapper');
	  
	get_footer();