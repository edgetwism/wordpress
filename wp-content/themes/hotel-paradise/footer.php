<?php 
$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() ); ?>
	<div class="site-footer">		
		<div class="footer-widgets">
			<div class="container">
				<div class="row">			
					<?php if( is_active_sidebar('footer-1') ){ ?>
					<div class="col-md-3 col-sm-6">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
					<?php }else{ ?>
						<div class="col-md-3 col-sm-6">
						<?php the_widget('WP_Widget_Tag_Cloud', 'title=Tags', 'before_title=<h2 class="widget-title">&after_title=</h2>'); ?>
						</div>
					<?php } ?>
					
					<?php if( is_active_sidebar('footer-2') ){ ?>
					<div class="col-md-3 col-sm-6">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
					<?php }else{ ?>
						<div class="col-md-3 col-sm-6">
						<?php the_widget('WP_Widget_Categories', 'title=Categories&number=4', 'before_title=<h2 class="widget-title">&after_title=</h2>'); ?>
						</div>
					<?php } ?>
					
					<?php if( is_active_sidebar('footer-3') ){ ?>
					<div class="col-md-3 col-sm-6">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
					<?php }else{ ?>
						<div class="col-md-3 col-sm-6">
						<?php the_widget('WP_Widget_Recent_Comments', 'title=Resent Comments&number=4', 'before_title=<h2 class="widget-title">&after_title=</h2>'); ?>
						</div>
					<?php } ?>
					
					<?php if( is_active_sidebar('footer-4') ){ ?>
					<div class="col-md-3 col-sm-6">
						<?php dynamic_sidebar('footer-4'); ?>
					</div>
					<?php }else{ ?>
						<div class="col-md-3 col-sm-6">
						<?php the_widget('WP_Widget_Recent_Posts', 'title=Latest Posts&number=4', 'before_title=<h2 class="widget-title">&after_title=</h2>'); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div><!-- End footer-widgets -->
		
		<?php do_action('hotel_paradise_copyright'); ?>
		
	</div>
	<!-- End footer -->	
</div>
<?php wp_footer(); ?>
</body>
</html>