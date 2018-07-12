<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
/**
 * To update wishlist count in counter at menu top
 */
wp_enqueue_script("enqueue_custom_wishlist_js", QODE_ROOT."/woocommerce/wishlist.js",array(),false,true);
 
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
function yith_wcwl_ajax_update_count(){
wp_send_json( array(
'count' => yith_wcwl_count_all_products()
) );
}
add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_custom_wishlist_js' );

?>


<script>

/**
 * Ajax asynchronous addition of wishlist count to counter at header after clicking add to wishlist button
 */

jQuery( document ).ready( function( $ ){
$(document).on( 'added_to_wishlist removed_from_wishlist', function(){
var counter = $('.your-counter-selector');
 
$.ajax({
url: yith_wcwl_l10n.ajax_url,
data: {
action: 'yith_wcwl_update_wishlist_count'
},
dataType: 'json',
success: function( data ){
counter.html( data.count );
},
beforeSend: function(){
counter.block();
},
complete: function(){
counter.unblock();
}
})
} )
});

</script>
</body>
</html>