<?php 
/**
 * This template for displaying comments
 *
 */
 
hotel_paradise_author_detail();

 if ( post_password_required() ) {
	return;
}

$discussion = hotel_paradise_get_discussion_data();
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			if ( comments_open() ) {
				if ( have_comments() ) {
					esc_html_e( 'Join the Conversation', 'hotel-paradise' );
				} else {
					esc_html_e( 'Leave a comment', 'hotel-paradise' );
				}
			} else {
				if ( '1' == $discussion->responses ) {
					/* translators: %s: post title */
					printf( esc_html__( 'One reply on &ldquo;%s&rdquo;', 'hotel-paradise' ), esc_html( get_the_title() ) );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						esc_html__(
						'%1$s replies on &ldquo;%2$s&rdquo;',
						'hotel-paradise'
						),
						intval( number_format_i18n( $discussion->responses ) ),
						esc_html( get_the_title() )
					);
				}
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol>

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'hotel-paradise' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h3 id="comments-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3>',
		) );
	?>
</div><!-- .comments-area -->