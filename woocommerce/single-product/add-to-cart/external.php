<?php
/**
 * External product add to cart (SB mod hiding add button for non admin)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
<?php if (current_user_can('manage_options')) {?>
<p class="cart">
	<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo $button_text; ?></a>
</p>
<?php }?>
<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>