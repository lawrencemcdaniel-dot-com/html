<?php get_header();?>
<!-- **Primary Section** -->
<section id="primary" class="content-full-width">
<?php	if( have_posts() ):
			while( have_posts() ):
				the_post();
				get_template_part( 'framework/loops/content');
			endwhile;
		endif;?>
       <!-- **Pagination** -->
       <div class="pagination">
            <div class="prev-post"><?php previous_posts_link('<span class="fa fa-angle-double-left"></span> Prev');?></div>
            <?php echo dttheme_pagination();?>
            <div class="next-post"><?php next_posts_link('Next <span class="fa fa-angle-double-right"></span>');?></div>
       </div><!-- **Pagination - End** -->
</section><!-- **Primary Section** -->
<?php get_footer();?>