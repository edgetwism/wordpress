<?php
/**
 * Template part for displaying gallery posts
 *
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('animated wow fadeInUp hotel_blog'); ?>>
	
	<?php 
	if( ! get_post_gallery() ){ 
		hotel_paradise_featured_image();
	} 
	?>
	
	<header class="entry-header">
		<?php 
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header>
	
	<?php hotel_paradise_post_footer(); ?>
	
	<div class="entry-content">
		<?php
		if ( ! is_single() ) {
			if ( get_post_gallery() ) {
				echo '<div class="entry-gallery">';
					echo wp_kses_post(get_post_gallery());
				echo '</div>';
			};

		};
		
		if ( is_single() || ! get_post_gallery() ) {
			
			the_content( sprintf(
				__( '<span>Read More</span>', 'hotel-paradise' )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'hotel-paradise' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		}
		?>
	</div>
</article><!-- end post -->