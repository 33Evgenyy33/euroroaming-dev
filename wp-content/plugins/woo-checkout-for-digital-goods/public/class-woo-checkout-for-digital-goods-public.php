<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.multidots.com
 * @since      1.0.0
 *
 * @package    Woo_Checkout_For_Digital_Goods
 * @subpackage Woo_Checkout_For_Digital_Goods/public
 */
class Woo_Checkout_For_Digital_Goods_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/woo-checkout-for-digital-goods-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/woo-checkout-for-digital-goods-public.js', array('jquery'), $this->version, false);

    }

    /**
     * Function for remove checkout fields.
     */
    public function custom_override_checkout_fields($fields)
    {

        global $woocommerce;

        $items = $woocommerce->cart->get_cart();

        foreach ($items as $item => $values) {

            $_product = $values['data']->post;

            if ($_product->ID == 25841) {

                unset($fields['billing']['orange_replenishment']);
                unset($fields['billing']['vodafone_replenishment']);
                unset($fields['billing']['ortel_replenishment']);
                unset($fields['billing']['billing_company']);
                unset($fields['billing']['passport']);
                unset($fields['billing']['activation_conditions']);
                unset($fields['billing']['internet_pass_num']);
                unset($fields['billing']['orage_num']);
                unset($fields['billing']['date_activ_orange_visa']);
                unset($fields['billing']['pointofsale_email']);
                unset($fields['billing']['number_simcard']);
                unset($fields['billing']['client_phone']);
                unset($fields['billing']['client_email']);
                unset($fields['billing']['date_activ']);

                echo '<style>.col-2{display: none}.woocommerce-message{display: none}.woocommerce-info{display: none}div#wc_checkout_add_ons{display: none;}</style>';

                return $fields;
            }
        }

        // return the regular billing fields if we need shipping fields
        if ($woocommerce->cart->needs_shipping()) {

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);
            unset($fields['billing']['pointofsale_email']);
            unset($fields['billing']['number_simcard']);
            unset($fields['billing']['orage_num']);
            unset($fields['billing']['internet_pass_num']);
            unset($fields['billing']['recovery_vodafone']);
            unset($fields['billing']['date_activ_orange_visa']);
            unset($fields['billing']['client_email']);

            unset($fields['billing']['client_phone']);

            return $fields;
        }

        $temp_product = array();

        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {

            $_product = $values['data'];

            $get_virtual = get_post_meta($_product->id, '_virtual', true);

            if (isset($get_virtual) && $get_virtual == 'no') {
                $temp_product[] = $_product->id;
            }
        }

        if (WC()->cart->get_cart_contents_count() == 0) {

            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_address_1']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_country']);
            unset($fields['billing']['billing_state']);
            unset($fields['order']['order_comments']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['passport']);
            unset($fields['billing']['activation_conditions']);
            unset($fields['billing']['orage_num']);
            unset($fields['billing']['internet_pass_num']);
            unset($fields['billing']['recovery_vodafone']);
            unset($fields['billing']['date_activ_orange_visa']);
            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);

            return $fields;

        }

        if (count($temp_product) > 0) {

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);
            unset($fields['billing']['pointofsale_email']);
            unset($fields['billing']['number_simcard']);
            unset($fields['billing']['orage_num']);
            unset($fields['billing']['internet_pass_num']);
            unset($fields['billing']['recovery_vodafone']);
            unset($fields['billing']['date_activ_orange_visa']);
            unset($fields['billing']['client_email']);

            unset($fields['billing']['client_phone']);

            return $fields;

        }

        if ($_product->id == 23575) {

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_address_1']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_country']);
            unset($fields['billing']['billing_state']);
            unset($fields['order']['order_comments']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['passport']);
            unset($fields['billing']['activation_conditions']);
            unset($fields['billing']['internet_pass_num']);
            unset($fields['billing']['recovery_vodafone']);
            unset($fields['billing']['pointofsale_email']);
            unset($fields['billing']['number_simcard']);
            unset($fields['billing']['client_email']);

            unset($fields['billing']['client_phone']);
            unset($fields['billing']['date_activ']);

            echo '<style>.col-2{display: none}.woocommerce-message{display: none}.woocommerce-info{display: none}</style>';

            return $fields;

        }

        if ($_product->id == 22325) {

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_address_1']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_country']);
            unset($fields['billing']['billing_state']);
            unset($fields['order']['order_comments']);
            unset($fields['billing']['billing_address_2']);
            unset($fields['billing']['billing_postcode']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['billing_city']);
            unset($fields['billing']['passport']);
            unset($fields['billing']['activation_conditions']);
            unset($fields['billing']['recovery_vodafone']);
            unset($fields['billing']['orage_num']);
            unset($fields['billing']['date_activ_orange_visa']);
            unset($fields['billing']['pointofsale_email']);
            unset($fields['billing']['number_simcard']);
            unset($fields['billing']['client_email']);

            unset($fields['billing']['client_phone']);
            unset($fields['billing']['date_activ']);

            echo '<style>.col-2{display: none}.woocommerce-message{display: none}.woocommerce-info{display: none}div#wc_checkout_add_ons{display: none;}</style>';

            return $fields;

        }

        if ($_product->id == 25841) {

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);
            unset($fields['billing']['billing_company']);
            unset($fields['billing']['passport']);
            unset($fields['billing']['activation_conditions']);
            unset($fields['billing']['internet_pass_num']);
            unset($fields['billing']['orage_num']);
            unset($fields['billing']['date_activ_orange_visa']);
            unset($fields['billing']['pointofsale_email']);
            unset($fields['billing']['number_simcard']);
            unset($fields['billing']['client_email']);

            unset($fields['billing']['client_phone']);
            unset($fields['billing']['date_activ']);

            echo '<style>.col-2{display: none}.woocommerce-message{display: none}.woocommerce-info{display: none}div#wc_checkout_add_ons{display: none;}</style>';

            return $fields;

        }

        if ($_product->id == 18959) {

            wp_enqueue_script('scrolltoid', get_stylesheet_directory_uri() . '/js/jquery.mask.js');

            ?>
            <script>
                jQuery(document).ready(function ($) {
                    $("#orange_replenishment").mask('600000000');
                });
            </script>
            <?php

            unset($fields['billing']['vodafone_replenishment']);
            unset($fields['billing']['ortel_replenishment']);

        }

        if ($_product->id == 18941) {

            wp_enqueue_script('scrolltoid', get_stylesheet_directory_uri() . '/js/jquery.mask.js');

            ?>
            <script>
                jQuery(document).ready(function ($) {
                    $("#vodafone_replenishment").mask('3400000000');
                });
            </script>
            <?php

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['ortel_replenishment']);

        }

        if ($_product->id == 18961) {

            unset($fields['billing']['orange_replenishment']);
            unset($fields['billing']['vodafone_replenishment']);

        }

        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_state']);
        unset($fields['order']['order_comments']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['passport']);
        unset($fields['billing']['activation_conditions']);
        unset($fields['billing']['pointofsale_email']);
        unset($fields['billing']['number_simcard']);
        unset($fields['billing']['orage_num']);
        unset($fields['billing']['internet_pass_num']);
        unset($fields['billing']['recovery_vodafone']);
        unset($fields['billing']['date_activ_orange_visa']);
        unset($fields['billing']['client_email']);

        unset($fields['billing']['client_phone']);
        unset($fields['billing']['date_activ']);
        echo '<style>#wc_checkout_add_ons{display: none;}.input-file-plupload{display: none;}.col-2{display: none}.woocommerce-message{display: none}.woocommerce-info{display: none}</style>';

        return $fields;

    }


    /**
     * BN code added
     */

    function paypal_bn_code_filter($paypal_args)
    {
        $paypal_args['bn'] = 'Multidots_SP';
        return $paypal_args;
    }

}
