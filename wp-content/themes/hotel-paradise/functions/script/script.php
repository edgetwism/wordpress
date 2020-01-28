<?php 
if( !function_exists('hotel_paradise_scripts') ){
	
	function hotel_paradise_scripts(){
		
		$theme = wp_get_theme( 'hotel-paradise' );
		$version = $theme->get( 'Version' );
		
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		
		if ( ! $option['google_fonts_hide'] ) {
			wp_enqueue_style('hotel-paradise-fonts', hotel_paradise_fonts(), array(), $version);
		}
	
		wp_enqueue_style( 'bootstrap' , get_theme_file_uri('/css/bootstrap.css'), array(), $version);
		wp_enqueue_style( 'animate' , get_theme_file_uri('/css/animate.css'), array(), $version);
		wp_enqueue_style( 'owl-carousel' , get_theme_file_uri('/css/owl.carousel.css'), array(), $version);
		wp_enqueue_style( 'font-awesome' , get_theme_file_uri('/css/font-awesome/css/font-awesome.css'), array(), $version);
		wp_enqueue_style( 'hotel-paradise-style' , get_stylesheet_uri(), array(), $version );
		wp_enqueue_style( 'hotel-paradise-google-fonts' , '//fonts.googleapis.com/css?family=Lato:200,300,400,500,600,700,800' );
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-bootstrap', get_theme_file_uri('/js/bootstrap.js'), array(), $version);
		wp_enqueue_script('jquery-wow', get_theme_file_uri('/js/wow.js'), array(), $version);
		wp_enqueue_script('jquery-owl-carousel', get_theme_file_uri('/js/owl.carousel.js'), array(), $version);
		wp_enqueue_script('hotel-paradise-custom-js', get_theme_file_uri('/js/custom.js'), array(), $version);
		
		/* settings */
		$hotel_paradise_settings = array(
			'disable_animation'     => $option['animation_effect_hide'],
			'hide_preloader'     => $option['hide_preloader'],
			'preloader_speed'     => $option['preloader_speed'],
		);
		wp_localize_script( 'jquery', 'hotel_paradise_settings', $hotel_paradise_settings );
		/* end settings */
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action('wp_enqueue_scripts','hotel_paradise_scripts');
?>