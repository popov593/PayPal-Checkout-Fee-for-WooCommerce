<?php
/**
* Plugin Name: PayPal Checkout Fee for WooCommerce
* Plugin URI: https://vipestudio.com
* Description: PayPal Checkout Fee for WooCommerce
* Version: 1.0
* Author: Ivan Popov
* Author URI: https://vipestudio.com
**/

function wcfad_apply_payment_gateway_fee() {
 $payment_method = WC()->session->get( 'chosen_payment_method' );
	
if( $payment_method == 'paypal' ) {  // Payment Method Slug
 $label = __( 'PayPal такса (3.40%)', 'wcfad' ); //Give your fee a name
$percentageChange = 3.40; //Define the % from the order total
$originalNumber = WC()->cart->get_cart_contents_total();
$numberToAdd = ($originalNumber / 100) * $percentageChange;
	 
 // Third paramater is tax application
 // Fourht is the tax slug
 WC()->cart->add_fee( $label, $numberToAdd, true, 'standard' );
 }
}
add_action( 'woocommerce_cart_calculate_fees', 'wcfad_apply_payment_gateway_fee' );

//JS
function wcfad_script() {
 ?>
 <script>
 jQuery(document).ready(function($){
 $('body').on('change','.checkout .input-radio',function(){
 $('body').trigger('update_checkout');
 });
 });
 </script>
<?php
}
add_action( 'woocommerce_after_checkout_form', 'wcfad_script' );
?>
