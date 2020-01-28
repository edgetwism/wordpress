<?php
class hotel_paradise_dashboard {
	public function __construct() {
		add_action('admin_menu', array( $this, 'hotel_paradise_about' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'hotel_paradise_admin_scripts' ) );
		
		add_action( 'admin_init', array( $this, 'hotel_paradise_admin_dismiss_actions' ) );
		
		add_action('switch_theme', array( $this, 'hotel_paradise_reset_recommended_actions' ));
		
		add_action( 'load-themes.php',  array( $this, 'hotel_paradise_one_activation_admin_notice' )  );
	}
	function hotel_paradise_one_activation_admin_notice(){
		global $pagenow;
		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'hotel_paradise_admin_notice' ) );
			add_action( 'admin_notices', array( $this, 'hotel_paradise_admin_import_notice' ) );
		}
	}
	function hotel_paradise_admin_notice() {
		if ( ! function_exists( 'hotel_paradise_get_recommended_actions' ) ) {
			return false;
		}
		$actions = hotel_paradise_get_recommended_actions();
		$number_action = $actions['number_notice'];

		if ( $number_action > 0 ) {
			$theme = wp_get_theme();
			?>
			<div class="updated notice notice-success notice-alt is-dismissible">
				<p><?php printf( esc_html__( 'Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'hotel-paradise' ),  
					esc_html( $theme->Name ), 
					esc_url( admin_url( 'themes.php?page=wd_themepage' ) ) 
					); ?></p>
			</div>
			<?php
		}
	}

	function hotel_paradise_admin_import_notice(){
		?>
		<div class="updated notice notice-success notice-alt is-dismissible">
			<p><?php printf( esc_html__( 'Save time by import our demo data, your website will be set up and ready to customize in minutes. %s', 'hotel-paradise' ), '<a class="button button-secondary" href="'.esc_url( add_query_arg( array( 'page' => 'wd_themepage&tab=demo-data-importer' ), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Import Demo Data', 'hotel-paradise' ).'</a>'  ); ?></p>
		</div>
		<?php
	}
	public function hotel_paradise_reset_recommended_actions () {
		delete_option('hotel_paradise_actions_dismiss');
	}
	function hotel_paradise_admin_dismiss_actions(){
		// Action for dismiss
		if ( isset( $_GET['hotel_paradise_action_notice'] ) ) {
			$actions_dismiss =  get_option( 'hotel_paradise_actions_dismiss' );
			if ( ! is_array( $actions_dismiss ) ) {
				$actions_dismiss = array();
			}
			$action_key = sanitize_text_field( wp_unslash( $_GET['hotel_paradise_action_notice'] ) );
			if ( isset( $actions_dismiss[ $action_key ] ) &&  $actions_dismiss[ $action_key ] == 'hide' ){
				$actions_dismiss[ $action_key ] = 'show';
			} else {
				$actions_dismiss[ $action_key ] = 'hide';
			}
			update_option( 'hotel_paradise_actions_dismiss', $actions_dismiss );

			if(isset($_SERVER['REQUEST_URI'])){
				$url = esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) );
				$url = remove_query_arg( 'hotel_paradise_action_notice', $url );
				wp_redirect( $url );
			}		
			die();
		}

	}
	public function hotel_paradise_admin_scripts( $hook ){
		
		if ( $hook === 'appearance_page_wd_themepage'  ) {
			
            wp_enqueue_style( 'hotel_paradise-admin-css', get_template_directory_uri() . '/functions/about-screen/css/dashboard.css' );

            wp_enqueue_style( 'plugin-install' );
            wp_enqueue_script( 'plugin-install' );
            wp_enqueue_script( 'updates' );
            add_thickbox();
			
			wp_enqueue_script( 'hotel_paradise-plugin-install-helper', get_template_directory_uri() . '/functions/install/js/install.js', array( 'jquery' ) );
			wp_localize_script(
				'hotel_paradise-plugin-install-helper', 'hotel_paradise_plugin_helper',
				array(
					'activating' => esc_html__( 'Activating ', 'hotel-paradise' ),
				)
			);
			wp_localize_script(
				'hotel_paradise-plugin-install-helper', 'pagenow',
				array( 'import' )
			);
        }
	}
	
	public function hotel_paradise_about(){
		
		$recommended_actions = $this->hotel_paradise_get_recommended_actions();
		
		$number_count = $recommended_actions['number_notice'];

		if ( $number_count > 0 ){
			
			$update_label = sprintf( _n( '%1$s action required', '%1$s actions required', $number_count, 'hotel-paradise' ), $number_count );
			
			$count = "<span class='update-plugins count-".esc_attr( $number_count )."' title='".esc_attr( $update_label )."'><span class='update-count'>" . number_format_i18n($number_count) . "</span></span>";
			
			$menu_title = sprintf( esc_html__('Hotel Paradise %s', 'hotel-paradise'), $count );
			
		} else {
			
			$menu_title = esc_html__('Hotel Paradise Theme', 'hotel-paradise');
		}

		add_theme_page( 
			esc_html__( 'Hotel Paradise Dashboard', 'hotel-paradise' ), 
			$menu_title, 
			'edit_theme_options', 
			'wd_themepage', 
			array($this,'hotel_paradise_theme_about_page')
			);
	}
	
	public function hotel_paradise_theme_about_page(){
		$theme = wp_get_theme('hotel-paradise');
		
		if ( isset( $_GET['hotel_paradise_action_dismiss'] ) ) {
			$actions_dismiss =  get_option( 'hotel_paradise_actions_dismiss' );
			if ( ! is_array( $actions_dismiss ) ) {
				$actions_dismiss = array();
			}
			$actions_dismiss[ sanitize_text_field( wp_unslash( $_GET['hotel_paradise_action_dismiss'] ) ) ] = 'dismiss';
			update_option( 'hotel_paradise_actions_dismiss', $actions_dismiss );
		}
		
		$tab = null;
		if ( isset( $_GET['tab'] ) ) {
			$tab = sanitize_text_field( wp_unslash( $_GET['tab']) );
		} else {
			$tab = null;
		}
		
		$actions_r = $this->hotel_paradise_get_recommended_actions();
		$number_action = $actions_r['number_notice'];
		$actions = $actions_r['actions'];

		$current_action_link =  admin_url( 'themes.php?page=wd_themepage&tab=recommended_actions' );

		$recommend_plugins = get_theme_support( 'recommend-plugins' );
		if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
			$recommend_plugins = $recommend_plugins[0];
		} else {
			$recommend_plugins[] = array();
		}
		?>
		<div class="wrap about-wrap themepage_wrapper">
		
			<h1>
				<?php printf( esc_html__('Hotel Paradise Lite Theme', 'hotel-paradise') ); ?>
			</h1>
			
			<div class="about-text">
				<?php esc_html_e( 'Hotel Paradise is business theme for hotel and restaurant. This theme has by default green color layout.', 'hotel-paradise' ); ?>
			</div>
			
			<a target="_blank" href="<?php echo esc_url('https://www.redfoxthemes.com/'); ?>" class="redfoxthemes-badge wp-badge"><span><?php esc_html_e('RedFox','hotel-paradise'); ?></span></a>
			
			<hr class="wp-header-end">
			
			<h2 class="nav-tab-wrapper">
			
				<a href="?page=wd_themepage" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Hotel Paradise', 'hotel-paradise' ) ?></a>
				
				<a href="?page=wd_themepage&tab=recommended_actions" class="nav-tab<?php echo $tab == 'recommended_actions' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Recommended Actions', 'hotel-paradise' ); echo ( $number_action > 0 ) ? "<span class='theme-action-count'>".intval($number_action)."</span>" : ''; ?></a>
				
				<a href="?page=wd_themepage&tab=demo-data-importer" class="nav-tab<?php echo $tab == 'demo-data-importer' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'One Click Demo Import', 'hotel-paradise' ); ?></span></a>
			</h2>
			
			<?php if ( is_null( $tab ) ) { ?>
				<div class="themepage_info info-tab-content">
					<div class="themepage_info_column clearfix">
						<div class="themepage_info_left">

							<div class="themepage_link">
								<h3><?php esc_html_e( 'Customizer Settings', 'hotel-paradise' ); ?></h3>
								<p class="about"><?php printf(esc_html__('%s has customizer option panel settings. Manage your site contents by clicking on bottom customize button.', 'hotel-paradise'), esc_html($theme->Name)); ?></p>
								<p>
									<a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary"><?php esc_html_e('Customize Your Theme', 'hotel-paradise'); ?></a>
								</p>
							</div>
							<div class="themepage_link">
								<h3><?php esc_html_e( 'Theme Documentation', 'hotel-paradise' ); ?></h3>
								<p class="about"><?php printf(esc_html__('Need to setup your %s WordPress theme? Please click on bottom documentation button.', 'hotel-paradise'), esc_html($theme->Name)); ?></p>
								<p>
									<a href="<?php echo esc_url( 'https://redfoxthemes.com/documentation/theme/hotel-paradise-pro/' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Documentation', 'hotel-paradise'); ?></a>
								</p>
								<?php do_action( 'hotel_paradise_dashboard_theme_links' ); ?>
							</div>
							<div class="themepage_link">
								<h3><?php esc_html_e( 'Support?', 'hotel-paradise' ); ?></h3>
								<p class="about"><?php printf(esc_html__('If you have more queries with %s WordPress theme. Click on Create a Ticket button.', 'hotel-paradise'), esc_html($theme->Name)); ?></p>
								<p>
									<a href="<?php echo esc_url('https://wordpress.org/support/theme/hotel-paradise' ); ?>" target="_blank" class="button button-secondary"><?php echo sprintf( esc_html__('Create a ticket', 'hotel-paradise'), esc_html($theme->Name)); ?></a>
								</p>
							</div>
						</div>

						<div class="themepage_info_right">
							<img src="<?php echo esc_url(get_template_directory_uri() ); ?>/screenshot.png" alt="Hotel Paradise Theme Screen" />
						</div>
					</div>
				</div><!-- tab 1 -->
			<?php } ?>
			
			<?php if ( $tab == 'recommended_actions' ) { ?>
				<div class="action-required-tab info-tab-content">

					<?php if ( $actions_r['number_active']  > 0 ) { ?>
					
						<?php 
						$actions = wp_parse_args( 
							$actions, 
							array( 
							'page_on_front' => '', 
							'page_template' ) 
							);
						?>

						<?php if ( $actions['recommend_plugins'] == 'active' ) {  ?>
							<div id="plugin-filter" class="recommend-plugins action-required">
								<a  title="" class="dismiss" href="<?php echo esc_url(add_query_arg( array( 'hotel_paradise_action_notice' => 'recommend_plugins' ), $current_action_link )); ?>">
									<?php if ( $actions_r['hide_by_click']['recommend_plugins'] == 'hide' ) { ?>
										<span class="dashicons dashicons-hidden"></span>
									<?php } else { ?>
										<span class="dashicons  dashicons-visibility"></span>
									<?php } ?>
								</a>
								<h3><?php esc_html_e( 'Recommend Plugins', 'hotel-paradise' ); ?></h3>
								<?php
								$this->hotel_paradise_render_recommend_plugins( $recommend_plugins );
								?>
							</div>
						<?php } ?>


						<?php if ( $actions['page_on_front'] == 'active' ) {  ?>
							<div class="theme_link  action-required">
								<a title="<?php  esc_attr_e( 'Dismiss', 'hotel-paradise' ); ?>" class="dismiss" href="<?php echo esc_url(add_query_arg( array( 'hotel_paradise_action_notice' => 'page_on_front' ), $current_action_link )); ?>">
									<?php if ( $actions_r['hide_by_click']['page_on_front'] == 'hide' ) { ?>
										<span class="dashicons dashicons-hidden"></span>
									<?php } else { ?>
										<span class="dashicons  dashicons-visibility"></span>
									<?php } ?>
								</a>
								<h3><?php esc_html_e( 'Switch "Front page displays" to "A static page"', 'hotel-paradise' ); ?></h3>
								<div class="about">
									<p><?php esc_html_e( 'In order to have the one page look for your website, please go to Customize -&gt; Static Front Page and switch "Front page displays" to "A static page".', 'hotel-paradise' ); ?></p>
								</div>
								<p>
									<a  href="<?php echo esc_url(admin_url('options-reading.php')); ?>" class="button"><?php esc_html_e('Setup front page displays', 'hotel-paradise'); ?></a>
								</p>
							</div>
						<?php } ?>

						<?php if ( $actions['page_template'] == 'active' ) {  ?>
							<div class="theme_link  action-required">
								<a  title="<?php  esc_attr_e( 'Dismiss', 'hotel-paradise' ); ?>" class="dismiss" href="<?php echo esc_url(add_query_arg( array( 'hotel_paradise_action_notice' => 'page_template' ), $current_action_link )); ?>">
									<?php if ( $actions_r['hide_by_click']['page_template'] == 'hide' ) { ?>
										<span class="dashicons dashicons-hidden"></span>
									<?php } else { ?>
										<span class="dashicons  dashicons-visibility"></span>
									<?php } ?>
								</a>
								<h3><?php esc_html_e( 'Set your homepage page template to "Frontpage".', 'hotel-paradise' ); ?></h3>

								<div class="about">
									<p><?php esc_html_e( 'In order to change homepage section contents, you will need to set template "Frontpage" for your homepage.', 'hotel-paradise' ); ?></p>
								</div>
								<p>
									<?php
									$front_page = get_option( 'page_on_front' );
									if ( $front_page <= 0  ) {
										?>
										<a  href="<?php echo esc_url(admin_url('options-reading.php')); ?>" class="button"><?php esc_html_e('Setup front page displays', 'hotel-paradise'); ?></a>
										<?php

									}

									if ( $front_page > 0 && get_post_meta( $front_page, '_wp_page_template', true ) != 'template-frontpage.php' ) {
										?>
										<a href="<?php echo esc_url(get_edit_post_link( $front_page )); ?>" class="button"><?php esc_html_e('Change homepage page template', 'hotel-paradise'); ?></a>
										<?php
									}
									?>
								</p>
							</div>
						<?php } ?>
						
					<?php  } else { ?>
					
						<h3><?php  printf( esc_html__( 'Keep %s updated', 'hotel-paradise' ) , esc_html( $theme->Name ) ); ?></h3>
						
						<p><?php esc_attr_e( 'Hey! There are no required actions found.', 'hotel-paradise' ); ?></p>
						
					<?php } ?>
					
				</div><!-- tab 2 -->
				
			<?php } ?>
				
			<?php if ( $tab == 'demo-data-importer' ) { ?>
				<div class="demo-import-tab-content info-tab-content">
				
					<?php if ( class_exists('OCDI_Plugin') ) {?>
					
						<div id="plugin-filter" class="demo-import-boxed">
						<?php printf(
						sprintf(__( '<p>Congratulations! you installed importer plugin successfully. Click Here to start <a href="%s">Import Data</a></p>','hotel-paradise' ), 
						esc_url( admin_url('themes.php?page=pt-one-click-demo-import') )
						)); ?>
						</div>
						
					<?php } else { ?>
						<div id="plugin-filter" class="demo-import-boxed">
							<?php
							$plugin_name = 'one-click-demo-import';
							$status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_name );
							$button_class = 'install-now button';
							$button_txt = esc_html__( 'Install Now', 'hotel-paradise' );
							if ( ! $status ) {
								$install_url = wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'install-plugin',
											'plugin' => $plugin_name
										),
										network_admin_url( 'update.php' )
									),
									'install-plugin_'.$plugin_name
								);

							} else {
								$install_url = add_query_arg(array(
									'action' => 'activate',
									'plugin' => rawurlencode( $plugin_name . '/' . $plugin_name . '.php' ),
									'plugin_status' => 'all',
									'paged' => '1',
									'_wpnonce' => wp_create_nonce('activate-plugin_' . $plugin_name . '/' . $plugin_name . '.php'),
								), network_admin_url('plugins.php'));
								$button_class = 'activate-now button-primary';
								$button_txt = esc_html__( 'Active Now', 'hotel-paradise' );
							}

							$detail_link = add_query_arg(
								array(
									'tab' => 'plugin-information',
									'plugin' => $plugin_name,
									'TB_iframe' => 'true',
									'width' => '772',
									'height' => '349',

								),
								network_admin_url( 'plugin-install.php' )
							);

							echo '<p>';
							printf( esc_html__(
								'%1$s you will need to install and activate the %2$s plugin first.', 'hotel-paradise' ),
								'<b>'.esc_html__( 'Hey.', 'hotel-paradise' ).'</b>',
								'<a class="thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'Theme Demo Importer', 'hotel-paradise' ).'</a>'
							);
							echo '</p>';

							echo '<p class="plugin-card-'.esc_attr( $plugin_name ).'"><a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_name ).'" class="'.esc_attr( $button_class ).'">'.esc_html($button_txt).'</a></p>';

							?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		
		</div>
		<?php
	}
	
	public function hotel_paradise_get_recommended_actions( ) {

		$actions = array();
		$front_page = get_option( 'page_on_front' );
		$actions['page_on_front'] = 'dismiss';
		$actions['page_template'] = 'dismiss';
		$actions['recommend_plugins'] = 'dismiss';
		if ( 'page' != get_option( 'show_on_front' ) ) {
			$front_page = 0;
		}
		if ( $front_page <= 0  ) {
			$actions['page_on_front'] = 'active';
			$actions['page_template'] = 'active';
		} else {
			if ( get_post_meta( $front_page, '_wp_page_template', true ) == 'template-frontpage.php' ) {
				$actions['page_template'] = 'dismiss';
			} else {
				$actions['page_template'] = 'active';
			}
		}

		$recommend_plugins = get_theme_support( 'recommend-plugins' );
		if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
			$recommend_plugins = $recommend_plugins[0];
		} else {
			$recommend_plugins[] = array();
		}

		if ( ! empty( $recommend_plugins ) ) {

			foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
				$plugin_info = wp_parse_args( $plugin_info, array(
					'name' => '',
					'active_filename' => '',
				) );
				if ( $plugin_info['active_filename'] ) {
					$active_file_name = $plugin_info['active_filename'] ;
				} else {
					$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
				}
				if ( ! is_plugin_active( $active_file_name ) ) {
					$actions['recommend_plugins'] = 'active';
				}
			}

		}

		$actions = apply_filters( 'hotel_paradise_get_recommended_actions', $actions );
		$hide_by_click = get_option( 'hotel_paradise_actions_dismiss' );
		if ( ! is_array( $hide_by_click ) ) {
			$hide_by_click = array();
		}

		$n_active  = $n_dismiss = 0;
		$number_notice = 0;
		foreach ( $actions as $k => $v ) {
			if ( ! isset( $hide_by_click[ $k ] ) ) {
				$hide_by_click[ $k ] = false;
			}

			if ( $v == 'active' ) {
				$n_active ++ ;
				$number_notice ++ ;
				if ( $hide_by_click[ $k ] ) {
					if ( $hide_by_click[ $k ] == 'hide' ) {
						$number_notice -- ;
					}
				}
			} else if ( $v == 'dismiss' ) {
				$n_dismiss ++ ;
			}

		}

		$return = array(
			'actions' => $actions,
			'number_actions' => count( $actions ),
			'number_active' => $n_active,
			'number_dismiss' => $n_dismiss,
			'hide_by_click'  => $hide_by_click,
			'number_notice'  => $number_notice,
		);
		if ( $return['number_notice'] < 0 ) {
			$return['number_notice'] = 0;
		}

		return $return;
	}
	
	public function hotel_paradise_render_recommend_plugins( $recommend_plugins = array() ){
		foreach ( $recommend_plugins as $plugin_slug => $plugin_info ) {
			$plugin_info = wp_parse_args( $plugin_info, array(
				'name' => '',
				'active_filename' => '',
			) );
			$plugin_name = $plugin_info['name'];
			$status = is_dir( WP_PLUGIN_DIR . '/' . $plugin_slug );
			$button_class = 'install-now button';
			if ( $plugin_info['active_filename'] ) {
				$active_file_name = $plugin_info['active_filename'] ;
			} else {
				$active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
			}

			if ( ! is_plugin_active( $active_file_name ) ) {
				$button_txt = esc_html__( 'Install Now', 'hotel-paradise' );
				if ( ! $status ) {
					$install_url = wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $plugin_slug
							),
							network_admin_url( 'update.php' )
						),
						'install-plugin_'.$plugin_slug
					);

				} else {
					$install_url = add_query_arg(array(
						'action' => 'activate',
						'plugin' => rawurlencode( $active_file_name ),
						'plugin_status' => 'all',
						'paged' => '1',
						'_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name ),
					), network_admin_url('plugins.php'));
					$button_class = 'activate-now button-primary';
					$button_txt = esc_html__( 'Active Now', 'hotel-paradise' );
				}

				$detail_link = add_query_arg(
					array(
						'tab' => 'plugin-information',
						'plugin' => $plugin_slug,
						'TB_iframe' => 'true',
						'width' => '772',
						'height' => '349',

					),
					network_admin_url( 'plugin-install.php' )
				);

				echo '<div class="rcp">';
				echo '<h4 class="rcp-name">';
				echo esc_html( $plugin_name );
				echo '</h4>';
				echo '<p class="action-btn plugin-card-'.esc_attr( $plugin_slug ).'"><a href="'.esc_url( $install_url ).'" data-slug="'.esc_attr( $plugin_slug ).'" class="'.esc_attr( $button_class ).'">'.esc_html($button_txt).'</a></p>';
				echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="'.esc_url( $detail_link ).'">'.esc_html__( 'Details', 'hotel-paradise' ).'</a>';
				echo '</div>';
			}

		}
	}
}
$GLOBALS['hotel_paradise_dashboard'] = new hotel_paradise_dashboard();