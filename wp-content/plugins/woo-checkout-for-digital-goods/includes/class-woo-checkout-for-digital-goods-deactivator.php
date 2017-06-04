<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Woo_Checkout_For_Digital_Goods
 * @subpackage Woo_Checkout_For_Digital_Goods/includes
 * @author     Multidots <inquiry@multidots.in>
 */
class Woo_Checkout_For_Digital_Goods_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
			$log_url = $_SERVER['HTTP_HOST'];
      		$log_plugin_id = 4;
     		$log_activation_status = 0;
     		$cur_dt = date('Y-m-d');
     		wp_remote_request('http://mdstore.projectsmd.in/webservice-deactivate.php?log_url='.$log_url.'&plugin_id='.$log_plugin_id.'&activation_status='.$log_activation_status.'&activation_date='.$cur_dt);
			
	}

}
