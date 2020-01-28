<?php 
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
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
						
						<header class="page-header">
							<?php if ( have_posts() ) : ?>
								<h1 class="page-title"><?php printf( sprintf( esc_html__( 'Search Results for: <span>%s</span>', 'hotel-paradise' ), esc_html( get_search_query() ) ) ); ?></h1>
							<?php else : ?>
								<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'hotel-paradise' ); ?></h1>
							<?php endif; ?>
						</header><!-- .page-header -->
				
						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/post/content', get_post_format() );

								endwhile;

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
</div>
<!-- End site-content-contain -->
<?php get_footer(); ?>