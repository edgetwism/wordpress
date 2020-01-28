<?php
/**
 * Load front page section.
 *
 * Hotel Paradise used hotel_paradise_load_section() function to load theme sections.
 *
 * @since 1.1
 * 
 * @param string $Section_Id theme seciton id
 */
if ( ! function_exists( 'hotel_paradise_load_section' ) ) {
	function hotel_paradise_load_section( $Section_Id ){
		
		do_action('hotel_paradise_before_section_' . $Section_Id);
        do_action('hotel_paradise_before_section_part', $Section_Id);

        get_template_part('sections/section', $Section_Id );

        do_action('hotel_paradise_after_section_part', $Section_Id);
        do_action('hotel_paradise_after_section_' . $Section_Id);
	}
}

/**
 * Get media URL.
 *
 * Hotel Paradise used hotel_paradise_get_media_url() function to get media URL.
 *
 * @since 1.1
 * 
 * @param array $media images contents
 * @param string $size image size
 * @return string
 */
if ( ! function_exists( 'hotel_paradise_get_media_url' ) ) {
    function hotel_paradise_get_media_url($media = array(), $size = 'full' )
    {
        $media = wp_parse_args( $media, array('url' => '', 'id' => ''));
        $url = '';
        if ($media['id'] != '') {
            if ( strpos( get_post_mime_type( $media['id'] ), 'image' ) !== false ) {
                $image = wp_get_attachment_image_src( $media['id'],  $size );
                if ( $image ){
                    $url = $image[0];
                }
            } else {
                $url = wp_get_attachment_url( $media['id'] );
            }
        }

        if ($url == '' && $media['url'] != '') {
            $id = attachment_url_to_postid( $media['url'] );
            if ( $id ) {
                if ( strpos( get_post_mime_type( $id ), 'image' ) !== false ) {
                    $image = wp_get_attachment_image_src( $id,  $size );
                    if ( $image ){
                        $url = $image[0];
                    }
                } else {
                    $url = wp_get_attachment_url( $id );
                }
            } else {
                $url = $media['url'];
            }
        }
        return $url;
    }
}

/**
 * Getting theme layout.
 *
 * Hotel Paradise used hotel_paradise_get_layout() function get theme layout.
 *
 * @since 1.1
 * 
 * @param string $default theme layout
 * @return string
 */
if ( ! function_exists( 'hotel_paradise_get_layout' ) ) {
    function hotel_paradise_get_layout( $default = 'right' ) {
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		
        $layout = $option['primary_sidebar'];
        if ( class_exists('woocommerce') ) {
            if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url() ) {
                $is_active_sidebar = is_active_sidebar( 'sidebar-woocommerce' );
                if ( ! $is_active_sidebar ) {
                    $layout = 'none';
                }
            }
        }
        return apply_filters( 'hotel_paradise_get_layout', $layout, $default );
    }
}


/**
 * Displaying site custom logo.
 *
 * Hotel Paradise used hotel_paradise_logo() function to display
 * site custom logo.
 *
 * @since 1.1
 *
 */
If( !function_exists('hotel_paradise_logo') ){
	
	function hotel_paradise_logo(){
		
		if( has_custom_logo() ){
		
			the_custom_logo();
			
		}else{ ?>		
		
		<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php
			$description = get_bloginfo( 'description', 'display' );

			if ( $description || is_customize_preview() ) :
			?>
				<p class="site-description"><?php echo esc_html($description); ?></p>
			<?php endif; ?>
		</div><!-- .site-branding-text -->
		<?php
		}
		
	}
}

/**
 * Displaying post meta data.
 *
 * Hotel Paradise used hotel_paradise_post_image_meta() function to display
 * post meta contents.
 *
 * @since 1.1
 *
 */
