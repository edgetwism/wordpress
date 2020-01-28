<?php
/* Slider Section */
if( !function_exists('hotel_paradise_slider') ):
	function hotel_paradise_slider(){
		hotel_paradise_load_section('slider');
	}
endif;
if ( function_exists( 'hotel_paradise_slider' ) ) {
	$section_priority = apply_filters( 'hotel_paradise_section_priority', 1, 'hotel_paradise_slider' );
	add_action( 'hotel_paradise_sections', 'hotel_paradise_slider', absint( $section_priority ) );
}

/* Service Section */
if( !function_exists('hotel_paradise_service') ):
	function hotel_paradise_service(){
		hotel_paradise_load_section('service');
	}
endif;
if ( function_exists( 'hotel_paradise_service' ) ) {
	$section_priority = apply_filters( 'hotel_paradise_section_priority', 2, 'hotel_paradise_service' );
	add_action( 'hotel_paradise_sections', 'hotel_paradise_service', absint( $section_priority ) );
}

/* Room Section */
if( !function_exists('hotel_paradise_room') ):
	function hotel_paradise_room(){
		hotel_paradise_load_section('room');
	}
endif;
if ( function_exists( 'hotel_paradise_room' ) ) {
	$section_priority = apply_filters( 'hotel_paradise_section_priority', 3, 'hotel_paradise_room' );
	add_action( 'hotel_paradise_sections', 'hotel_paradise_room', absint( $section_priority ) );
}

/* Blog Section */
if( !function_exists('hotel_paradise_blog') ):
	function hotel_paradise_blog(){
		hotel_paradise_load_section('blog');
	}
endif;
if ( function_exists( 'hotel_paradise_blog' ) ) {
	$section_priority = apply_filters( 'hotel_paradise_section_priority', 4, 'hotel_paradise_blog' );
	add_action( 'hotel_paradise_sections', 'hotel_paradise_blog', absint( $section_priority ) );
}

/* Contact Section */
if( !function_exists('hotel_paradise_contact') ):
	function hotel_paradise_contact(){
		hotel_paradise_load_section('contact');
	}
endif;
if ( function_exists( 'hotel_paradise_contact' ) ) {
	$section_priority = apply_filters( 'hotel_paradise_section_priority', 5, 'hotel_paradise_contact' );
	add_action( 'hotel_paradise_sections', 'hotel_paradise_contact', absint( $section_priority ) );
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function hotel_paradise_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}