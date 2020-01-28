<?php
// Pro notification button in customize settings
function hotel_paradise_pro_customizer( $wp_customize ) {

    class Hotel_Paradise_Pro_Customize_Control extends WP_Customize_Control {
        public $type = 'new_menu';

        /**
        * Render the control's content.
        */
        public function render_content() {
        ?>
         <div class="pro-box">
           <a href="<?php echo esc_url('http://redfoxthemes.com/downloads/hotel-paradise-pro/');?>" target="_blank" class="upgrade-hotel_paradise-pro" id="review_pro"><?php esc_html_e( 'UPGRADE TO PRO','hotel-paradise' ); ?></a>    		
    	</div>
        <?php
        }
    }

    $wp_customize->add_section( 'hotel_paradise_pro_section' , array(
		'title'      => esc_html__('Upgrade to Pro','hotel-paradise'),
		'priority'   => 500,
   	) );

        $wp_customize->add_setting(
            'upgrade_pro',
            array(
               'capability'     => 'edit_theme_options',
        		'sanitize_callback' => 'sanitize_text_field',
            )	
        );
        $wp_customize->add_control( new Hotel_Paradise_Pro_Customize_Control( $wp_customize, 'upgrade_pro', array(
        		'section' => 'hotel_paradise_pro_section',
        		'setting' => 'upgrade_pro',
            ))
        );
}
add_action( 'customize_register', 'hotel_paradise_pro_customizer' );
?>