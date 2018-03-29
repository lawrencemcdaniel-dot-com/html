<?php
$category_slug = get_post_meta(get_the_ID(), '_doodle_portfolio_category_slug', true);
$category_id = 0;
if ( !empty($category_slug) ) {
  $category_slug = sanitize_title_with_dashes($category_slug);
  $category = get_term_by( 'slug', $category_slug, 'portfolio_category' );
  if ( is_object($category) ) {
    $category_id = $category->term_id;
  } 
  if ( empty($category_id) ) { $category_id = 0; }
}

/* PORTFOLIO CATEGORY FILTERS */
$terms = get_terms( 'portfolio_category', array('child_of'=>$category_id) );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
  echo '<ul class="shuffle-btns">';

  echo '<li class="active"><a href="#" data-group="shuffle-all">All</a></li>';

  foreach ( $terms as $term ) {
    echo '<li><a href="'.get_term_link($term->slug, 'portfolio_category').'" data-group="'.$term->slug.'">' . $term->name . '</a></li>';
  }
  echo '</ul>';
}
?>

<script type="text/javascript">
jQuery(function($){
  $(window).load(function() {
          
    $("#portfolio-grid .grid-item").matchHeight({
      byRow: false,
      property: 'height',
      target: null,
      remove: false
    });

    var $shufflegrid = $('#portfolio-grid');

    $shufflegrid.shuffle({
      itemSelector: '.grid-item'
    });

    $('.shuffle-btns li a').click(function (e) {
      e.preventDefault();

      $('.shuffle-btns li').removeClass('active').addClass('inactive');
      $(this).parent().addClass('active').removeClass('inactive');
      var groupName = $(this).attr('data-group');

      $shufflegrid.shuffle('shuffle', groupName );
    });

  });
});
</script>
