<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 * Change from "onsale" to "Promo" (and remove useless php tags)
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
global $post, $product;

if ( $product->is_on_sale() ) : 
	echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.'Promo!'.'</span>', $post, $product);
endif;