<?php 
	( is_single() ) ? $meta_location = 'single_' : $meta_location = 'index_'; 

	if(!( get_option($meta_location . 'date', '1') == 0 && get_option($meta_location . 'comments', '1') == 0 && get_option($meta_location . 'likes', '1') == 0 )) : 
?>

  <div class="meta">
  	<?php edit_post_link(__('Edit','marble')); ?>
  	<?php if( get_option($meta_location . 'date', '1') == 1 ) : ?>
  		<span class="date updated"><?php the_time(get_option('date_format')); ?></span> 
  	<?php endif; ?>
  	<?php if( get_option($meta_location . 'categories', '1') == 1 && has_category() ) : ?>
  		<span class="sep">/</span> <span class="categories"><?php the_category(', '); ?></span> 
  	<?php endif; ?>
  	<?php if( get_option($meta_location . 'comments', '1') == 1 && comments_open() ) : ?>
  		<span class="sep">/</span> <span class="comments"><a href="<?php comments_link(); ?>">
  			<?php comments_number( __('0 Comments','marble'), __('1 Comment','marble'), __('% Comments','marble') ); ?>
  		</a></span> 
  	<?php endif; ?>
  	<?php if( get_option($meta_location . 'likes', '1') == 1 && function_exists('zilla_likes') ) : ?>
  		<span class="sep"> / </span> <span class="likes"><?php zilla_likes(); ?></span> 
  	<?php endif; ?>
  </div>
  
<?php 
	endif;