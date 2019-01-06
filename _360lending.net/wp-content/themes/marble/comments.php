<?php 
	$custom_comment_form = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
	    'author' => '<div class="name-field">
	    			 <input type="text" id="author" name="author" placeholder="' . __('Name *','marble') . '" value="' . esc_attr( $commenter['comment_author'] ) . '" />
	    			 </div>',
	    'email'  => '<div class="email-field">
	    			 <input name="email" type="text" id="email" placeholder="' . __('Email *','marble') . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />
	    			 </div>',
	    'url'    => '<div class="website-field">
	    			 <input name="url" type="text" id="url" placeholder="' . __('Website','marble') . '" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" />
	    			 </div>') ),
	  	'comment_field' => '<div class="message-field">
	  						<textarea name="comment" placeholder="' . __('Enter your comment here...','marble') . '" id="comment" aria-required="true"></textarea>
	  						</div>',
	  	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','marble' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
	  	'cancel_reply_link' => __( 'Cancel' , 'marble' ),
	  	'comment_notes_before' => '',
	  	'comment_notes_after' => '',
	  	'label_submit' => __( 'Submit' , 'marble' )
	  );

	if( is_active_sidebar('primary') && get_post_meta( $post->ID, '_cmb_disable_sidebar', true ) !=='on' && get_post_type() == 'post' ) : 
?>

	<div id="comments">
	  <div class="divide60"></div>
	  <h3 class="section-title"><?php comments_number( __('0 Comments','marble'), __('1 Comment','marble'), __('% Comments','marble') ); ?></h3>
	  
	  <?php if( have_comments() ) : ?>
	  	  <ol id="singlecomments" class="commentlist">
	  	  		<?php wp_list_comments('type=comment&callback=custom_comment'); ?>
	  	  </ol>
	  <?php endif; ?>
	  <?php paginate_comments_links(); ?>
	  <div class="divide40"></div>
	</div>
	
	<?php if( have_comments() ) echo '<hr /><div class="divide60"></div>'; ?>

	<div id="respond" class="comment-form-wrapper">
	  <h3 class="section-title"><?php echo get_option('comments_title','Would you like to share your thoughts?'); ?></h3>
	  <p><?php echo get_option('comments_subtitle', 'Your email address will not be published. Required fields are marked *'); ?></p>
	  
	  <?php comment_form($custom_comment_form); ?>
	    
	</div>

<?php 
	else : 
?>

	<div id="comments">
	  <div class="divide30"></div>
	  <h3 class="section-title"><?php comments_number( __('0 Comments','marble'), __('1 Comment','marble'), __('% Comments','marble') ); ?></h3>
	  
	  <?php if( have_comments() ) : ?>
	  	  <ol id="singlecomments" class="commentlist">
	  	  		<?php wp_list_comments('type=comment&callback=custom_comment'); ?>
	  	  </ol>
	  <?php endif; ?>
	  <?php paginate_comments_links(); ?>
	
	</div>

	</div></div>
	<div class="dark-wrapper">
	  <div class="container inner">
	  
	    <div id="respond" class="comment-form-wrapper">
	      <h3 class="section-title"><?php echo get_option('comments_title','Would you like to share your thoughts?'); ?></h3>
	      <p><?php echo get_option('comments_subtitle', 'Your email address will not be published. Required fields are marked *'); ?></p>
	      
	      <?php comment_form($custom_comment_form); ?>
	        
	    </div>
	  </div>
	</div>

<?php 
	endif; 