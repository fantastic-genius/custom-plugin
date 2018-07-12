<?php
/*
 * Plugin Name: Display Product Short Descriptions in WooCommerce
 * Description: Add product short descriptions to the loop in product archive pages
 * Version: 1.0
 */
 
function cloudways_short_des_product() {
    echo "<div class='product-desc'>" . get_ecommerce_excerpt() . "</div>";
}
 
add_action( 'woocommerce_after_shop_loop_item_title', 'cloudways_short_des_product', 4 );



/**
 * Function to limit the number of characters for product description in product archive page (To be added in themes 
 * functions.php
 */
function get_ecommerce_excerpt(){
$excerpt = get_the_excerpt();
$excerpt = preg_replace(" ([.*?])",'',$excerpt);
$excerpt = strip_shortcodes($excerpt);
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, 100);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = trim(preg_replace( '/s+/', ' ', $excerpt));
return $excerpt;
}



