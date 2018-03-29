<?php

	global $prof_default;

?>
 
 
	<footer class="text-center">
		<!-- Footer Text -->
		<div>More about me: 
		<a class="footer-links" href="https://mx.linkedin.com/in/lawrencemcdaniel" target="_blank">LinkedIn</a> | 
		<a class="footer-links" href="https://angel.co/lpm0073-gmail-com" target="_blank">Angel Network</a> | 
		<a class="footer-links" href="https://github.com/lpm0073" target="_blank">GitHub</a> | 
		<a class="footer-links" href="https://www.codementor.io/lawrencemcdaniel" target="_blank">CodeMentor.io</a> | 
		<a class="footer-links" href="https://www.facebook.com/lawrence.p.mcdaniel" target="_blank">Facebook</a> | 
		<a class="footer-links" href="http://edmex.org" target="_blank">edMex.org</a> | 
		<a class="footer-links" href="http://m-arca.org" target="_blank">M-Arca Foundation</a> | 
		<a class="footer-links" href="https://myopportunity.com/profile/lawrence-mcdaniel/sl" target="_blank">Opportunity.com</a> | 
		<a class="footer-links" href="https://www.upwork.com/freelancers/~01e2b72f91af0ebbd1" target="_blank">Upwork</a> | 
		<a class="footer-links" href="https://www.zintro.com/profile/lawrence-mcdaniel1" target="_blank">Zintro</a> | 
		<a class="footer-links" href="https://www.expertconnect.net/consultant/MyProfile/256640" target="_blank">ExpertConnect</a>
		</div>
				<!-- Footer Logo
				================================================== -->
				<?php if(of_get_option('select_footer_logo',$prof_default) == 'On') { ?>
					<?php 
						if(of_get_option('select_footer_newtab',$prof_default) == 'On') {
							$target = 'target="_blank"';
						} else {
							$target = '';
						}
					?>
					<a <?php echo $target; ?> href="<?php echo esc_url(of_get_option('footer_logo_url',$prof_default)); ?>">
						<img class="footer-logo" src="<?php echo of_get_option('footer_logo',$prof_default); ?>" alt="footer logo">
					</a>
				<?php } ?>	
			
			
			
				<!-- Footer Copyrights Section
				================================================== -->				
				<?php if(of_get_option('select_copyrights_columns',$prof_default) == 'On') { ?>
					<?php
						$allowed_html = array(
							'a' => array(
								'href' => array(),
								'title' => array()
							),
							'br' => array(),
							'strong' => array(),
						);
						
						$footerText = wp_kses(of_get_option('footer_text',$prof_default), $allowed_html);
					?>
					<div class="identity-copyrights"><?php echo esc_attr($footerText); ?></div>
				<?php } ?>			
				
			</div>
		<!-- End Footer Text -->
	</footer>
 
	<?php if(of_get_option('select_backtotop',$prof_default) == 'On') { ?> 
		<a id="back-top" href="#" style="display: none;"><i class="fa fa-angle-up fa-2x"></i></a>
	<?php } ?>
	
	
	<!-- Footer End
	================================================== -->		

<?php wp_footer(); ?>
</body>
</html>

