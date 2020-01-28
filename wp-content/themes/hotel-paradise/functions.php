<?php 
/**
 * Hotel Paradise Theme functions and definitions file
 *
 */
 
/*....................................
....  Theme Setup Function
....................................*/ 
if( !function_exists( 'hotel_paradise_setup' ) ){
	
	function hotel_paradise_setup(){
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'hotel-paradise', get_template_directory() . '/lang' );
		
		
		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );
		
		/*
		 * manage the document title.
		 */
		add_theme_support( 'title-tag' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 */
		add_theme_support( 'post-thumbnails' );
		
		add_image_size( 'hotel-paradise-featured-image', 2000, 1200, true );

		add_image_size( 'hotel-paradise-thumbnail-avatar', 100, 100, true );
		
		$GLOBALS['content_width'] = 710;
		
		/*
		 * This theme uses wp_nav_menu() in primary locations.
		 *
		 */
		register_nav_menus( array(
			'primary'    => __( 'Primary Menu', 'hotel-paradise' ),
		) );
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		// adding post format supports.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );
		
		/*
		 * Custom logo
		 * Add theme support for custom logo. https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
		) );
		
		// Add custom header support. https://codex.wordpress.org/Custom_Headers
		$args = array(
			'width'        => 1600,
			'flex-width'   => true,
			'default-image' => '',
			'header-text'   => false,
		);
		add_theme_support( 'custom-header', $args );
		
		// Add custom background support. https://codex.wordpress.org/Custom_Backgrounds
		add_theme_support( 'custom-background', array(
				'default-color' => '#EFF2DD',
			)
		);
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// editor-style file support
		add_editor_style( array( 'css/editor-style.css', hotel_paradise_fonts() ) );
		
		add_theme_support( 'recommend-plugins', array(
			'redfox-companion' => array(
                'name' => esc_html__( 'RedFox Companion', 'hotel-paradise' ),
				'desc' => esc_html__( 'We highly recommend that you install the redfox companion plugin to gain access to the service and room sections.', 'hotel-paradise' ),
                'active_filename' => 'redfox-companion/redfox-companion.php',
            ),
            'contact-form-7' => array(
                'name' => esc_html__( 'Contact Form 7', 'hotel-paradise' ),
				'desc' => esc_html__( 'This is also recommended that you install the contact form plugin to show contact form on Front Page contact section and Contact custom page template.', 'hotel-paradise' ),
                'active_filename' => 'contact-form-7/wp-contact-form-7.php',
            ),
        ) );
		
	}
}
add_action( 'after_setup_theme', 'hotel_paradise_setup' );

/**
 * Delete post category transient data.
 *
 * @since 1.1
 *
 */
function hotel_paradise_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'hotel_paradise_categories' );
}
add_action( 'edit_category', 'hotel_paradise_category_transient_flusher' );
add_action( 'save_post',     'hotel_paradise_category_transient_flusher' );

/**
 * Register Google Fonts.
 *
 * @since 1.1
 *
 * @return string
 */ 
if ( ! function_exists( 'hotel_paradise_fonts' ) ) :
	function hotel_paradise_fonts() {
	    $fontsurl = '';
	    $open_sans = _x( 'on', 'Open Sans font: on or off', 'hotel-paradise' );
	    $Poppins = _x( 'on', 'Poppins font: on or off', 'hotel-paradise' );

	    if ( 'off' !== $Poppins || 'off' !== $open_sans ) {
	        $fontfamilies = array();

	        if ( 'off' !== $Poppins ) {
	            $fontfamilies[] = 'Poppins:400,500,600,700,300,100,800,900';
	        }
	        if ( 'off' !== $open_sans ) {
	            $fontfamilies[] = 'Open Sans:400,300,300italic,400italic,600,600italic,700,700italic';
	        }
			
			$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
			
	        $query_args = array(
	            'family' => urlencode( implode( '|', $fontfamilies ) ),
	            'subset' => urlencode( 'latin,latin-ext' ),
	        );
	        $fontsurl = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	    }
	    return esc_url_raw( $fontsurl );
	}
endif;

/**
 * Filter WP Title tags.
 *
 * @since 1.1
 *
 * @param string $title site title
 * @param string $sep separator value
 * @return string
 */     
function hotel_paradise_title_filter( $title, $sep ){	
    global $paged, $page;
	if( is_home() ){
		return $title;
	}
	if ( is_feed() )
        return $title;
	
		// Add the site name.
		$title .= esc_html( get_bloginfo( 'name' ) );
		
		// Add the site description for the home/front page.
		$site_description = esc_html(  get_bloginfo( 'description' ) );
		
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";
		
		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page', 'hotel-paradise' ), max( $paged, $page ) );
		
		return $title;
}	
add_filter( 'wp_title', 'hotel_paradise_title_filter', 10,2 );

/*....................................
....  Files Includes
....................................*/

// default data file include
require get_parent_theme_file_path( '/functions/default_data.php' );

// extra functions file include
require get_parent_theme_file_path( '/functions/extra.php' );

// script file include
require get_parent_theme_file_path( '/functions/script/script.php' );

// sidebar file include
require get_parent_theme_file_path( '/functions/widget/sidebar.php' );

// template tag file include
require get_parent_theme_file_path( '/functions/template-tags.php' );

// menu file include
require get_parent_theme_file_path( '/functions/menu/default_menu_walker.php' );
require get_parent_theme_file_path( '/functions/menu/theme_navwalker.php' );

// breadcrumbs file include
require get_parent_theme_file_path( '/functions/breadcrumbs/breadcrumbs.php' );

// customizer file include
require get_parent_theme_file_path( '/functions/customizer/customizer.php' );

// theme functions file include
require get_parent_theme_file_path( '/functions/theme-functions.php' );

// welcome screen page file include
require get_parent_theme_file_path( '/functions/about-screen/welcome-screen.php' );