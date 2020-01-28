<?php
/**
 * Template part for displaying room content
 *
 */

$meta = get_post_meta($post->ID,'room_meta',TRUE);
$meta = wp_parse_args($meta,array(
	'persons' => 0,
	'currency' => '$',
	'price' => '300',
	'unit' => 'Per Night',
	'btntext' => 'Book Now',
	'btnurl' => '',
));
$persons = isset( $meta['persons'] ) ? $meta['persons'] : 0 ;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('animated wow fadeInUp card_room'); ?>>
	
	<div class="room_inner">					
		<?php if( has_post_thumbnail() ){ ?>
		<div class="room_thumbnail">
			<a title="<?php the_title(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
			<div class="room_overlay">
				<div class="room_overlay_inner text-center">
					<a class="room_overlay_icon" href="#"><i class="fa fa-eye"></i></a>
				</div>
			</div>
			
			<?php 
			if( $persons > 0 ){ 
			echo '<div class="room_occupacy">';
				for($i=1;$i<=$persons;$i++){
					echo '<i class="fa fa-male"></i>';
				}
			echo '</div>';
			} 
			?>
		</div>
		<?php } ?>
		
		<a class="room_title" title="<?php the_title(); ?>">
			<h3><?php the_title(); ?></h3>
		</a>
		
		<div class="room_content">
			<?php the_content(); ?>
		</div>
		
		<p class="room-regular-price">
			<span class="room-price"><span class="room-currency"><?php echo esc_html( $meta['currency'] ); ?></span> <?php echo esc_html( $meta['price'] ); ?> </span>
			<span class="room-price-suffix"> / <?php echo esc_html( $meta['unit'] ); ?></span>
		</p>
	</div>
</article><!-- End Room -->