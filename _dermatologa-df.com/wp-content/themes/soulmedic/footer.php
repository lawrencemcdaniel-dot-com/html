            </div><!-- **Container - End** -->
         </div><!-- **Main - End** -->
    </div><!-- **Inner Wrapper - End** -->
</div><!-- **Wrapper - End** -->
     
<?php $dttheme_options = get_option(IAMD_THEME_SETTINGS);
$dttheme_general = $dttheme_options['general'];?>
<!-- **Footer** -->
<footer id="footer">
<?php if(!empty($dttheme_general['show-footer'])): ?>
		<div class="container"><?php dttheme_show_footer_widgetarea($dttheme_general['footer-columns']);?></div>
<?php endif; ?>

        <div class="container">
            <div class="copyright">
				<?php if( !empty($dttheme_general['show-copyrighttext']) ): 
							echo "<div class='copyright-content'>".dt_wp_kses( stripslashes($dttheme_general['copyright-text']) )."</div>";
					  endif;
					  
					  if( !empty( $dttheme_general['show-footer-logo']) ):
						$url = isset( $dttheme_general['footer-logo-url'] ) ?  $dttheme_general['footer-logo-url'] : "";
						$url = !empty( $url ) ? $url : IAMD_BASE_URL."images/footer-logo.png";
						$url = esc_url( $url );
						
						$retina_url = dttheme_option('general','retina-footer-logo-url');
						$retina_url = !empty($retina_url) ? $retina_url : IAMD_BASE_URL."images/footer-logo@2x.png";
						$retina_url = esc_url( $retina_url );
							  
						$width = dttheme_option('general','retina-footer-logo-width');
						$width = !empty($width) ? $width."px;" : "198px";
						$width = esc_attr( $width );
							  
						$height = dttheme_option('general','retina-footer-logo-height');
						$height = !empty($height) ? $height."px;" : "40px";
						$height = esc_attr( $height );?>
						
						<div class="footer-logo">
							<a href="<?php echo home_url();?>" title="<?php echo dttheme_blog_title();?>">
                                <img class="normal_logo" src="<?php echo $url;?>" alt="<?php esc_attr_e('Footer Logo','dt_themes');?>" title="<?php esc_attr_e('Footer Logo','dt_themes');?>">
                                <img class="retina_logo" src="<?php echo $retina_url;?>" alt="<?php echo dttheme_blog_title();?>"
                                	title="<?php echo dttheme_blog_title(); ?>" style="width:<?php echo $width;?>; height:<?php echo $height;?>;"/>
							</a>    
						</div><?php
					  endif;?>
			</div>
		</div>
</footer><!-- **Footer - End** -->
<?php	if (is_singular() AND comments_open())
			wp_enqueue_script( 'comment-reply');

		if(dttheme_option('integration', 'enable-body-code') != ''):
			echo '<script type="text/javascript">';
			echo  dt_wp_kses( stripslashes(dttheme_option('integration', 'body-code')) );
			echo '</script>';
		endif; 
		wp_footer(); ?>
</body>
</html>