<?php
/**
 * Catch Box functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, catchbox_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'catchbox_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Catch Themes
 * @subpackage Catch_Box
 * @since Catch Box 1.0
 */

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Catch Box 1.0
 */

//Support woocommerce
add_theme_support( 'woocommerce' );
 
// SPECIFIC REGISTER FOR BOTTOM WIDGET GTRANS IN FOOTER
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
		'name' => __( 'Bottom Widget', 'catchbox' ),
		'id' => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => "</div>",
		'before_title' => '',
		'after_title' => '',
	) );
}

// SPECIFIC REGISTER FOR SHOP SIDEBAR IN FOOTER
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'catchbox' ),
		'id' => 'shopsidebar',
		'before_widget' => '<aside id="%1$s" class="widget sidebar-shop"><div id="%1$s" class="widgetSidebar %2$s">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h4><h3 class="widget-title">',
		'after_title' => '</h3></h4>',
	) );
}

// REGISTER HOME WIGDET 1
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
		'name' => __( 'Home widget left', 'catchbox' ),
		'id' => 'homewidget-left',
		'before_widget' => '<aside id="%1$s" class="widget home-widget left">',
		'after_widget' => '</aside><div class="home-widget bottom"></div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
// REGISTER HOME WIGDET 2
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
		'name' => __( 'Home widget center', 'catchbox' ),
		'id' => 'homewidget-center',
		'before_widget' => '<aside id="%1$s" class="widget home-widget center">',
		'after_widget' => '</aside><div class="home-widget bottom"></div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
// REGISTER HOME WIGDET 3
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
		'name' => __( 'Home widget right', 'catchbox' ),
		'id' => 'homewidget-right',
		'before_widget' => '<aside id="%1$s" class="widget home-widget right">',
		'after_widget' => '</aside><div class="home-widget bottom"></div>',
		'before_title' => '',
		'after_title' => '',
	) );
}

/* Hook for hidding QUantity */
// Hook in
add_filter( 'woocommerce_get_availability', 'custom_override_get_availability', 1, 2);
 
// Our hooked in function $availablity is passed via the filter!
function custom_override_get_availability( $availability, $_product ) {
if ( $_product->is_in_stock() ) $availability['availability'] = __('', 'woocommerce');
return $availability;
}

// remove html filter from category description
foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}


/** Customize login page & login redirect tweak **/
// Fonction qui insere le lien vers le css qui surchargera celui d'origine
function custom_login_css() {
  	echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/login/style-login.css" />';
}
add_action('login_head', 'custom_login_css');

// Filtre qui permet de changer l'url du logo
function custom_url_login() {
	return get_bloginfo( 'siteurl' ); // On retourne l'index du site
}
add_filter('login_headerurl', 'custom_url_login');

// Filtre qui permet de changer l'attribut title du logo
function custom_title_login($message){
	return get_bloginfo('description'); // On retourne la description du site
}
add_filter('login_headertitle', 'custom_title_login');

// redirect users to front page after login / logout
add_action('wp_login',create_function('','wp_redirect(home_url());exit();'));
add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));

/** modify woocomerce place holder **/
function custom_woocommerce_placeholder_img_src( $src ) {
    $src =  get_bloginfo( 'template_url' ) . '-child/images/placeholder.png';
	return $src;
}
add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

/** tag cloud widget tweak **/
function my_widget_tag_cloud_args( $args ) {
	$args['number'] = 20;
	$args['largest'] = 20;
	$args['smallest'] = 8;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'my_widget_tag_cloud_args' );

/** modify excerpts length **/
function custom_excerpt_length($length) {
	return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length');

/** to be put in a separate plugin !!!!???? **/
function enqueue_catchbox_scripts() {
	wp_register_script('cb_tinynav_mod', get_stylesheet_directory_uri() . '/assets/js/tiny-nav-menu-mod.js', array('jquery') );
	wp_enqueue_script('cb_tinynav_mod');
}
add_action('wp_enqueue_scripts', 'enqueue_catchbox_scripts');

/** tweak price html -> add BR after first price : deprecated with wc_wc20_variation_price_format !!!!???? */
function wpa83367_price_html( $price, $product ){
	$price = str_replace( '</del>', '</del><br>', $price );
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );

/** Use WC 2.0 variable price format, now include sale price strikeout **/
add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );
function wc_wc20_variation_price_format( $price, $product ) {
	// Main Price
	$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
	$price = $prices[0] !== $prices[1] ? sprintf( __( '*%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
	// Sale Price
	$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
	sort( $prices );
	$saleprice = $prices[0] !== $prices[1] ? sprintf( __( '*%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
 
	if ( $price !== $saleprice ) {
		$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
	}
	return $price;
}
?>