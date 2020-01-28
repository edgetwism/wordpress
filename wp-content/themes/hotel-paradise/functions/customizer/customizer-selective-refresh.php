<?php
function hotel_paradise_customizer_load_template( $template_names ){
    $located = '';

    $is_child =  get_stylesheet_directory() != get_template_directory() ;
    foreach ( (array) $template_names as $template_name ) {
        if (  !$template_name )
            continue;

        if ( $is_child && file_exists( get_stylesheet_directory() . '/' . $template_name ) ) {  // Child them
            $located = get_stylesheet_directory() . '/' . $template_name;
            break;

        }elseif ( file_exists( get_template_directory() . '/' . $template_name) ) { // current_theme
            $located =  get_template_directory() . '/' . $template_name;
            break;
        }
    }
    
    return $located;
}

function hotel_paradise_get_customizer_section_content( $section_tpl, $section = array() ){
    ob_start();
    $GLOBALS['hotel_paradise_is_selective_refresh'] = true;
    $file = hotel_paradise_customizer_load_template( $section_tpl );
    if ( $file ) {
        include $file;
    }
    $content = ob_get_clean();
    return trim( $content );
}

function hotel_paradise_customizer_partials( $wp_customize ) {

    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) {
        return;
    }

    $selective_refresh_keys = array(
      
        // section services
        array(
            'id' => 'service',
            'selector' => '.service-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_servicetitle]',
                'hotel_paradise_option[hotel_paradise_servicesubtitle]',
                'hotel_paradise_option[hotel_paradise_services]',
            ),
        ),
		// section about
        array(
            'id' => 'about',
            'selector' => '.about-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_abouttitle]',
                'hotel_paradise_option[hotel_paradise_aboutsubtitle]',
                'hotel_paradise_option[hotel_paradise_about_boxes]',
            ),
        ),
		// section counter
        array(
            'id' => 'counter',
            'selector' => '.skill-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_countertitle]',
                'hotel_paradise_option[hotel_paradise_countersubtitle]',
                'hotel_paradise_option[hotel_paradise_counters]',
            ),
        ),
		// section team
        array(
            'id' => 'team',
            'selector' => '.team-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_teamtitle]',
                'hotel_paradise_option[hotel_paradise_teamsubtitle]',
                'hotel_paradise_option[hotel_paradise_team]',
            ),
        ),
		// section testimonial
        array(
            'id' => 'testimonial',
            'selector' => '.testimonial-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_teamtitle]',
                'hotel_paradise_option[hotel_paradise_teamsubtitle]',
                'hotel_paradise_option[hotel_paradise_team]',
            ),
        ),
		// section video
        array(
            'id' => 'video',
            'selector' => '.video-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_videotitle]',
                'hotel_paradise_option[hotel_paradise_video_link]',
            ),
        ),
		// section pricing
        array(
            'id' => 'pricing',
            'selector' => '.pricing-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_pricingtitle]',
                'hotel_paradise_option[hotel_paradise_pricingsubtitle]',
                'hotel_paradise_option[hotel_paradise_pricingitems]',
            ),
        ),
		// section callout
        array(
            'id' => 'callout',
            'selector' => '.callout-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_callouttitle]',
                'hotel_paradise_option[hotel_paradise_button_text]',
                'hotel_paradise_option[hotel_paradise_button_url]',
            ),
        ),
		// section project
        array(
            'id' => 'project',
            'selector' => '.portfolio-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_projecttitle]',
                'hotel_paradise_option[hotel_paradise_projectsubtitle]',
            ),
        ),
		// section contact
        array(
            'id' => 'contact',
            'selector' => '.contact-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_contacttitle]',
                'hotel_paradise_option[hotel_paradise_contactsubtitle]',
            ),
        ),
		// section blog
        array(
            'id' => 'blog',
            'selector' => '.news-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_blogtitle]',
                'hotel_paradise_option[hotel_paradise_blogsubtitle]',
            ),
        ),
		// section newsletter
        array(
            'id' => 'newsletter',
            'selector' => '.newsletter-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_newslettertitle]',
                'hotel_paradise_option[hotel_paradise_newsletter_link]',
            ),
        ),
		// section social
        array(
            'id' => 'social',
            'selector' => '.social-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_socialtitle]',
                'hotel_paradise_option[hotel_paradise_socialsubtitle]',
            ),
        ),
		// section client
        array(
            'id' => 'client',
            'selector' => '.client-area .container',
            'settings' => array(
                'hotel_paradise_option[hotel_paradise_clienttitle]',
                'hotel_paradise_option[hotel_paradise_clientsubtitle]',
                'hotel_paradise_option[hotel_paradise_client]',
            ),
        ),
		
    );

    foreach ( $selective_refresh_keys as $section ) {
        foreach ( $section['settings'] as $key ) {
            if ( $wp_customize->get_setting( $key ) ) {
                $wp_customize->get_setting( $key )->transport = 'postMessage';
            }
        }
		
		 $wp_customize->selective_refresh->add_partial( 'section-'.$section['id'] , array(
            'selector' => $section['selector'],
            'settings' => $section['settings'],
            'render_callback' => 'hotel_paradise_selective_refresh_render_section_content',
        ));
    }

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	$wp_customize->selective_refresh->add_partial( 'blogname' , array(
		'selector' => '.site-title span',
		'settings' => array('blogname'),
		'render_callback' => 'hotelparadise_blogname',
	));
	$wp_customize->selective_refresh->add_partial( 'blogdescription' , array(
		'selector' => '.site-description',
		'settings' => array('blogdescription'),
		'render_callback' => 'hotelparadise_blogdescription',
	));

}
add_action( 'customize_register', 'hotel_paradise_customizer_partials', 199 );


function hotel_paradise_selective_refresh_render_section_content( $partial, $container_context = array() ) {
    $tpl = 'home-page/'.$partial->id.'.php';
    $GLOBALS['hotel_paradise_is_selective_refresh'] = true;
    $file = hotel_paradise_customizer_load_template( $tpl );
    if ( $file ) {
        include $file;
    }
}

function hotel_paradise_blogname(){
	bloginfo('name');
}

function hotel_paradise_blogdescription(){
	bloginfo('decription');
}