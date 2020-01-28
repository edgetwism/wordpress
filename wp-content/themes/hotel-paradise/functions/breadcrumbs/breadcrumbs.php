<?php
if( !function_exists('hotel_paradise_breadcrumbs') ){
	function hotel_paradise_breadcrumbs(){ 
	
	$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );
	
	global $post;
	
	if( $option['subheader_hide'] == false ){
		
		$class = '';
		if(get_header_image()==''){
			$class = 'no_header_image';
		}
	?>
	<div class="sub-header <?php echo esc_attr( $class ); ?>" style="background-image:url('<?php echo esc_url( get_header_image() ); ?>');">
		<div class="section_overlay">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-<?php echo esc_attr( $option['subheader_align'] ); ?>">
						<?php 
						if( function_exists('bcn_display') ){
							bcn_display(); 
						}else{
							if(is_archive()){
								the_archive_title( '<h1 class="sub-header-title">', '</h1>' );
							}elseif(is_search()){
								printf( sprintf( esc_html__( '<h1 class="sub-header-title">Search Results for: %s</h1>', 'hotel-paradise' ), esc_html( get_search_query() ) ) );
							}else{
								echo '<h1 class="sub-header-title">' . esc_html( get_the_title() ) . '</h1>';
							}						 
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- End sub header -->
	<?php } ?>
	
	<div class="seprator-box" style="background-image:url('<?php echo esc_url( get_theme_file_uri('images/shadow.png'));?>');"></div>
	<?php }
}