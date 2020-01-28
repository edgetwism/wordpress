<?php 
function hotel_paradise_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'hotel-paradise' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and pages.', 'hotel-paradise' ),
		'before_widget' => '<section id="%1$s" class="widget animated wow fadeInUp %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'hotel-paradise' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'hotel-paradise' ),
		'before_widget' => '<section id="%1$s" class="widget animated wow fadeInUp %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'hotel-paradise' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'hotel-paradise' ),
		'before_widget' => '<section id="%1$s" class="widget animated wow fadeInUp %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'hotel-paradise' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'hotel-paradise' ),
		'before_widget' => '<section id="%1$s" class="widget animated wow fadeInUp %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'hotel-paradise' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'hotel-paradise' ),
		'before_widget' => '<section id="%1$s" class="widget animated wow fadeInUp %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hotel_paradise_widgets_init' );