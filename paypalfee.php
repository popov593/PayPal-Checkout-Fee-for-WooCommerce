<?php
/**
* Plugin Name: PayPal Checkout Fee for WooCommerce
* Plugin URI: https://vipestudio.com
* Description: PayPal Checkout Fee for WooCommerce
* Version: 1.0
* Author: Ivan Popov
* Author URI: https://vipestudio.com
**/

//Paypal FeE
/**
 * Add a fee when the user checks out with PayPal
 */
function wcfad_apply_payment_gateway_fee() {
 $payment_method = WC()->session->get( 'chosen_payment_method' );
 // Only apply the fee if the payment gateway is PayPal
 // Note that you might need to check this slug, depending on the PayPal gateway you're using
 if( $payment_method == 'paypal' ) {
 $label = __( 'PayPal такса (3.40%)', 'wcfad' ); //Give your fee a name
$percentageChange = 3.40; //Define the % from the order total
//Our original number.
$originalNumber = WC()->cart->get_cart_contents_total();
$numberToAdd = ($originalNumber / 100) * $percentageChange;
	 
 // Change the third parameter to false if you don't wish to apply tax to the fee
 // Change the fourth parameter to a different tax class if required
 WC()->cart->add_fee( $label, $numberToAdd, true, 'standard' );
 }
}
add_action( 'woocommerce_cart_calculate_fees', 'wcfad_apply_payment_gateway_fee' );
/**
 * Add some JS
 */
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
