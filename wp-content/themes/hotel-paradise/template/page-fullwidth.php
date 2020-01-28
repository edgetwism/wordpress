<?php 
/*
 * Template Name: Page Full Width
 */
get_header();
hotel_paradise_breadcrumbs();  
?>
<div class="site-content-contain">
	<div class="site-content">
		<div class="container">
			<div class="row">	
				
				<div id="primary" class="col-md-12 content-area">	
					<div id="main" class="site-main" role="main">
						
						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/post/content', 'page' );

								endwhile;
								
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							else :

								get_template_part( 'template-parts/post/content', 'none' );

							endif;
							?>

					</div>
				</div>
				
			</div>
		</div>
	</div>
</div><!-- End site-content-contain -->
<?php get_footer(); ?>