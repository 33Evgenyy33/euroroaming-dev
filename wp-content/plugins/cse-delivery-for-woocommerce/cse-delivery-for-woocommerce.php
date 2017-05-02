<?php

/**
 * Plugin Name: Express Courier Service
 * Plugin URI: https://euroroaming.ru
 * Description: Custom Shipping Method for WooCommerce based on CSE (Express Courier Service)
 * Version: 1.0.0
 * Author: Evgeny Egorov
 * Author URI: https://euroroaming.ru
 * License: GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Domain Path: /lang
 * Text Domain: euroroaming
 */

if (!defined('WPINC')) {

    die;

}

/*
 * Check if WooCommerce is active
 */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    function cse_shipping_method()
    {
        if (!class_exists('cse_Shipping_Method')) {
            class cse_Shipping_Method extends WC_Shipping_Method
            {
                /**
                 * Constructor for your shipping class
                 *
                 * @access public
                 * @return void
                 */
                public function __construct()
                {
                    $this->id = 'cseship';
                    $this->method_title = __('Курьерская служба КСЭ', 'cse');
                    $this->method_description = __('Метод доставки на основе API CSE', 'cse');

                    // Availability & Countries
                    $this->availability = 'including';
                    $this->countries = array(
                        'RU' // Russia
                    );

                    $this->init();

                    $this->enabled = isset($this->settings['enabled']) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset($this->settings['title']) ? $this->settings['title'] : __('Курьером до двери', 'cse');

                    // Save settings
                    add_action('woocommerce_update_options_shipping_' . $this->id, array(
                        $this,
                        'process_admin_options'
                    ));

                    // Allow setting WAS Shipping rates for priorities
                    add_filter('option_woocommerce_shipping_method_selection_priority', array(
                        $this,
                        'default_shipping_method_priority'
                    ), 10, 1);
                }

                /**
                 * Init your settings
                 *
                 * @access public
                 * @return void
                 */
                function init()
                {
                    // Load the settings API
                    $this->init_form_fields();
                    $this->init_settings();

                }

                /**
                 * Define settings field for this shipping
                 * @return void
                 */
                function init_form_fields()
                {

                    $this->form_fields = array(

                        'enabled' => array(
                            'title' => __('Enable', 'cse'),
                            'type' => 'checkbox',
                            'description' => __('Enable this shipping.', 'cse'),
                            'default' => 'yes'
                        ),

                        'title' => array(
                            'title' => __('Title', 'cse'),
                            'type' => 'text',
                            'description' => __('Title to be display on site', 'cse'),
                            'default' => __('Курьером до двери', 'cse')
                        ),

                    );

                }


                /**
                 * This function is used to calculate the shipping cost. Within this function we can check for weights, dimensions and other parameters.
                 *
                 * @access public
                 *
                 * @param mixed $package
                 *
                 * @return void
                 */
                public function calculate_shipping($package = array())
                {
                    //return;

                    $country = $package['destination']['country'];

                    if ($country != 'RU')
                        return;

                    //$city = WC()->customer->get_shipping_city();

                    //$kladr = WC()->customer->get_kladr();

                    //echo 'kladr: '.$kladr;
                    //echo 'kladr: '.$_REQUEST['kladr'];

                    //print_r($package);


                    $fias_num = $package['destination']['address_2'];


                    $city = $package['destination']['city'];


                    //echo $package['destination']['fullname'];
                    // if postal code is empty take city

                    if ($city != '') {

                        $to_city = $city;

                        // plus additional cost
                        $cost = 0;

                        $send_to = $to_city;

                        $fias = 'fias-' . $fias_num;

                        print_r($fias);

                        //if ($fias_num !== '') return;

                        $ship_type_request = array(
                            'login' => 'ЕВРОРОУМИНГ-ИМ',
                            'password' => 'gnJkA6GwsLJ6',
                            'parameters' => array(
                                'Key' => 'Parameters',
                                'List' => array(
                                    0 => array(
                                        'Key' => 'Reference',
                                        'Value' => 'Geography',
                                        'ValueType' => 'string'
                                    ),
                                    1 => array(
                                        'Key' => 'Search',
                                        'Value' => $fias,
//                                        'Value'     => 'Москва г',
                                        'ValueType' => 'string'
                                    )
                                )
                            )
                        );

                        //print_r($ship_type_request);

                        $calc_request = array(
                            'login' => 'ЕВРОРОУМИНГ-ИМ',
                            'password' => 'gnJkA6GwsLJ6',
                            'data' => array(
                                'Key' => 'Destinations',
                                'List' => array(
                                    'Key' => 'Destination',
                                    'Fields' => array(
                                        0 => array(
                                            'Key' => 'SenderGeography',
                                            'Value' => 'cf862f56-442d-11dc-9497-0015170f8c09',
                                            'ValueType' => 'string'
                                        ),
                                        1 => array(
                                            'Key' => 'RecipientGeography', //получатель
                                            'Value' => '',
                                            'ValueType' => 'string'
                                        ),
                                        2 => array(
                                            'Key' => 'TypeOfCargo',
                                            'Value' => '81dd8a13-8235-494f-84fd-9c04c51d50ec',
                                            'ValueType' => 'string'
                                        ),
                                        3 => array(
                                            'Key' => 'Weight',
                                            'Value' => 0.1,
                                            'ValueType' => 'float'
                                        ),
                                        4 => array(
                                            'Key' => 'Qty',
                                            'Value' => 1,
                                            'ValueType' => 'int'
                                        )

                                    )
                                )
                            )
                        );


                        $client = new SoapClient('http://web.cse.ru/cse82_reg/ws/web1c.1cws?wsdl', array(
                            'login' => 'web',
                            'password' => 'web'
                        ));
                        $recipient_data = $client->GetReferenceData($ship_type_request); //данные получателя (GUID, КЛАДР и т.д.)


                        //echo '<pre>' . print_r($recipient_data, true) . '</pre>';

                        //return;

                        $recipient = ''; //получатель

                        if (is_array($recipient_data->return->List)) {

                            foreach ($recipient_data->return->List['Fields'] as $field_el) {
                                if ($field_el->Key == 'ID') {
                                    $recipient = $field_el->Value;
                                    break;
                                }
                                break;
                            }

                        } else {

                            foreach ($recipient_data->return->List->Fields as $field) {
                                if ($field->Key == 'ID') {
                                    $recipient = $field->Value;
                                    break;
                                }
                            }
                        }


                        $calc_request['data']['List']['Fields'][1]['Value'] = $recipient;
                        $calc_response = $client->Calc($calc_request);

                        echo '<pre>' . print_r($calc_response, true) . '</pre>';


                        foreach ($calc_response->return->List->List as $field) {
                            if ($field->Value == '6da21fe8-4f13-11dc-bda1-0015170f8c09' && $field->Fields[4]->Value == 'Срочная') {
                                $cost = $field->Fields[0]->Value;
                                break;
                            }
                        }


                        $rate = array(
                            'id' => $this->id,
                            'label' => $this->title,
                            'cost' => $cost
                        );

                        $this->add_rate($rate);

                        unset($ship_type_request);
                        unset($calc_request);
                        unset($client);
                        unset($recipient_data);
                        unset($calc_response);
                        unset($city);


                        //unset($client);

                        //echo $cost;

                    } else {
						return;
					}// end elseif

        }
        }
    }
}

