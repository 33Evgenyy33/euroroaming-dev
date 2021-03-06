<?php
/**
 * WooCommerce POS General Settings
 *
 * @author    Actuality Extensions
 * @package   WoocommercePointOfSale/Classes/settings
 * @category    Class
 * @since     0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('WC_POS_Admin_Settings_General')) :

    /**
     * WC_POS_Admin_Settings_General
     */
    class WC_POS_Admin_Settings_General extends WC_Settings_Page
    {

        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->id = 'general_pos';
            $this->label = __('General', 'woocommerce');

            add_filter('wc_pos_settings_tabs_array', array($this, 'add_settings_page'), 20);
            add_action('wc_pos_settings_' . $this->id, array($this, 'output'));
            add_action('wc_pos_settings_save_' . $this->id, array($this, 'save'));

        }

        /**
         * Get settings array
         *
         * @return array
         */
        public function get_settings()
        {
            global $woocommerce;

            $order_statuses = wc_get_order_statuses();
            $statuses = array();
            foreach ($order_statuses as $key => $value) {
                $a = substr($key, 3);
                $statuses[$a] = $value;
            }
            return apply_filters('woocommerce_point_of_sale_general_settings_fields', array(


                array('title' => __('General Options', 'wc_point_of_sale'), 'type' => 'title', 'desc' => '', 'id' => 'general_pos_options'),

                array(
                    'name' => __('Auto Update Stock', 'wc_point_of_sale'),
                    'id' => 'wc_pos_autoupdate_stock',
                    'type' => 'checkbox',
                    'desc' => __('Enable update stock automatically ', 'wc_point_of_sale'),
                    'desc_tip' => __('Updates the stock inventories for products automatically whilst running the register. Enabling this may hinder server performance. ', 'wc_point_of_sale'),
                    'default' => 'no',
                    'autoload' => true
                ),
                array(
                    'name' => __('Update Interval', 'wc_point_of_sale'),
                    'id' => 'wc_pos_autoupdate_interval',
                    'type' => 'number',
                    'desc_tip' => __('Enter the interval for auto-update in seconds.', 'wc_point_of_sale'),
                    'desc' => __('seconds', 'wc_point_of_sale'),
                    'default' => 240,
                    'autoload' => true,
                    'css' => 'width: 50px;'
                ),
                array(
                    'name' => __('Stock Quantity', 'wc_point_of_sale'),
                    'id' => 'wc_pos_show_stock',
                    'type' => 'checkbox',
                    'desc' => __('Enable stock quantity identifier', 'wc_point_of_sale'),
                    'desc_tip' => __('Shows the remaining stock when adding products to the basket.', 'wc_point_of_sale'),
                    'default' => 'yes',
                    'autoload' => true
                ),

                array(
                    'name' => __('Out of Stock', 'wc_point_of_sale'),
                    'id' => 'wc_pos_show_out_of_stock_products',
                    'type' => 'checkbox',
                    'desc' => __('Enable out of stock products', 'wc_point_of_sale'),
                    'desc_tip' => __('Shows out of stock products in the product grid.', 'wc_point_of_sale'),
                    'default' => 'yes',
                    'autoload' => true
                ),


                array(
                    'name' => __('Discount Presets', 'wc_point_of_sale'),
                    'desc_tip' => __('Define the preset discount buttons when applying discount to the order.', 'wc_point_of_sale'),
                    'id' => 'woocommerce_pos_register_discount_presets',
                    'class' => 'wc-enhanced-select',
                    'type' => 'multiselect',
                    'options' => apply_filters('woocommerce_pos_register_discount_presets', array(
                        5 => __('5%', 'wc_point_of_sale'),
                        10 => __('10%', 'wc_point_of_sale'),
                        15 => __('15%', 'wc_point_of_sale'),
                        20 => __('20%', 'wc_point_of_sale'),
                        25 => __('25%', 'wc_point_of_sale'),
                        30 => __('30%', 'wc_point_of_sale'),
                        35 => __('35%', 'wc_point_of_sale'),
                        40 => __('40%', 'wc_point_of_sale'),
                        45 => __('45%', 'wc_point_of_sale'),
                        50 => __('50%', 'wc_point_of_sale'),
                        55 => __('55%', 'wc_point_of_sale'),
                        60 => __('60%', 'wc_point_of_sale'),
                        65 => __('65%', 'wc_point_of_sale'),
                        70 => __('70%', 'wc_point_of_sale'),
                        75 => __('75%', 'wc_point_of_sale'),
                        80 => __('80%', 'wc_point_of_sale'),
                        85 => __('85%', 'wc_point_of_sale'),
                        90 => __('90%', 'wc_point_of_sale'),
                        95 => __('95%', 'wc_point_of_sale'),
                        100 => __('100%', 'wc_point_of_sale')
                    )),
                    'default' => array(5, 10, 15, 20),
                ),


                array(
                    'name' => __('Filters', 'wc_point_of_sale'),
                    'desc_tip' => __('Select which filters appear on the Orders page.', 'wc_point_of_sale'),
                    'id' => 'woocommerce_pos_order_filters',
                    'class' => 'wc-enhanced-select',
                    'type' => 'multiselect',
                    'options' => array(
                        'register' => __('Registers', 'wc_point_of_sale'),
                        'outlet' => __('Outlets', 'wc_point_of_sale'),
                    ),
                    'autoload' => true
                ),

                array(
                    'title' => __('SSL Options', 'wc_point_of_sale'),
                    'desc' => __('Force secure checkout', 'wc_point_of_sale'),
                    'id' => 'woocommerce_pos_force_ssl_checkout',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                    'desc_tip' => __('Force SSL (HTTPS) on the POS page (an SSL Certificate is required).', 'wc_point_of_sale'),
                ),
                array(
                    'title' => __('Sound Notifications', 'wc_point_of_sale'),
                    'desc' => __('Disable sound notifications', 'wc_point_of_sale'),
                    'desc_tip' => __('Mutes the sound notifications when using the register.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_disable_sound_notifications',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                ),
                array(
                    'title' => __('Connection Status', 'wc_point_of_sale'),
                    'desc' => __('Disable connection status', 'wc_point_of_sale'),
                    'desc_tip' => __('Deactivates the connection status from loading in the register.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_disable_connection_status',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                ),
                array(
                    'title' => __('Closing Reports', 'wc_point_of_sale'),
                    'desc' => __('Display end of day report when closing register.', 'wc_point_of_sale'),
                    'desc_tip' => __('End of day report displayed with total sales when register closes.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_display_reports',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                ),

                array(
                    'title' => __('Keyboard Shortcuts', 'wc_point_of_sale'),
                    'desc' => __('Enable keyboard shortcuts', 'wc_point_of_sale'),
                    'desc_tip' => sprintf(__('Allows you to use keyboard shortcuts to execute popular and frequent actions. Click %shere%s for the list of keyboard shortcuts.', 'wc_point_of_sale'),
                        '<a href="http://actualityextensions.com/woocommerce-point-of-sale/keyboard-shortcuts/" target="_blank">', '</a>'),
                    'id' => 'wc_pos_keyboard_shortcuts',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                ),

                array(
                    'title' => __('Bill Screen', 'wc_point_of_sale'),
                    'desc' => __('Display bill screen', 'wc_point_of_sale'),
                    'desc_tip' => __('Allows you to display the order on a separate display i.e. pole display.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_bill_screen',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                ),

                array(
                    'title' => __('Product Visiblity', 'wc_point_of_sale'),
                    'desc' => __('Enable product visibility control', 'wc_point_of_sale'),
                    'desc_tip' => __('Allows you to show and hide products from either the POS, web or both shops.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_visibility',
                    'default' => 'no',
                    'type' => 'checkbox',
                    'checkboxgroup' => 'start',
                ),

                array('type' => 'sectionend', 'id' => 'general_pos_options'),

                array('title' => __('Status Options', 'woocommerce'), 'desc' => __('The following options affect the status of the orders when using the register.', 'woocommerce'), 'type' => 'title', 'id' => 'status_options'),

                array(
                    'name' => __('Complete Order', 'woocommerce'),
                    'desc_tip' => __('Select the order status of completed orders when using the register.', 'wc_point_of_sale'),
                    'id' => 'woocommerce_pos_end_of_sale_order_status',
                    'css' => '',
                    'std' => '',
                    'class' => 'wc-enhanced-select',
                    'type' => 'select',
                    'options' => apply_filters('woocommerce_pos_end_of_sale_order_status', $statuses),
                    'default' => 'processing'
                ),


                array(
                    'name' => __('Save Order', 'wc_point_of_sale'),
                    'desc_tip' => __('Select the order status of saved orders when using the register.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_save_order_status',
                    'type' => 'select',
                    'class' => 'wc-enhanced-select',
                    'options' => apply_filters('wc_pos_save_order_status', $order_statuses),
                    'default' => 'wc-pending'
                ),

                array(
                    'name' => __('Load Order ', 'woocommerce'),
                    'desc_tip' => __('Select the order status of loaded orders when using the register.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_load_order_status',
                    'class' => 'wc-enhanced-select',
                    'type' => 'multiselect',
                    'options' => apply_filters('wc_pos_load_order_status', $order_statuses),
                    'default' => 'wc-pending'
                ),

                array(
                    'name' => __('Cash Management ', 'woocommerce'),
                    'desc_tip' => __('Select the order statuses to be included to the cash management.', 'wc_point_of_sale'),
                    'id' => 'wc_pos_cash_management_order_status',
                    'class' => 'wc-enhanced-select',
                    'type' => 'multiselect',
                    'options' => apply_filters('wc_pos_load_order_status', $order_statuses),
                    'default' => 'wc-processing'
                ),

                array(
                    'name' => __('Web Orders ', 'woocommerce'),
                    'id' => 'wc_pos_load_web_order',
                    'std' => '',
                    'type' => 'checkbox',
                    'desc' => __('Load web orders', 'wc_point_of_sale'),
                    'desc_tip' => __('Check this box to load orders placed through the web store.', 'wc_point_of_sale'),
                    'default' => 'no',
                    'autoload' => true
                ),

                array('type' => 'sectionend', 'id' => 'status_options'),


            )); // End general settings

        }

        /**
         * Save settings
         */
        public function save()
        {
            $settings = $this->get_settings();

            WC_POS_Admin_Settings::save_fields($settings);
        }

    }

endif;

return new WC_POS_Admin_Settings_General();