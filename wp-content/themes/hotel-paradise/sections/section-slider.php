<?php 
$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );

$_images = $option['hero_media'];
if (is_string($_images)) {
	$_images = json_decode($_images, true);
}

if ( empty( $_images ) || !is_array( $_images ) ) {
    $_images = array();
}

$images = array();

foreach ( $_images as $m ) {
	$m  = wp_parse_args( $m, array('image' => '' ) );
	$_u = hotel_paradise_get_media_url( $m['image'] );
	if ( $_u ) {
		$images[] = $_u;
	}
}

if ( empty( $images ) ){
	$images = array( get_template_directory_uri().'/images/slide2.jpg' );
}

$animation_type = '';
if($option['hero_animation_type']=='fade'){
	$animation_type = 'fade';
}else if($option['hero_animation_type']=='vertical'){
	$animation_type = 'vertical';
}

if( !$option['hero_section_hide'] ):
?>
<div class="home-slider">
	<div id="bigsection" class="carousel slide carousel-<?php echo esc_attr($animation_type); ?>" data-ride="carousel" data-interval="<?php echo esc_attr($option['hero_speed']); ?>">
		<?php if( count($images) > 1 ){ ?>
		<?php $i = 1; ?>
		<ol class="carousel-indicators">
		<?php foreach($images as $index => $image){ ?>
		 
			<li data-target="#bigsection" data-slide-to="<?php echo esc_attr( $index ); ?>" class="<?php if( $i == 1 ){ echo 'active'; } $i++; ?>"></li>		  
		
		<?php } ?>
		</ol>
		<?php } ?>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
		
		<?php $i = 1; ?>
		<?php foreach($images as $image){ ?>
		<div class="item <?php if( $i == 1 ){ echo 'active'; } $i++; ?>">
		  <img class="animated pulse" src="<?php echo esc_url($image); ?>" alt="slide">
		  <div class="slider_overlay">
			  <div class="slider_overlay_inner">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
						
							<?php if(!empty( $option['hero_largetext'] )){ ?>
							<h2 class="slide_title animated <?php echo esc_attr( $option['hero_large_effect'] ); ?>"><?php echo wp_kses_post( $option['hero_largetext'] ); ?></h2>
							<?php } ?>
							
							<?php if(!empty( $option['hero_smalltext'] )){ ?>
							<p class="slide_desc animated <?php echo esc_attr( $option['hero_small_effect'] ); ?>"><?php echo wp_kses_post( $option['hero_smalltext'] ); ?></p>
							<?php } ?>
							
							<?php if(!empty( $option['hero_btn_link'] )){ ?>
							<a class="slide-btn animated <?php echo esc_attr( $option['hero_btn_effect'] ); ?>" href="<?php echo esc_url( $option['hero_btn_link'] ); ?>"><?php echo wp_kses_post( $option['hero_btn_text'] ); ?></a>
							<?php } ?>
						</div>
					</div>
				</div>
			  </div>
		  </div>
		</div>
		<?php } ?>

	  </div>		
	  <?php if( count($images) > 1 ){ ?>
	  <!-- Left and right controls -->
	  <a class="left carousel-control" href="#bigsection" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
		<span class="sr-only"><?php esc_html_e('Previous','hotel-paradise'); ?></span>
	  </a>
	  <a class="right carousel-control" href="#bigsection" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
		<span class="sr-only"><?php esc_html_e('Next','hotel-paradise'); ?></span>
	  </a>
	  <?php } ?>
	</div>
</div><!-- End home-slider -->
<?php endif; ?>