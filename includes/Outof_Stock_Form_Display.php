<?php 
namespace Wpcommerz;

/**
 * Class Outof_Stock_Form_Display
 *
 * @since 1.0.0
 */
class Outof_Stock_Form_Display {

    /**
     * Class Construct
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_filter( 'woocommerce_get_availability', [ $this, 'show_filed_on_outof_stock_page' ] );
        add_action( 'init', [ $this, 'get_customer_email' ] );
        add_action( 'woocommerce_product_set_stock', [ $this, 'product_restored' ] );
    } 

    /**
     * Show field on out of stock page
     *
     * @since 1.0.0
     */
    public function show_filed_on_outof_stock_page( $availibility ) {

        if( $availibility['class'] === 'out-of-stock' ) {
           
            include SON_DIR . '/templates/email-filed-of-outof-stock.php';
           
        }
        
       return;
    } 

    /**
     * retrieve customer email
     *
     * @since 1.0.0
     */
    public function get_customer_email() {
        global $wpdb;

        $customer_email = isset( $_REQUEST['email'] ) ? sanitize_email( $_REQUEST['email'] ) : '';

        if( !empty( $customer_email ) ) {
            $wpdb->query(
                $wpdb->prepare(
                    'INSERT INTO `' . $wpdb->prefix . 'customer_email` ( email ) VALUES ( %s )', $customer_email
                )
            );
        }
    } 

    /**
     * Send email customer on product restored
     *
     * @since 1.0.0
     */
    public function product_restored( $value ) {
        global $wpdb;

        $cus_email = $wpdb->get_results( 
            $wpdb->prepare(  "SELECT email FROM {$wpdb->prefix}customer_email", ARRAY_N )
        );

        //Empty array
        $all_emails = [];
       
        foreach( $cus_email as $email ) {
            array_push( $all_emails, $email->email );
        }

        $subject = esc_html__( 'Product Returned on stock', 'stock-out-notifications' );

        $body = esc_html__( 'Hi, product has been returned back. Check out in our store', 'stock-out-notifications' );
        
        wp_mail( $all_emails, $subject, $body );
    } 
}
