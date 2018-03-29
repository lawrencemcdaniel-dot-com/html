<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.','dt_themes'); ?></p>
<?php  return;
	endif;?>
    
    <h3> <?php comments_number(__('No Comments','dt_themes'), __('Comment ( 1 )','dt_themes'), __('Comments ( % )','dt_themes') );?></h3>    
    <?php if ( have_comments() ) : ?>
    
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments','dt_themes'  ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments','dt_themes') ); ?></div>
                    </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
        <ul class="commentlist">
     		<?php wp_list_comments( array( 'callback' => 'dttheme_custom_comments' ) ); ?>
        </ul>
    
    <?php else: ?>
		<?php if ( ! comments_open() ) : ?>
            <p class="nocomments"><?php _e( 'Comments are closed.','dt_themes'); ?></p>
        <?php endif;?>    
    <?php endif; ?>
	
    <!-- Comment Form -->
    <?php if ('open' == $post->comment_status) : ?>
			<?php $comments_args = array(
					'title_reply' => __( 'Post a Comment ','dt_themes' ),
					'fields'=>array(
						'author'	=>	'<p class="column dt-sc-one-half first"><label>'.__('Your Name','dt_themes').'<span> (required) </span></label>
										 <input id="author" name="author" type="text" required /></p>',
										 
						'email'		=>	'<p class="column dt-sc-one-half"><label>'.__('Your Email','dt_themes').' <span> (required) </span> </label>
										 <input id="email" name="email" type="text" required /></p>',
						'url'		=>	'<p class="one-column clear"> <label>'.__('Website','dt_themes').'</label> <input id="url" name="url" type="text" /></p>'),
						
						'comment_field'=>'<p class="clear"><label>'.__('Your Message','dt_themes').'</label>
										 <textarea id="comment" name="comment" cols="5" rows="3"></textarea></p>',
						'comment_notes_before'=>'','comment_notes_after'=>'','label_submit'=>__('Comment','dt_themes'));		
            comment_form($comments_args);?>
	<?php endif; ?>