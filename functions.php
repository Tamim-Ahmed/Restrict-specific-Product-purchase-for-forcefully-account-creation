if (is_user_logged_in() != true){
add_action( 'woocommerce_after_checkout_validation' , 'restict_registration_for_some_products', 10, 2 );
function restict_registration_for_some_products( $data, $errors ) {

    if( isset( $data['createaccount'] ) && !$data['createaccount'] ) {

        $retricted_ids = get_resticted_product_ids();

        if( isset( $retricted_ids ) && $retricted_ids != null ) {

            $cart_content = WC()->cart->get_cart_contents();

            $cart_ids = wp_list_pluck( $cart_content, 'product_id' );
            $cart_ids = array_values( $cart_ids );
            $common_ids = array_intersect( $retricted_ids, $cart_ids );

            if( isset( $common_ids ) && $common_ids != null ) {
                $errors->add( 'account_registration', __( 'You are not allowed to purchase these products without creating an account.', 'text-domain' ) );
            }
        }
    }
}
function get_resticted_product_ids() {
    //specific product ids
    return array(6690,6691);
}
}



//paste the above code to your themes functions.php file and replace "text-domain" with your themes text-domain name, and replace the products ids in the array.
