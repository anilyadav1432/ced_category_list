<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       cedcoss
 * @since      1.0.0
 *
 * @package    Ced_categories_list
 * @subpackage Ced_categories_list/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ced_categories_list
 * @subpackage Ced_categories_list/public
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Ced_categories_list_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ced_categories_list_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_categories_list_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ced_categories_list-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ced_categories_list_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_categories_list_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ced_categories_list-public.js', array( 'jquery' ), $this->version, false );

	}

	
	// function woocommerce_remove_product_from_cart( $params = array() ) {
	// 	var_dump($params);
	// 	return;

	// 	if ( is_admin() ) return;
   
	// 	$product_id = 30368; // Product ID
	// 	$product_cart_id = WC()->cart->generate_cart_id( $product_id );
	// 	$cart_item_key = WC()->cart->find_product_in_cart( $product_cart_id );
	// 	if ( $cart_item_key ) {
	// 	  WC()->cart->remove_cart_item( $cart_item_key );
	// 	}
	//  }

	function bbloomer_check_category_in_cart() {
 
		// Set $cat_in_cart to false
		$cat_in_cart = false;
		if ( get_option( 'all_cat_list' ) !== false) {       
			$catt_data = explode(",",get_option( 'all_cat_list' ));
			// Loop through all products in the Cart
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				foreach($catt_data as $catdata)
				{
					// If Cart has category , set $cat_in_cart to true
					if ( has_term( $catdata, 'product_cat', $cart_item['product_id'] ) ) {
						$cat_in_cart = true;
						WC()->cart->remove_cart_item( $cart_item_key );
						break;
					}
				}
			}
			// Do something if category is in the Cart
			if ( $cat_in_cart ) {
		
			// For example, print a notice
			wc_print_notice( 'Some Category product not allow' );
			}
		}
	  
	 }


}
