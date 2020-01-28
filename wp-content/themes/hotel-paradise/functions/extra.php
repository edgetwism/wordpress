<?php
function hotel_paradise_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'Hotel Paradise Data' , 'hotel-paradise' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'hotel-paradise' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'pt-one-click-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'hotel_paradise_plugin_page_setup' );

function hotel_paradise_after_import_setup() {

    $main_menu = get_term_by( 'name', 'main menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blogs' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );
}
add_action( 'pt-ocdi/after_import', 'hotel_paradise_after_import_setup' );

function hotel_paradise_import_files() {
    return array(
        array(
            'import_file_name'           => 'Hotel Paradise',
            'import_file_url'            => get_template_directory_uri() . '/data_import/hotelparadise.wordpress.2019-02-16.xml',
            'import_widget_file_url'     => get_template_directory_uri() . '/data_import/localhost-hotel-paradise-lite-widgets.wie',

            'import_preview_image_url'   => get_template_directory_uri() . '/screenshot.png',
            'import_notice'              => __( 'Please click on below "Import Demo Data" button to import theme contents, After you import this demo, Enjoy our <strong>Hotel Paradise</strong> theme.', 'hotel-paradise' ),
            'preview_url'                => '//www.redfoxthemes.com/',
        ),		 
    );
}
add_filter( 'pt-ocdi/import_files', 'hotel_paradise_import_files' );

/* Hotel Paradise Post Category */
function hotel_paradise_categorized_blog() {
	$category_count = get_transient( 'hotel_paradise_categories' );

	if ( false === $category_count ) {
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );
		$category_count = count( $categories );
		set_transient( 'hotel_paradise_categories', $category_count );
	}

	
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}

/* Set excerpt length */
if ( ! function_exists( 'hotel_paradise_excerpt_length' ) ) :
function hotel_paradise_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'hotel_paradise_excerpt_length', 999 );
endif;

/* Update excerpt more button */
if ( ! function_exists( 'hotel_paradise_excerpt_more' ) ) :
function hotel_paradise_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'hotel_paradise_excerpt_more');
endif;

/* Hotel Paradise getting all users */
function hotel_paradise_get_users(){
	$users = get_users( array(
		'orderby'      => 'display_name',
		'order'        => 'ASC',
		'number'       => '',
	) );

	$option_users[0] = esc_html__( 'Select member', 'hotel-paradise' );
	foreach( $users as $user ){
		$option_users[ $user->ID ] = $user->display_name;
	}
		return $option_users;
}

/* Hotel Paradise getting all pages */
function hotel_paradise_get_pages(){
	$pages  =  get_pages();
	$option_pages = array();
	$option_pages[0] = esc_html__( 'Select page', 'hotel-paradise' );
	foreach( $pages as $p ){
		$option_pages[ $p->ID ] = $p->post_title;
	}
		return $option_pages;
}

/* Hotel Paradise animation effects */
function hotel_paradise_animations(){
	$effects_str = 'bounce flash pulse rubberBand shake headShake swing tada wobble jello bounceIn bounceInDown bounceInLeft bounceInRight bounceInUp fadeIn fadeInDown fadeInDownBig fadeInLeft fadeInLeftBig fadeInRight fadeInRightBig fadeInUp fadeInUpBig flipInX flipInY lightSpeedIn rotateIn rotateInDownLeft rotateInDownRight rotateInUpLeft rotateInUpRight hinge rollIn zoomIn zoomInDown zoomInLeft zoomInRight zoomInUp slideInDown slideInLeft slideInRight slideInUp';
			$effects_str = explode( ' ', $effects_str );
            $effect_arg = array(''=>'--select--');
            foreach ( $effects_str as $val ) {
                $val =  trim( $val );
                if ( $val ){
                    $effect_arg[ $val ]= $val;
                }

            }
		return $effect_arg;
}

/* Hotel Paradise font size */
function hotel_paradise_fontsize(){
	$font_size = array(''=>'--select--');
	for( $i=9; $i<=100; $i++ ){		
		$font_size[$i] = $i;		
	}	
	return $font_size;
}