<?php 
/*
 * Template Name: Home Page
 */
get_header();
	
	/**
	 * Hotel Paradise Sections hook.
	 *
	 * @hooked hotel_paradise_slider_section - 1
	 * @hooked hotel_paradise_service_section - 2
	 * @hooked hotel_paradise_room_section - 3
	 * @hooked hotel_paradise_blog_section - 4
	 * @hooked hotel_paradise_contact_section - 5	 
	 */
	do_action( 'hotel_paradise_sections', false );
	
get_footer();
?>