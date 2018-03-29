<?php
/**
 * The template for displaying search forms.
 *
 * @package doodle
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'doodle' ) ?></span>
	<div class="input-group">
	<input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'doodle' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'doodle' ) ?>" />
	<span class="input-group-btn">
		<button type="submit" class="search-submit btn btn-large"><i class="icon-search"></i></button>
	</span>
	</div>
</form>
