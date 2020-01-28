<?php
/**
 * Template part for displaying audio posts
 *
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('animated wow fadeInUp hotel_blog'); ?>>
	
	<?php hotel_paradise_featured_image(); ?>
	
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
	
	<?php
		$content = apply_filters( 'the_content', get_the_content() );
		$audio = false;

		// Only get audio from the content if a playlist isn't present.
		if ( false === strpos( $content, 'wp-playlist-script' ) ) {
			$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
		}

	?>
	
	<div class="entry-content">
		<?php
		if ( ! is_single() ) {

			// If not a single post, highlight the audio file.
			if ( ! empty( $audio ) ) {
				foreach ( $audio as $audio_html ) {
					echo '<div class="entry-audio">';
						echo wp_kses_post( $audio_html );
					echo '</div><!-- .entry-audio -->';
				}
			};

		};

		if ( is_single() || empty( $audio ) ) {

			the_content( sprintf(
				__( '<span>Read More</span>', 'hotel-paradise' )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'hotel-paradise' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );

		};
		?>
	</div>
</article><!-- end post -->