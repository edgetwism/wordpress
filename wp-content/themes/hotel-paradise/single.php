<?php 
/*
 * The Blog Detail Page File
 */
get_header();
hotel_paradise_breadcrumbs(); 
$layout = hotel_paradise_get_layout();
$col = '8';
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	$layout = 'none';
}
if($layout=='none'){
	$col = '12';
}
?>
<div class="site-content-contain">
	<div class="site-content">
		<div class="container">
			<div class="row">
				
				<?php 
				if ( $layout != 'none' && $layout=='left' ) {
					get_sidebar(); 
				} 
				?>
				
				<div id="primary" class="col-md-<?php echo esc_attr( $col ); ?> col-sm-<?php echo esc_attr( $col ); ?> content-area">	
					<div id="main" class="site-main" role="main">
						
						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/post/content', get_post_format() );

								endwhile;
								
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								the_posts_pagination( array(
									'prev_text' => '<i class="fa fa-angle-double-left"></i>',
									'next_text' => '<i class="fa fa-angle-double-right"></i>',
								) );

							else :

								get_template_part( 'template-parts/post/content', 'none' );

							endif;
							?>

					</div>
				</div>
				
				<?php 
				if ( $layout != 'none' && $layout=='right' ) {
					get_sidebar(); 
				} 
				?>		
			</div>
		</div>
	</div>
</div><!-- End site-content-contain -->
<?php get_footer(); ?>