<?php 
$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );


$class = '';
if(empty($option['blog_s_bgimage'])){
	$class = 'noneimage-padding';
}else{
	$class = 'has_section_image';
}

$cat = absint( $option['blog_s_cat'] );
$orderby = sanitize_text_field( $option['blog_s_orderby'] );
$order = sanitize_text_field( $option['blog_s_order'] );

if( !$option['blog_s_hide'] ): ?>
<div class="blog_wrap <?php echo esc_attr( $class ); ?>" style="background-color:<?php echo esc_attr($option['blog_s_bgcolor']); ?>;background-image:url('<?php echo esc_attr($option['blog_s_bgimage']); ?>');">
	
	<?php if(!empty($option['blog_s_bgimage'])){ ?>
	<div class="section-overlay">
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center section_header">
				<?php if( !empty( $option['blog_s_title'] ) ){ ?>
				<h2 class="wow animated fadeIn"><?php echo wp_kses_post( $option['blog_s_title'] ); ?></h2>
				<?php } ?>
				
				<?php if( !empty( $option['blog_s_subtitle'] ) ){ ?>
				<p class="wow animated fadeIn"><?php echo wp_kses_post( $option['blog_s_subtitle'] ); ?></p>
				<?php } ?>
			</div>
		</div>
		
		<div class="row">
			
			<?php 
			$totalShow = $option['blog_s_noofshow'];
			$args = array(
					'post_type' => 'post',
					'posts_per_page' => $totalShow,
				);
			
			if ( $cat > 0 ) {
						$args['category__in'] = array( $cat );
					}
								
					if ( $orderby && $orderby != 'default' ) {
						$args['orderby'] = $orderby;
					}

					if ( $order) {
						$args['order'] = $order;
					}
					
			$query = new WP_Query( $args );
			?>
			
			<div id="news_slider" class="carousel slide news_slider" data-ride="carousel">
				<div class="carousel-inner">
					
					<?php if ( $query->have_posts() ) : ?>
					<?php 
					$i=1;
					while ( $query->have_posts() ) : $query->the_post(); 
					?>
					<div class="item <?php if($i==1){ echo 'active'; } $i++; ?>">
						<div class="col-md-3 col-sm-3 card-blog">
							<div class="card-blog-inner">
								<?php if( has_post_thumbnail() ){ ?>
								<div class="blogThumb">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
										<div class="news_overlay"></div>
									</a>
								</div>
								<?php } ?>
								
								<div class="blogContent text-center">
									<a class="blogTitle" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
									
									<?php 
									$more = '... <p><a class="more-link" href="'.esc_url( get_the_permalink() ).'"><span>'.esc_html__('Read More','hotel-paradise').'</span></a></p>';
									$content =  apply_filters( 'the_content', wp_trim_words( get_the_content(), 13, $more ) ); 

									echo wp_kses_post( $content );
									?>					
									
								</div>
							</div>
						</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>	
					
				</div>
				
				<?php if ( $query->post_count > 1 ) : ?>
				<!-- Left and right controls -->
				  <a class="left carousel-control" href="#news_slider" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only"><?php esc_html_e('Previous','hotel-paradise'); ?></span>
				  </a>
				  <a class="right carousel-control" href="#news_slider" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only"><?php esc_html_e('Next','hotel-paradise'); ?></span>
				  </a>
				  <?php endif; ?>
			</div>
			
		</div>
		
	</div>
	
	<?php if(!empty($option['blog_s_bgimage'])){ ?>
	</div>
	<?php } ?>
	
</div><!-- End Blog -->
<?php endif; ?>