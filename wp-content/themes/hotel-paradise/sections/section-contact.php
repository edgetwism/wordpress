<?php 
$option = wp_parse_args(  get_option( 'hotel_paradise_option', array() ), hotel_paradise_data() );

if( !$option['contact_s_hide'] ): ?>
<div class="contact_wrap animated wow fadeInUp">
	<div class="container-fluid">	
		<div class="row">
			
			<?php if( $option['contact_s_address'] != '' ){ ?>
			<div class="col-md-4 col-sm-4 cont_column text-center">
				<i class="fa fa-map-marker"></i>
				<h3><?php esc_html_e('Address','hotel-paradise'); ?></h3>
				<p><?php echo wp_kses_post( $option['contact_s_address'] ); ?></p>
			</div>
			<?php } ?>
			
			<?php if( $option['contact_s_phone'] != '' ){ ?>
			<div class="col-md-4 col-sm-4 cont_column contact_center text-center">
				<i class="fa fa-phone"></i>
				<h3><?php esc_html_e('Phone','hotel-paradise'); ?></h3>
				<p><?php echo wp_kses_post( $option['contact_s_phone'] ); ?></p>
			</div>
			<?php } ?>
			
			<?php if( $option['contact_s_email'] != '' ){ ?>
			<div class="col-md-4 col-sm-4 cont_column contact_right text-center">
				<i class="fa fa-envelope"></i>
				<h3><?php esc_html_e('Email','hotel-paradise'); ?></h3>
				<p><?php echo wp_kses_post( $option['contact_s_email'] ); ?></p>
			</div>
			<?php } ?>
		</div>
	</div>
</div><!-- End contact -->
<?php endif; ?>