if( !function_exists('hotel_paradise_post_image_meta') ){
	
	function hotel_paradise_post_image_meta(){
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		
		if( $option['single_meta_hide'] == true ){
			return;
		}
		?>
		<div class="entry-meta">
			<span class="post_date"><a href="<?php echo esc_url( get_month_link( get_post_time('Y') ,get_post_time('m') ) ); ?>"><i class="fa fa-calendar"></i> <time><?php echo esc_attr( get_the_date( get_option('date_format') ) ); ?></time></a></span>
			
			<span class="post_author"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><i class="fa fa-user"></i> <?php echo esc_html(get_the_author_link());?></a></span>
			
			<?php
			if ( is_sticky() && is_home() ) : ?>
				<span class="post_author"><?php esc_html_e('Sticky','hotel-paradise'); ?></span>
			<?php endif; ?>
		</div>
		<?php
	}
}


/**
 * Displaying post footer contents.
 *
 * Hotel Paradise used hotel_paradise_post_footer() function to display
 * footer contents of the post.
 *
 * @since 1.1
 *
 */
if( !function_exists('hotel_paradise_post_footer') ){
	
	function hotel_paradise_post_footer(){
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		
		if( $option['single_meta_hide'] == true ){
			return;
		}
		
		?>
		<footer class="entry-footer">
			<?php 
			$separate_meta = __( ', ', 'hotel-paradise' );
			$categories_list = get_the_category_list( $separate_meta );
			
			 if( ( $categories_list ) ){
			?>
			<span class="cat-links">
				<i class="fa fa-folder-o"></i>
				<?php echo wp_kses_post( $categories_list ); ?>
			</span>
			<?php } ?>
			
			<?php 
			// Get Tags for posts.
			$tags_list = get_the_tag_list( '', $separate_meta ); 
			if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			?>
			<span class="tag-links">
				<i class="fa fa-tags"></i>
				<?php  echo wp_kses_post($tags_list); ?>
			</span>
			<?php } ?>
		</footer>
		<?php
	}
}


/**
 * Displaying featured image on posts.
 *
 * Hotel Paradise used hotel_paradise_featured_image() function to display
 * featured image of the post.
 *
 * @since 1.1
 *
 */
if( !function_exists('hotel_paradise_featured_image') ){
	function hotel_paradise_featured_image(){
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		
		if( is_single() && $option['single_image_hide'] == true ){
			return;
		}
		
		if( has_post_thumbnail() ){
			?>
			<div class="blog_thumbnial">
				<?php 
				the_post_thumbnail('hotel-paradise-featured-image');
				
				hotel_paradise_post_image_meta();
				?>		
			</div>
			<?php
		}
	}
}

/**
 * Display Theme Author Informations.
 *
 * Hotel Paradise used hotel_paradise_author_detail() function to display author
 * informations in single page.
 *
 * @since 1.1
 *
 */
