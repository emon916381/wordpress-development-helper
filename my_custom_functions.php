<?php

/**
 * ALL Time Formate
 * 
 */
function eft_data_and_time() { 
    $post_date = get_the_time('U');
    $delta = time() - $post_date;
    if ( $delta < 60 ) {
        echo 'Just Now';
    }
    elseif ($delta > 60 && $delta < 120){
        echo '1 minute ago';
    }
    elseif ($delta > 120 && $delta < (60*60)){
        echo strval(round(($delta/60),0)), ' minutes ago';
    }
    elseif ($delta > (60*60) && $delta < (120*60)){
        echo '1 hour ago';
    }
    elseif ($delta > (120*60) && $delta < (24*60*60)){
        echo strval(round(($delta/3600),0)), ' hours ago';
    }
    else {
        echo the_time('j\<\s\u\p\>S\<\/\s\u\p\> M y g:i a');
    }}


/**
 * Page Navigation
 */
// Numeric Page Navi
/**
 * @param WP_Query|null $wp_query
 * @param bool $echo
 *
 * @return string
 * Accepts a WP_Query instance to build pagination (for custom wp_query()), 
 * or nothing to use the current global $wp_query (eg: taxonomy term page)
 * - Tested on WP 5.3
 * - Tested with Bootstrap 4.4
 * - Tested on Sage 9.0.9
 *
 * USAGE:
 *     <?php echo bootstrap_pagination(); ?> //uses global $wp_query
 * or with custom WP_Query():
 *     <?php 
 *      $query = new \WP_Query($args);
 *       ... while(have_posts()), $query->posts stuff ...
 *       echo bootstrap_pagination($query);
 *     ?>
 */
function bootstrap_pagination( \WP_Query $wp_query = null, $echo = true ) {
	if ( null === $wp_query ) {
		global $wp_query;
	}
	$pages = paginate_links( [
			'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			'format'       => '?paged=%#%',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'type'         => 'array',
			'show_all'     => false,
			'end_size'     => 3,
			'mid_size'     => 1,
			'prev_next'    => true,
			'prev_text'    => __( '« Prev' ),
			'next_text'    => __( 'Next »' ),
			'add_args'     => false,
			'add_fragment' => ''
		]
	);
	if ( is_array( $pages ) ) {
		//$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
		$pagination = '<div class="pagination"><ul class="pagination">';
		foreach ($pages as $page) {
                        $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
                }
		$pagination .= '</ul></div>';
		if ( $echo ) {
			echo $pagination;
		} else {
			return $pagination;
		}
	}
	return null;
}






