<?php
/**
 * The sidebar containing the main widget area
 *
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div id="secondary" class="col-md-4 col-sm-4 sidebar">	
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>