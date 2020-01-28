<?php 
/**
 * Template part for displaying page content
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('animated wow fadeInUp hotel_blog'); ?>>
	
	<?php if( has_post_thumbnail() ){ ?>
	<div class="blog_thumbnial">
		<?php 
		the_post_thumbnail('hotel-paradise-featured-image');
		
		hotel_paradise_post_image_meta();
		?>		
	</div>
	<?php } ?>
	
	<header class="entry-header">
		<?php 
		if ( is_single() ) {
			the_title( '<h2 class="entry-title">', '</h2>' );
		}
		?>
	</header>
	
	<?php hotel_paradise_post_footer(); ?>
	
	<div class="entry-content">
		<?php
		the_content();

			wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'hotel-paradise' ),
			'after'  => '</div>',
		) );
		?>
	</div>
</article><!-- end page -->