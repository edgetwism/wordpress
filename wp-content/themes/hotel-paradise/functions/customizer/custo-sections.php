<?php
function hotel_paradise_customizer_sections(){
	
	$arg = array(
		'general_panel' => array( 
			'global' => __('Global','hotel-paradise'), 
			'top_header' => __('Top Bar','hotel-paradise'), 
			'theme_layout' => __('Layout','hotel-paradise'),
			'navigation_menu' => __('Navigation','hotel-paradise'),
			'primary_color' => __('Primary Color','hotel-paradise'),
			'single' => __('Single Post','hotel-paradise'),
			'title_setting' => __('Page Title','hotel-paradise'),
			'copyright' => __('Footer Copyright','hotel-paradise'),
			'preloader' => __('Preloader Settings','hotel-paradise'),
		),
		'hero_panel' => array( 
			'hero_setting' => __('Settings','hotel-paradise'), 
			'hero_images' => __('Background Images','hotel-paradise'), 
			'hero_contents' => __('Hero Contents','hotel-paradise'),
		),
		'service_panel' => array( 
			'service_setting' => __('Settings','hotel-paradise'), 
			'service_header' => __('Section Header','hotel-paradise'), 
			'service_contents' => __('Section Contents','hotel-paradise'),
			'service_back' => __('Section Background','hotel-paradise'),
		),
		'room_panel' => array( 
			'room_setting' => __('Settings','hotel-paradise'), 
			'room_header' => __('Section Header','hotel-paradise'), 
			'room_contents' => __('Section Contents','hotel-paradise'),
			'room_back' => __('Section Background','hotel-paradise'),
		),
		'contact_panel' => array( 
			'contact_setting' => __('Settings','hotel-paradise'), 
			'contact_info' => __('Contact Informations','hotel-paradise'), 	
			'contact_back' => __('Section Background','hotel-paradise'),
		),
		'blog_panel' => array( 
			'blog_setting' => __('Settings','hotel-paradise'), 
			'blog_header' => __('Section Header','hotel-paradise'), 
			'blog_contents' => __('Section Contents','hotel-paradise'),
			'blog_back' => __('Section Background','hotel-paradise'),
		),
		'typography_panel' => array( 
			'p_section' => __('General Content','hotel-paradise'), 
			'm_section' => __('Menu','hotel-paradise'),
			'h_section' => __('Heading','hotel-paradise'),
		),
	);
	
	$customize_sections = apply_filters('hotel_paradise_customize_sections', $arg );
	
	return $customize_sections;
}