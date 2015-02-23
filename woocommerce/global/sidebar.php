<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

//get_sidebar('shop'); ?>

<div id="secondary" class="widget-area" role="complementary">
	<?php 	if(is_active_sidebar('shopsidebar')){
				dynamic_sidebar( 'shopsidebar' );} ?>
</div>
