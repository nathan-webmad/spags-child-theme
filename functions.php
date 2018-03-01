<?php
function advisor_theme_enqueue_styles() {

	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri(). '/js/custom.js', array('jquery'), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'advisor_theme_enqueue_styles', 16 );

//allow kml,kmz,json file uploads in wp media
function add_upload_mimes($mimes) {
	$mimes['kml'] = 'application/xml';
	$mimes['kmz'] = 'application/zip';
	$mimes['json'] = 'application/json'; 
	return $mimes;
}
add_filter('upload_mimes', 'add_upload_mimes');


//remove sidebars in certain places
function spags_remove_sidebar( $is_active_sidebar, $index ) {

	if( $index !== "sidebar-1" ) {
		return $is_active_sidebar;
	}

	if( ! is_product() &&  ! is_shop() && ! is_product_category()) {
		return $is_active_sidebar;
	}

	return false;
}

add_filter( 'is_active_sidebar', 'spags_remove_sidebar', 10, 2 );



//set products per row
add_action('woocommerce_before_main_content', function(){echo '<div class="columns-4">';}, 20);
add_action('woocommerce_after_main_content', function(){ echo '</div>';}, 20);


//change cart text
function woo_custom_change_cart_string($translated_text, $text, $domain) {
	$translated_text = str_replace("basket", "cart", $translated_text);
	$translated_text = str_replace("Basket", "Cart", $translated_text);
	$translated_text = str_replace("Update basket", "Update cart", $translated_text);
	return $translated_text;
}
add_filter('gettext', 'woo_custom_change_cart_string', 100, 3);
add_filter('ngettext', 'woo_custom_change_cart_string', 100, 3);


function my_custom_add_to_cart_redirect( $url ) {
	//$url = '/shop/'; // URL to redirect to (1 is the page ID here)
	//
	$product_id = absint( $_REQUEST['add-to-cart'] );
	$product_cat_slug = '';

	$terms = get_the_terms( $product_id, 'product_cat' );

	foreach ( $terms as $term ) {
		$product_cat_slug = $term->slug;
		break;
	}
	if( $product_cat_slug ){
		$url = '/order/#cat-'.$product_cat_slug;
		return $url;
	}

}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );
