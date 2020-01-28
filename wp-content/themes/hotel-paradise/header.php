<?php
/**
 * The main template header file
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
if( $option['hide_preloader'] == false ){
?>
<div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
</div>
<?php } ?>
<div id="wrapper">
	<div class="site-header">		
		<?php do_action('hotel_paradise_before_site_header'); ?>		
		<div class="header-menu">
			<div class="container">
				<nav class="navbar navbar-default">
					<div class="navbar-header">					
					  <?php hotel_paradise_logo(); ?>				  
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only"><?php esc_html_e('Toggle navigation','hotel-paradise'); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
					   </button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php 
							wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class' => 'nav navbar-nav pull-right',
							'fallback_cb' => 'Hotel_Paradise_fallback_page_menu',
							'walker' => new Hotel_Paradise_WP_Bootstrap_Navwalker())
							); 
						?>
					</div>
				</nav>
			</div>
		</div><!-- End header-menu -->
		
	</div>
	<!-- End headder -->