add_action('woocommerce_shipping_init', 'cse_shipping_method');

function add_cse_shipping_method($methods)
{
    $methods[] = 'cse_Shipping_Method';

    return $methods;
}

add_filter('woocommerce_shipping_methods', 'add_cse_shipping_method');

/*function cse_validate_order( $posted ) {

    $packages = WC()->shipping->get_packages();

    $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );

    if ( is_array( $chosen_methods ) && in_array( 'cse', $chosen_methods ) ) {

        foreach ( $packages as $i => $package ) {

            if ( $chosen_methods[ $i ] != "cse" ) {

                continue;

            }

            $cse_Shipping_Method = new cse_Shipping_Method();
            $weightLimit              = (int) $cse_Shipping_Method->settings['weight'];
            $weight                   = 0;

            foreach ( $package['contents'] as $item_id => $values ) {
                $_product = $values['data'];
                $weight   = $weight + $_product->get_weight() * $values['quantity'];
            }

            $weight = wc_get_weight( $weight, 'kg' );

            if ( $weight > $weightLimit ) {

                $message = sprintf( __( 'Sorry, %d kg exceeds the maximum weight of %d kg for %s', 'cse' ), $weight, $weightLimit, $cse_Shipping_Method->title );

                $messageType = "error";

                if ( ! wc_has_notice( $message, $messageType ) ) {

                    wc_add_notice( $message, $messageType );

                }
            }
        }
    }
}*/

//add_action( 'woocommerce_review_order_before_cart_contents', 'cse_validate_order', 10 );
//add_action( 'woocommerce_after_checkout_validation', 'cse_validate_order', 10 );
}