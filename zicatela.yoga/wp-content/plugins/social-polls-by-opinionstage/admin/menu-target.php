<?php
add_action('admin_footer', 'OpinionStage_addMenuTargetLink');

function OpinionStage_addMenuTargetLink(){ ?>
	<script type="text/javascript">			
		jQuery(document).ready(function(){
			jQuery("li.toplevel_page_opinionstage-getting-started ul li:nth-last-child(3) a,li.toplevel_page_opinionstage-settings ul li:nth-last-child(3) a").attr('target', '_blank');
			jQuery("li.toplevel_page_opinionstage-getting-started ul li:nth-last-child(2) a,li.toplevel_page_opinionstage-settings ul li:nth-last-child(2) a").attr('target', '_blank');
		});
	</script>
<?php 
}
?>