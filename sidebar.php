<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package preferred_magazine
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<div id="secondary" class="widget-area col-lg-3 col-md-4 col-12 mt-30">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