if( !function_exists('hotel_paradise_author_detail') ){
	
	function hotel_paradise_author_detail(){
		?>
		<div class="author_wrap">
			<div class="media">
				<div class="author-image pull-left">
					<?php echo get_avatar( get_the_author_meta( 'ID') , 150 ); ?>
				</div>
				<div class="media-body">
					<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" class="author_title">
						<h3><?php the_author(); ?></h3>
					</a>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}

/**
 * Displaying site header.
 *
 * Hotel Paradise added a action "hotel_paradise_before_site_header" for display site
 * header.
 *
 * @since 1.1
 *
 */
if( !function_exists('hotel_paradise_top_header') ){
	function hotel_paradise_top_header(){
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		
		if( $option['header_tb_hide'] == false ){
		?>
		<div class="top-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						
						<?php if( $option['header_tb_text1'] != '' ){ ?>
						<div class="top-info"><i class="fa <?php echo esc_attr( $option['header_tb_icon1'] ); ?>"></i> <?php echo esc_html( $option['header_tb_text1'] ); ?></div>
						<?php } ?>
						
						<?php if( $option['header_tb_text2'] != '' ){ ?>
						<div class="top-info"><i class="fa <?php echo esc_attr( $option['header_tb_icon2'] ); ?>"></i><?php echo esc_html( $option['header_tb_text2'] ); ?></div>
						<?php } ?>
					</div>
					<div class="col-md-6 col-sm-6">
						<ul class="top-social-list pull-right">
							
							<?php if( $option['header_facebook_link'] != '' ): ?>
							<li><a href="<?php echo esc_url( $option['header_facebook_link'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>
							
							<?php if( $option['header_twitter_link'] != '' ): ?>
							<li><a href="<?php echo esc_url( $option['header_twitter_link'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>
							
							<?php if( $option['header_linkedin_link'] != '' ): ?>
							<li><a href="<?php echo esc_url( $option['header_linkedin_link'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>
							
							<?php if( $option['header_googleplus_link'] != '' ): ?>
							<li><a href="<?php echo esc_url( $option['header_googleplus_link'] ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
							<?php endif; ?>
							
							<?php if( $option['header_skype_link'] != '' ): ?>
							<li><a href="<?php echo esc_url( $option['header_skype_link'] ); ?>" target="_blank"><i class="fa fa-skype"></i></a></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- End top-header -->
		<?php
		}
	}
}
add_action('hotel_paradise_before_site_header','hotel_paradise_top_header');


/**
 * Echo copyright footer data.
 *
 * Hotel Paradise added action "copyright" for displaying copyright data.
 *
 * @since 1.1
 *
 */
function hotel_paradise_copyright(){
	$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
	?>
	<div class="footer-copyright">
		<div class="container">
			<div class="row copyright_row">
				<div class="col-md-12 text-center">
					<?php if( isset($option['copyright']) && !empty($option['copyright'])): ?>
					<p class="copyright-text"><?php echo wp_kses_post( $option['copyright'] ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div><!-- End footer-copyright -->
	
	<?php if( $option['btt_disable'] == false ): ?>
	<a class="toTop"><i class="fa fa-arrow-up"></i></a>
	<?php endif;	
}
add_action('hotel_paradise_copyright','hotel_paradise_copyright');


/**
 * Custom class for body tag.
 *
 * Hotel Paradise body class filter used in the theme.
 *
 * @since 1.1
 *
 * @param array $classes body classes
 * @return array
 */
function hotel_paradise_body_classes( $classes ) {
	$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );

	if ( $option['site_layout'] == true ) {
		$classes[] = 'boxed';
	}
	return $classes;
}
add_filter( 'body_class', 'hotel_paradise_body_classes' );

/**
 * Setup theme color.
 *
 * @since 1.1
 *
 */
add_action('wp_head','hotel_paradise_primary_color');
function hotel_paradise_primary_color(){
	$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
	
	if($option['theme_color_custom_show']==true){
		$color = $option['theme_color_custom_color'];
	}
	else{
		$color = $option['theme_color'];
	}
	
	echo '<style id="hotel-paradise-color">';
		hotel_paradise_set_color($color);
	echo '</style>';
}

/**
 * Primary Color.
 *
 * Hotel Paradise assing primary color in theme css.
 *
 * @since 1.1
 *
 */
function hotel_paradise_set_color( $color = '#f4364f' ){
	$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
	
	list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
	?>
	:root{
		--sub-header-bg-color: <?php echo esc_attr( $color ); ?>;
		<?php if($option['subheader_overlay_bg']!=''){ ?>
		--sub-header-bg-color: <?php echo esc_attr( $option['subheader_overlay_bg'] ); ?>;
		<?php } ?>
	}
	a:hover, 
	a:focus,
	.top-social-list > li > a:hover, 
	.top-social-list > li > a:focus,
	.navbar-default .navbar-brand:focus, 
	.navbar-default .navbar-brand:hover,
	.home-slider:hover .carousel-control,
	.section_header h2 span,
	.service_icon,
	.service_title h3:hover, 
	.service_title h3:focus,
	.room_title h3:hover, 
	.room_title h3:focus,
	.room-regular-price .room-price,
	.room-btn:hover, 
	.room-btn:focus,
	.card_room:hover .room_occupacy,
	.card-blog .blogContent .blogTitle h3:hover,
	.testimonialContent .testi-title h3,
	.testimonialContent .testi-title h3:hover,
	.counter_item .fa,
	.contact-secondary-inner label,
	.error_title_404,
	.entry-meta .post_date:after, 
	.entry-meta .post_author:after,
	.footer-menu ul li a:hover,
	.footer-menu ul > .active > a,
	.copyright-text a:hover, 
	.copyright-text a:focus,
	.footer-copyright .card-payment:hover,
	.widget ul li.current-menu-item a,
	.widget ul li.current_page_item a,
	.widget ul li.current-cat a{ color: <?php echo esc_attr($color); ?>; }

	input[type=button]:hover, 
	input[type=button]:focus, 
	input[type=submit]:hover, 
	input[type=submit]:focus, 
	input[type=reset]:hover,
	input[type=reset]:focus,
	.navbar-default .navbar-nav > li > a:focus, 
	.navbar-default .navbar-nav > li > a:hover,
	.navbar-default .navbar-nav > .active > a, 
	.navbar-default .navbar-nav > .active > a:focus, 
	.navbar-default .navbar-nav > .active > a:hover,
	.navbar-default .navbar-nav > .current-menu-parent > a, 
	.navbar-default .navbar-nav > .current-menu-parent > a:focus, 
	.navbar-default .navbar-nav > .current-menu-parent > a:hover,
	.navbar-default .navbar-nav > .open > a, 
	.navbar-default .navbar-nav > .open > a:focus, 
	.navbar-default .navbar-nav > .open > a:hover,
	.dropdown-menu > li > a:focus, 
	.dropdown-menu > li > a:hover,
	.dropdown-menu > .active > a, 
	.dropdown-menu > .active > a:focus, 
	.dropdown-menu > .active > a:hover,
	.dropdown-menu > .open > a, 
	.dropdown-menu > .open > a:focus, 
	.dropdown-menu >.open > a:hover,
	.navbar-default .navbar-nav > .current_page_item > a, 
	.navbar-default .navbar-nav > .current_page_item > a:focus, 
	.navbar-default .navbar-nav > .current_page_item > a:hover,
	.navbar-default .navbar-nav > .current_menu_item > a, 
	.navbar-default .navbar-nav > .current_menu_item > a:focus, 
	.navbar-default .navbar-nav > .current_menu_item > a:hover,
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a, 
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, 
	.navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus,
	.slider_overlay .slide-btn,
	.section_header p::before,
	.room-btn,
	.room_occupacy,
	.callout-btn,
	.contact_wrap,
	.gallery-btn,
	.error_button,
	.entry-meta .post_date, 
	.entry-meta .post_author,
	.more-link,
	.toTop,
	.widget .tagcloud a:hover,
	.widget .tagcloud a:focus,
	.page-numbers.current,
	.footer-widgets .widget caption,
	.footer-widgets .widget .searchform #searchsubmit,
	.news_slider .carousel-control,
	#loader-wrapper .loader-section{ background-color: <?php echo esc_attr($color); ?>; }

	.dropdown-menu > .active > a, 
	.dropdown-menu > .active > a:focus, 
	.dropdown-menu > .active > a:hover{
		border-color: <?php echo esc_attr($color); ?>;
	}

	.room_overlay,
	.card-blog .news_overlay{ 
		background-color: <?php echo esc_attr($color); ?>dd;
	}
	.slider_overlay .slide-btn,
	.carousel-indicators li,
	.room-btn{ 
		border: 2px solid <?php echo esc_attr($color); ?>; 
	}
	.callout_content{ 
		border: 7px solid <?php echo esc_attr($color); ?>; 
	}
	.site-footer {
		border-top: 4px solid <?php echo esc_attr($color); ?>;
		border-bottom: 4px solid <?php echo esc_attr($color); ?>;
	}
	.widget-title::before {
		border-color: <?php echo esc_attr($color); ?>;
	}
	blockquote {
		border-left: 5px solid <?php echo esc_attr($color); ?>;
	}
	
	/*--- navigation padding ---*/
	.nav > li > a{ 
		padding-left: <?php echo intval($option['nav_padding']); ?>px; 
		padding-right: <?php echo intval($option['nav_padding']); ?>px; 
	}
	
	/*--- sub header padding ---*/
	.sub-header .section_overlay{ 
		padding-top: <?php echo intval($option['subheader_p_top']); ?>px; 
		padding-bottom: <?php echo intval( $option['subheader_p_bottom']); ?>px;
	}
	.sub-header .sub-header-title{
		color: <?php echo esc_attr($option['subheader_color']); ?>;
	}
	<?php
	$b_fontsize = $option['p_fontsize']; 
	$m_fontsize = $option['m_fontsize']; 
	$h1_fontsize = $option['h1_fontsize'];
	$h2_fontsize = $option['h2_fontsize'];
	$h3_fontsize = $option['h3_fontsize'];
	$h4_fontsize = $option['h4_fontsize'];
	$h5_fontsize = $option['h5_fontsize'];
	$h6_fontsize = $option['h6_fontsize'];
	?>
	body{
		<?php if($b_fontsize){ ?>
		font-size: <?php echo intval( $b_fontsize ); ?>px !important;
		<?php } ?>
	}
	
	.header-menu .navbar-nav > li > a,
	.dropdown-menu > li > a{
		<?php if($m_fontsize){ ?>
		font-size: <?php echo intval( $m_fontsize ); ?>px !important;
		<?php } ?>
	}
	h1{
		<?php if($h1_fontsize){ ?>
		font-size: <?php echo intval( $h1_fontsize ); ?>px;
		<?php } ?> 
	}
	h2{
		<?php if($h2_fontsize){ ?>
		font-size: <?php echo intval( $h2_fontsize ); ?>px;
		<?php } ?> 
	}
	h3{
		<?php if($h3_fontsize){ ?>
		font-size: <?php echo intval( $h3_fontsize ); ?>px;
		<?php } ?> 
	}
	h4{
		<?php if($h4_fontsize){ ?>
		font-size: <?php echo intval( $h4_fontsize ); ?>px;
		<?php } ?> 
	}
	h5{
		<?php if($h5_fontsize){ ?>
		font-size: <?php echo intval( $h5_fontsize ); ?>px;
		<?php } ?> 
	}
	h6{
		<?php if($h6_fontsize){ ?>
		font-size: <?php echo intval( $h6_fontsize ); ?>px;
		<?php } ?> 
	}
	<?php
}


/**
 * Service Contents.
 *
 * Hotel Paradise getting service section data.
 *
 * @since 1.1
 *
 * @return array.
 */
if ( ! function_exists( 'hotel_paradise_get_section_services_data' ) ) {
	
	function hotel_paradise_get_section_services_data(){
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		$services = $option['service_s_content'];
		if (is_string($services)) {
            $services = json_decode($services, true);
        }
		$page_ids = array();
		if (!empty($services) && is_array($services)) {
            foreach ($services as $k => $v) {
                $page_ids[] = wp_parse_args($v, array(
					'icon_type' => 'icon',
					'image' => '',
					'icon' => 'gg',
					'iconcolor' => '#F4364F',
					'title' => '',
					'desc' => '',
					'link' => '#',
					'enable_link' => 0
				));
            }
        }
        return $page_ids;
	}
}

/**
 * Room Contents.
 *
 * Hotel Paradise getting room section data.
 *
 * @since 1.1
 *
 * @return array.
 */
if ( ! function_exists( 'hotel_paradise_get_section_room_data' ) ) {
	
	function hotel_paradise_get_section_room_data(){
		$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
		$rooms = $option['room_s_content'];
		if (is_string($rooms)) {
            $rooms = json_decode($rooms, true);
        }
		$page_ids = array();
		if (!empty($rooms) && is_array($rooms)) {
            foreach ($rooms as $k => $v) {
                $page_ids[] = wp_parse_args($v, array(
					'image' => '',
					'title' => '',
					'desc' => '',
					'link' => '#',
				));
            }
        }
        return $page_ids;
	}
}

/**
 * Hotel Paradise home page sections priority.
 *
 * Hotel Paradise sections priority filter functions.
 *
 * @since 1.1
 *
 * @param integer $priority section priority number.
 * @param string $section section name.
 * @return array.
 */
if(!function_exists('hotel_paradise_section_priority_callback')):
	function hotel_paradise_section_priority_callback($priority,$section){
		$sections = array(
			'hotel_paradise_slider' => 1,
			'hotel_paradise_service' => 2,
			'hotel_paradise_room' => 3,
			'hotel_paradise_blog' => 4,
			'hotel_paradise_contact' => 5,
		);
		return $sections[$section];
	}
endif;
add_filter('hotel_paradise_section_priority','hotel_paradise_section_priority_callback',1,2);