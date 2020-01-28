<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('animated wow fadeInUp hotel_blog'); ?>>
	<header class="entry-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'hotel-paradise' ); ?></h1>
	</header>
	
	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php 
			/* translators: %s: search term */
			$page_title = sprintf(
				__( 'Search Results for: %s', 'hotel-paradise' ),
				'<span>' . get_search_query() . '</span>'
			);
			?>
			<p><?php echo esc_html( $page_title ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'hotel-paradise' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</article>