<?php 
/*
 * Template Name: About Page
 *
 */
get_header(); 
$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() ); 
hotel_paradise_breadcrumbs();
?>
<div class="about_page">	
	<div class="container">
		<div class="row">
			<?php 
			$post_id = intval( $option['ap_section_contents'] );
			$post_id = apply_filters( 'wpml_object_id', $post_id, 'page', true );
			$post = get_post( $post_id );
			?>
			<div class="animated wow fadeInLeft col-md-<?php if( get_the_post_thumbnail( $post, 'full' ) ){ echo '6'; }else{ echo '12'; } ?>">
				
				<?php if( !empty( $option['ap_section_title'] ) ){ ?>
				<h2><?php echo wp_kses_post( $option['ap_section_title'] ); ?></h1>
				<?php } ?>
				
				<?php			
				$content = apply_filters( 'the_content', $post->post_content );
					$content = str_replace( ']]>', ']]&gt;', $content );
					echo wp_kses_post( $content );
				?>
			</div>
			
			<?php if( get_the_post_thumbnail( $post, 'full' ) ){ ?>
			<div class="col-md-6 animated wow fadeInRight">				
				<a href="<?php echo esc_url( get_permalink( $post )  ); ?>">
				<?php echo get_the_post_thumbnail( $post, 'full' ); ?>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</div><!-- End About Page -->
<?php get_footer(); ?>