<?php
/**
 * Attributes tab : deprecated this file is no longer in v2.0.0
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;

$show_attr = ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' ? true : false );
/*Remove additionnal information tabs*/
return;

if ( $product->has_attributes() || ( $show_attr && $product->has_dimensions() ) || ( $show_attr && $product->has_weight() ) ) {
	?>
	<li class="attributes_tab"><a href="#tab-attributes"><?php _e('Additional Information', 'woocommerce'); ?></a></li>
	<?php
}
?>