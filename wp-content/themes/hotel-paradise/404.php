<?php 
/*
 * The 404 Page Template File
 */
get_header(); ?>
<div class="page_404">	
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<h2 class="error_title_404"><?php esc_html_e('404','hotel-paradise'); ?></h2>
				<h2 class="error_sub_title"><?php esc_html_e('OOPS, WE CAN`T FIND THAT PAGE!','hotel-paradise'); ?></h2>
				<P class="error_desc"><?php esc_html_e('The page you are looking for can`t be found. Go home by click on below button.','hotel-paradise'); ?></P>
				<a class="error_button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','hotel-paradise'); ?></a>
			</div>
		</div>
	</div>
</div><!-- End 404 Page -->
<?php get_footer(); ?>