<?php
	/**
	 * Return if this is an AJAX request
	 */
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
		return false;
		
	$terms = get_the_terms( $post->ID , 'portfolio-category', 'string');
	
	/**
	 * Return if this post has no terms
	 */
	if(!( $terms ))
		return false;
		
	$term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
	
	$related_query = new WP_Query( array(
		  'post_type' => 'portfolio',
		  'tax_query' => array(
	            array(
	                'taxonomy' => 'portfolio-category',
	                'field' => 'id',
	                'terms' => $term_ids,
	                'operator'=> 'IN' //Or 'AND' or 'NOT IN'
	             )),
		  'posts_per_page' => 6,
		  'ignore_sticky_posts' => 1,
		  'orderby' => 'rand',
		  'post__not_in'=>array($post->ID)
		) 
	);
	
	if ( $related_query->have_posts() ) :
?>

<div class="divide40"></div>
<hr />
<div class="divide70"></div>
<h4 class="section-title"><?php _e('Related Projects', 'marble'); ?></h4>
<div class="showbiz-container posts">
  <div class="showbiz-navigation"> <a id="showbiz_left" class="sb-navigation-left btn"></a> <a id="showbiz_right" class="sb-navigation-right btn rm0"></a>
    <div class="sbclear"></div>
  </div>
  
  <div class="showbiz portfolio" data-left="#showbiz_left" data-right="#showbiz_right">
    <div class="overflowholder">
      <ul>
      
      <?php 
      	while ( $related_query->have_posts() ) : $related_query->the_post(); 
      	global $post;
      	
      	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
      ?>
      
        <li class="post">
          <div class="mediaholder">
            <div class="mediaholder_innerwrap overlay cap-icon enlarge">
            	<a href="<?php echo $url[0]; ?>" class="view" data-rel="lightbox" title="<?php the_title(); ?>">
            		<?php the_post_thumbnail('portfolio-index'); ?>
              		<div></div>
                </a>
            </div>
          </div>
          <div class="detailholder">
            <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div class="meta">
            	<?php 
            		echo ebor_the_simple_terms_links();
            		if( get_post_meta( $post->ID, '_cmb_the_client', true ))
            			echo ' / ' . __('Client: ','marble') . get_post_meta( $post->ID, '_cmb_the_client', true ); 
            	?>
            </div>
            <?php the_excerpt(); ?>
          </div>
        </li>
        
      <?php 
      	endwhile; 
      ?>

      </ul>
      <div class="clearfix"></div>
    </div>
    
    <div class="clearfix"></div>
  </div>
</div>
<div class="divide40"></div>
<hr />
<div class="divide10"></div>

<?php 
	endif;
	wp_reset_query();
?>

<script type="text/javascript">
	/*-----------------------------------------------------------------------------------*/
	/*	SHOWBIZ POSTS
	/*-----------------------------------------------------------------------------------*/
	jQuery(document).ready(function($) {
	  jQuery('.showbiz-container.posts').showbizpro({
	    dragAndScroll:"off",
	    visibleElementsArray:[3,3,3,1],
	    mediaMaxHeight:[0,0,0,0],
	    carousel:"off",
	    heightOffsetBottom:0,
	    rewindFromEnd:"off",
	    autoPlay:"off",
	    delay:2000,
	    speed:250
	  });
	});
</script>