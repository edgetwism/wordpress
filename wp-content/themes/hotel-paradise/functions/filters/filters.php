<?php 
function hotel_paradise_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'hotel_paradise_pingback_header' );

function hotel_paradise_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<hr><p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		sprintf( __( 'Continue reading', 'hotel-paradise' ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'hotel_paradise_excerpt_more' );

function hotel_paradise_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'hotel_paradise_front_page_template' );