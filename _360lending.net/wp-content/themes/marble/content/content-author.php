<?php
	$authorID = get_the_author_meta('ID');
	
	$authors_posts = get_posts( 
		array( 
		 'author' => $authorID, 
		 'numberposts' => 5,
		 'orderby' => 'date'      
		) 
	);
?>

<hr />

<div class="about-author">

	<ul id="myTab" class="nav nav-tabs bm0">  				
		<li class="active"><a href="#about-author" data-toggle="tab"><?php _e('About Author','marble'); ?></a></li>
		<li><a href="#recent-posts" data-toggle="tab"><?php _e('Recent Posts','marble'); ?></a></li>
	</ul>
	
	<div id="myTabContent" class="tab-content box">
	
		<div class="tab-pane fade in active" id="about-author">
			
			<div class="author-image">
			    <?php echo get_avatar( get_the_author_meta('email'), 120 ); ?>
			</div>
			
			<div class="author-details">
				<h3><?php echo get_option('author_details_title','About the author'); ?></h3>
				<?php 
					printf(wpautop( '<span class="vcard author"><span class="fn">%s</span></span>: %s' ), get_the_author(), get_the_author_meta('description')); 
					get_template_part('loop/loop', 'social');	
				?>
			</div>
			<div class="clear"></div>
			
		</div>
		
		<div class="tab-pane fade in" id="recent-posts">
			
			<div class="meta">
				<ol>
					<?php 
						foreach($authors_posts as $post) :
						setup_postdata( $post );
					?>
					
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> / <a href="<?php comments_link(); ?>"><?php comments_number( __('0 Comments','marble'), __('1 Comment','marble'), __('% Comments','marble') ); ?></a></li>
						
					<?php
						endforeach;
						wp_reset_postdata();
					?>
				</ol>
			</div>
			
		</div>
		
	</div>
    
</div>