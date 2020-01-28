<?php
function hotel_paradise_theme_options( $wp_customize ){
	
	$option = hotel_paradise_data();
	
	/* theme custom control file includes */ 
	require get_template_directory() . '/functions/customizer/customizer-controls.php';
	
	/* get customizer theme panels */ 
	$hpPanels = hotel_paradise_customizer_panels();
	
	/* get customizer theme all sections */ 
	$hpSections = hotel_paradise_customizer_sections();
	
	/* get customizer theme settings */ 
	$hpSettings = hotel_paradise_customizer_settings();
	
	/* making start theme panels */ 
	$priority = 30;
	foreach( $hpPanels as $k => $v ){
		$wp_customize->add_panel( $k ,array(
			'title' => $v,
			'priority' => 30,
		));
		$priority++;
	}// end panels
	
		$wp_customize->get_section( 'colors' )->panel = 'general_panel';
		$wp_customize->get_section( 'header_image' )->panel = 'general_panel';
		$wp_customize->get_section( 'background_image' )->panel = 'general_panel';
		
		/* making section for panels */ 
		$spriority = 1;
		foreach( $hpSections as $sk => $sections ){
			foreach( $sections as $key => $value ){
			$wp_customize->add_section( $key , array(
				'title'      => $value,
				'panel'  => $sk,
				'priority'       => $spriority,
			) );
			$spriority++;
			}
		}// end sections
		
		/* making start theme settings */ 
		foreach( $hpSettings as $sectionk => $settings_arg ){
			foreach( $settings_arg as $key => $value ){
							
				$wp_customize->add_setting( "hotel_paradise_option[$key]" , array(
					'default'    => $option[$key],
					'sanitize_callback' => (isset($value['sanitize_callback']) ? $value['sanitize_callback'] :'sanitize_text_field'),
					'type'=>'option'
				) );
				
				$control_arg = array(
				'label' => $value['label'],
				'description' => $value['desc'],
				'section' => $sectionk,
				'type'=> $value['type'],
				);				
				if( isset( $value['choices'] ) ){
					$control_arg['choices'] = $value['choices'];
				}
				
				$type = $value['type'];
				switch($type){
					case 'theme_color':
						$value['type'] = 'radio';
					break;
					case 'color_alpha':
						$value['type'] = '';
					break;
				}
				
				switch($type){
					
					case 'theme_color':
						$wp_customize->add_control( new hotel_paradise_Theme_Color_Customize_Control($wp_customize,"hotel_paradise_option[$key]", $control_arg ) );
					break;
					
					case 'image':
						$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,"hotel_paradise_option[$key]", $control_arg ) );
					break;
					
					case 'color':
						$control_arg['settings'] = "hotel_paradise_option[$key]";
						
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize ,"hotel_paradise_option[$key]", $control_arg ) );
					break;
					
					case 'color_alpha':
						$wp_customize->add_control( new hotel_paradise_Alpha_Color_Control($wp_customize,"hotel_paradise_option[$key]",
						array(
						'label' => $value['label'],
						'description' => $value['desc'],
						'section' => $sectionk,
						) ) );
					break;
					
					case 'theme_textarea':
						$wp_customize->add_control( new hotel_paradise_Editor_Custom_Control($wp_customize,"hotel_paradise_option[$key]",
						array(
						'label' => $value['label'],
						'description' => $value['desc'],
						'section' => $sectionk,
						) ) );
					break;
					
					case 'theme_repeater':
						$r_arg = array(
						'label' => $value['label'],
						'description' => $value['desc'],
						'section' => $sectionk,
						'title_format' => $value['title_format'],
						'max_item' => $value['max_item'],
						'fields' => $value['fields'],
						);
						
						if( isset( $value['live_title_id'] ) ){
							$r_arg['live_title_id'] = $value['live_title_id'];
						}
						
						if( isset( $value['limited_msg'] ) ){
							$r_arg['limited_msg'] = $value['limited_msg'];
						}
						
						$wp_customize->add_control( new hotel_paradise_Customize_Repeatable_Control($wp_customize,"hotel_paradise_option[$key]",
						 $r_arg ) );
					break;
					
					case 'theme_category':
						$c_arg = array(
						'label' => $value['label'],
						'description' => $value['desc'],
						'section' => $sectionk,
						);						
						$wp_customize->add_control( new hotel_paradise_Category_Control($wp_customize,"hotel_paradise_option[$key]",
						 $c_arg ) );
					break;
					
					default: 
					$wp_customize->add_control( "hotel_paradise_option[$key]" , $control_arg );
				}
			}
		} // end settings		
}
add_action( 'customize_register', 'hotel_paradise_theme_options' );