<?php
function hotel_paradise_customizer_panels(){
	
	$arg = array(
		'general_panel' => __('General Option','hotel-paradise'),
		
		'hero_panel' => __('Hotel Paradise : Section Hero','hotel-paradise'),
		
		'service_panel' => __('Hotel Paradise : Section Service','hotel-paradise'),
		
		'room_panel' => __('Hotel Paradise : Section Room','hotel-paradise'),
		
		'blog_panel' => __('Hotel Paradise : Section Blog','hotel-paradise'),

		'contact_panel' => __('Hotel Paradise : Section Contact','hotel-paradise'),
		
		'typography_panel' => __('Typography','hotel-paradise'),
	);
	
	$customize_panels = apply_filters('hotel_paradise_customize_panels', $arg );
	
	return $customize_panels;
}