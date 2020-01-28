<?php
function hotel_paradise_customizer_settings(){
	$arg = array(
		'global' => array( 
			'primary_sidebar' => array(
				'default' => 'right',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Sidebar Layout','hotel-paradise'),
				'desc' => __('Sidebar Layout, apply this setting for all post and pages, exclude home page and custom page templates.','hotel-paradise'),
				'type' => 'select',
				'choices' => array(
					'left' => __('Left Sidebar','hotel-paradise'),
					'right' => __('Right Sidebar','hotel-paradise'),
					'none' => __('No Sidebar','hotel-paradise'),
				)
			),
			'btt_disable' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Hide footer back to top?','hotel-paradise'),
				'desc' => __('Check this setting to hide footer back to top button.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'animation_effect_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Disable animation effect?','hotel-paradise'),
				'desc' => __('Check this setting to disable all animation effect when scroll.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'google_fonts_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Disable google fonts?','hotel-paradise'),
				'desc' => __('Check this setting to disable google fonts in the theme.','hotel-paradise'),
				'type' => 'checkbox',
			),
		),
		'top_header' => array( 
			'header_tb_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Top Bar Disable?','hotel-paradise'),
				'desc' => __('Check this setting to hide top header bar.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'header_tb_icon1' => array(
				'default' => 'fa-map',
				'label' => __('Icon 1','hotel-paradise'),
				'desc' => __('Please enter your icon in the setting.','hotel-paradise'),
				'type' => 'text',
			),
			'header_tb_text1' => array(
				'default' => '',
				'label' => __('Icon 1 Text','hotel-paradise'),
				'desc' => __('Please enter your icon text in the setting.','hotel-paradise'),
				'type' => 'text',
			),
			'header_tb_icon2' => array(
				'default' => 'fa-phone',
				'label' => __('Icon 2','hotel-paradise'),
				'desc' => __('Please enter your icon in the setting.','hotel-paradise'),
				'type' => 'text',
			),
			'header_tb_text2' => array(
				'default' => '',
				'label' => __('Icon 2 Text','hotel-paradise'),
				'desc' => __('Please enter your icon text in the setting.','hotel-paradise'),
				'type' => 'text',
			),
			'header_facebook_link' => array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'label' => __('Facebook URL','hotel-paradise'),
				'desc' => __('Please enter your facebook URL.','hotel-paradise'),
				'type' => 'text',
			),
			'header_twitter_link' => array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'label' => __('Twitter URL','hotel-paradise'),
				'desc' => __('Please enter your twitter URL.','hotel-paradise'),
				'type' => 'text',
			),
			'header_linkedin_link' => array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'label' => __('LinkedIn URL','hotel-paradise'),
				'desc' => __('Please enter your linkedin URL.','hotel-paradise'),
				'type' => 'text',
			),
			'header_googleplus_link' => array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'label' => __('Google Plus URL','hotel-paradise'),
				'desc' => __('Please enter your google plus URL.','hotel-paradise'),
				'type' => 'text',
			),
			'header_skype_link' => array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
				'label' => __('Skype URL','hotel-paradise'),
				'desc' => __('Please enter your skype URL.','hotel-paradise'),
				'type' => 'text',
			),
		),
		'theme_layout' => array( 
			'site_layout' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Boxed Layout','hotel-paradise'),
				'desc' => __('Check this setting to show your website in Boxed layout.','hotel-paradise'),
				'type' => 'checkbox',
			),
		),
		'navigation_menu' => array( 
			'nav_padding' => array(
				'default' => 18,
				'label' => __('Navigation Menu Padding (px)','hotel-paradise'),
				'desc' => __('Enter padding value for left and right side.','hotel-paradise'),
				'type' => 'text',
			),
		),
		'primary_color' => array( 
			'theme_color' => array(
				'default' => '#85D13D',
				'label' => __('Primary Color:','hotel-paradise'),
				'desc' => __('Choose your primary color for your website.','hotel-paradise'),
				'type' => 'theme_color',
				'choices' => array(
					'#85D13D' => '#85D13D',
					'#775BA3' => '#775BA3',
					'#FC3258' => '#FC3258',					
				)
			),
		),
		'single' => array( 
			'single_meta_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Disable Single Post Meta','hotel-paradise'),
				'desc' => __('Check this setting to disable single post meta data.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'single_image_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Disable Single Post Thumbnail','hotel-paradise'),
				'desc' => __('Check this setting to disable single post thumbnail data.','hotel-paradise'),
				'type' => 'checkbox',
			),
		),
		'title_setting' => array( 
			'subheader_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Sub Header Disable?','hotel-paradise'),
				'desc' => __('Check this setting to disable sub header from single detail page.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'subheader_p_top' => array(
				'default' => 80,
				'label' => __('Padding Top (px)','hotel-paradise'),
				'desc' => __('Enter top padding value in pixels.','hotel-paradise'),
				'type' => 'text',
			),
			'subheader_p_bottom' => array(
				'default' => 80,
				'label' => __('Padding Bottom (px)','hotel-paradise'),
				'desc' => __('Enter bottom padding value in pixels.','hotel-paradise'),
				'type' => 'text',
			),
			'subheader_color' => array(
				'default' => '',
				'label' => __('Color','hotel-paradise'),
				'desc' => __('Select color for your title','hotel-paradise'),
				'type' => 'color',
			),
			'subheader_align' => array(
				'default' => 'center',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Text Align','hotel-paradise'),
				'desc' => __('Select your title alignment.','hotel-paradise'),
				'type' => 'select',
					'choices' => array(
						'left' => __('Left','hotel-paradise'),
						'center' => __('Center','hotel-paradise'),
						'right' => __('Right','hotel-paradise'),
					),
			),
			'subheader_overlay_bg' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_color_alpha',
				'label' => __('Sub Header Overlay Color','hotel-paradise'),
				'desc' => __('Choose overlay color.','hotel-paradise'),
				'type' => 'color_alpha',
			),
		),
		'copyright' => array( 
			'copyright' => array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'label' => __('Copyright','hotel-paradise'),
				'desc' => __('If you want to show copyright text in bottom of footer area.','hotel-paradise'),
				'type' => 'textarea',
			),
		),
		'preloader' => array(
			'hide_preloader' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Disable Preloader?','hotel-paradise'),
				'desc' => __('Check this to hide preloader from your site.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'preloader_speed' => array(
				'default' => 3500,
				'sanitize_callback' => 'sanitize_text_field',
				'label' => __('Preloader Display Delay Time','hotel-paradise'),
				'desc' => __('Please select preloader display delay time before page load.','hotel-paradise'),
				'type' => 'select',
				'choices' => array(
					100 => 100,
					500 => 500,
					1000 => 1000,
					1500 => 1500,
					2000 => 2000,
					2500 => 2500,
					3000 => 3000,
					3500 => 3500,
					4000 => 4000,
				),
			),
		),
		
		/* Slider Settings */
		'hero_setting' => array(
			'hero_section_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Hero Section Disable?','hotel-paradise'),
				'desc' => __('Check this to hide hero section from Front Page Template.','hotel-paradise'),
				'type' => 'checkbox',
			),
			'hero_animation_type' => array(
				'default' => 'slide',
				'sanitize_callback' => 'sanitize_text_field',
				'label' => __('Animation Type','hotel-paradise'),
				'desc' => __('Select animation type.','hotel-paradise'),
				'type' => 'select',
				'choices' => array(
					'slide' => 'Slide',
					'vertical' => 'Vertical',
					'fade' => 'Fade',
				),
			),
			'hero_speed' => array(
				'default' => 3000,
				'sanitize_callback' => 'sanitize_text_field',
				'label' => __('Speed','hotel-paradise'),
				'desc' => __('Select slider speed.','hotel-paradise'),
				'type' => 'select',
				'choices' => array(
					500 => 500,
					1000 => 1000,
					1500 => 1500,
					2000 => 2000,
					2500 => 2500,
					3000 => 3000,
					3500 => 3500,
					4000 => 4000,
					4500 => 4500,
					5000 => 5000,
					5500 => 5500,
					6000 => 6000,
				),
			),
		),
		'hero_images' => array(
			'hero_media' => array(
				'default' => json_encode( array(
						array(
							'image'=> array(
								'url' => get_template_directory_uri().'/images/slide2.jpg',
								'id' => ''
							)
						)
					) ),
				'sanitize_callback' => 'hotel_paradise_sanitize_repeatable_data_field',
				'transport' => 'refresh',
				
				'label' => __('Background Images','hotel-paradise'),
				'desc' => __('Upload here your home page slider photos.','hotel-paradise'),
				'type' => 'theme_repeater',
				'title_format'  => esc_html__( 'Background', 'hotel-paradise'),
				'max_item'      => 2,
				'fields'    => array(
					'image' => array(
						'title' => esc_html__('Background Image', 'hotel-paradise'),
						'type'  =>'media',
						'default' => array(
							'url' => get_template_directory_uri().'/images/slide2.jpg',
							'id' => ''
						)
					),
				),
			),	
		),
		'hero_contents' => array(
			'hero_largetext' => array(
				'default' => '',
				'label' => __('Large Text','hotel-paradise'),
				'desc' => __('Enter your big text for the hero section.','hotel-paradise'),
				'type' => 'theme_textarea',
			),
			'hero_large_effect' => array(
				'default' => '',
				'label' => __('Large Text Effect','hotel-paradise'),
				'desc' => __('Select effect for large text.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_animations(),
			),
			'hero_smalltext' => array(
				'default' => '',
				'label' => __('Small Text','hotel-paradise'),
				'desc' => __('Enter your small text for the hero section.','hotel-paradise'),
				'type' => 'theme_textarea',
			),
			'hero_small_effect' => array(
				'default' => '',
				'label' => __('Small Text Effect','hotel-paradise'),
				'desc' => __('Select effect for small text.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_animations(),
			),
			'hero_btn_text' => array(
				'default' => '',
				'label' => __('Button Text','hotel-paradise'),
				'desc' => __('Enter hero button text.','hotel-paradise'),
				'type' => 'text',
			),
			'hero_btn_link' => array(
				'default' => '',
				'label' => __('Button URL Link','hotel-paradise'),
				'desc' => __('Enter hero button url link.','hotel-paradise'),
				'type' => 'text',
			),
			'hero_btn_effect' => array(
				'default' => '',
				'label' => __('Button Text Effect','hotel-paradise'),
				'desc' => __('Select effect for button text.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_animations(),
			),
			
		),
		/* End Slider Settings */
		
		/* Contact Section */
		'contact_setting' => array(
			'contact_s_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Contact Section Disable?','hotel-paradise'),
				'desc' => __('Check this to hide contact section from Front Page Template.','hotel-paradise'),
				'type' => 'checkbox',
			),
			
		),
		'contact_info' => array(
			'contact_s_address' => array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'label' => __('Address:','hotel-paradise'),
				'desc' => __('Please enter your address here.','hotel-paradise'),
				'type' => 'textarea',
			),
			'contact_s_phone' => array(
				'default' => '',
				'label' => __('Phone:','hotel-paradise'),
				'desc' => __('Please enter your phone number.','hotel-paradise'),
				'type' => 'text',
			),
			'contact_s_email' => array(
				'default' => '',
				'label' => __('Email:','hotel-paradise'),
				'desc' => __('Please enter your email address here.','hotel-paradise'),
				'type' => 'text',
			),
		),
		/* End Contact Section */
		
		/* Blog Section */
		'blog_setting' => array(
			'blog_s_hide' => array(
				'default' => false,
				'sanitize_callback' => 'hotel_paradise_sanitize_checkbox',
				'label' => __('Blog Section Disable?','hotel-paradise'),
				'desc' => __('Check this to hide blog section from Front Page Template.','hotel-paradise'),
				'type' => 'checkbox',
			),
		),
		'blog_header' => array(
			'blog_s_title' => array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'label' => __('Title','hotel-paradise'),
				'desc' => __('Please enter title for this section.','hotel-paradise'),
				'type' => 'text',
			),
			'blog_s_subtitle' => array(
				'default' => '',
				'sanitize_callback' => 'wp_kses_post',
				'label' => __('Subtitle','hotel-paradise'),
				'desc' => __('Please enter subtitle for this section.','hotel-paradise'),
				'type' => 'text',
			),
		),
		'blog_contents' => array(
			'blog_s_noofshow' => array(
				'default' => 4,
				'label' => __('No. of blog to show','hotel-paradise'),
				'desc' => __('Enter value to show no. of blogs on front page.','hotel-paradise'),
				'type' => 'text',
			),
			'blog_s_orderby' => array(
				'default' => 0,
				'label' => __('Order By','hotel-paradise'),
				'desc' => __('Select this setting to show blogs with order by.','hotel-paradise'),
				'type' => 'select',
				'choices' => array(
						'default' => esc_html__('Default', 'hotel-paradise'),
						'id' => esc_html__('ID', 'hotel-paradise'),
						'author' => esc_html__('Author', 'hotel-paradise'),
						'title' => esc_html__('Title', 'hotel-paradise'),
						'date' => esc_html__('Date', 'hotel-paradise'),
						'comment_count' => esc_html__('Comment Count', 'hotel-paradise'),
						'menu_order' => esc_html__('Order by Page Order', 'hotel-paradise'),
						'rand' => esc_html__('Random order', 'hotel-paradise'),
					)
			),
			'blog_s_order' => array(
				'default' => 'desc',
				'label' => __('Order','hotel-paradise'),
				'desc' => __('Select this setting to show blogs with ASC/DESC.','hotel-paradise'),
				'type' => 'select',
				'choices' => array(
					'desc' => esc_html__('Descending', 'hotel-paradise'),
					'asc' => esc_html__('Ascending', 'hotel-paradise'),
				),
			),
			'blog_s_cat' => array(
				'default' => 0,
				'label' => __('Select Category','hotel-paradise'),
				'desc' => __('Select category to show this category of posts.','hotel-paradise'),
				'type' => 'theme_category',
			),
		),
		'blog_back' => array(
			'blog_s_bgcolor' => array(
				'default' => '',
				'label' => __('Background Color','hotel-paradise'),
				'desc' => __('Select section background color.','hotel-paradise'),
				'type' => 'color',
			),
			'blog_s_bgimage' => array(
				'default' => '',
				'label' => __('Background Image','hotel-paradise'),
				'desc' => __('Upload image for the section.','hotel-paradise'),
				'type' => 'image',
			),
		),
		/* End Blog Section */	

		'p_section' => array( 
			'p_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
		),
		'm_section' => array( 
			'm_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
		),
		'h_section' => array( 
			'h1_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
			'h2_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
			'h3_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
			'h4_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
			'h5_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
			'h6_fontsize' => array(
				'default' => '',
				'sanitize_callback' => 'hotel_paradise_sanitize_select',
				'label' => __('Font Size (px)','hotel-paradise'),
				'desc' => __('Select font size.','hotel-paradise'),
				'type' => 'select',
				'choices' => hotel_paradise_fontsize(),
			),
		),
	);
	
	$customize_settings = apply_filters('hotel_paradise_customize_settings', $arg );
	
	return $customize_settings;
}