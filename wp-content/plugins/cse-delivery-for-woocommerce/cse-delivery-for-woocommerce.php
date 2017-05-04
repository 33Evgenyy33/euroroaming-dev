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
                    $this->id = 'cse_shipping_method';
                    $this->method_title = 'Курьерская служба КСЭ';
                    $this->method_description = 'Метод доставки на основе API CSE';


                    $this->init();

                    $this->enabled = isset($this->settings['enabled']) ? $this->settings['enabled'] : 'yes';
                    $this->title = isset($this->settings['title']) ? $this->settings['title'] : __('Курьером до двери', 'cse');
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
                    $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
                    $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

                    // Save settings in admin if you have any defined
                    add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));

                }

                /**
                 * Define settings field for this shipping
                 * @return void
                 */
                /*function init_form_fields()
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

                }*/


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

                    //return;
                    $country = $package['destination']['country'];

                    if ($country != 'RU') return;

                    $fias_num = $package['destination']['address_2'];

                    if ($fias_num == '') return;

                    $city = $package['destination']['city'];

                    if ($city != '') {

                        $cost = 0;

                        $fias = 'fias-' . $fias_num;

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

                        ob_clean();

                        try {
                            $client = new SoapClient('http://web.cse.ru/1c/ws/Web1C.1cws?wsdl',
                                array(
                                    'soap_version' => SOAP_1_2,
                                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
                                    /*'connection_timeout' => 15,*/
                                    'trace' => 1,
                                    'encoding' => 'UTF-8',
                                    'exceptions' => true,
                                ));
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        $recipient_data = $client->GetReferenceData($ship_type_request); //данные получателя (GUID, КЛАДР и т.д.)

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

                        ob_clean();

                        try {

                            $calc_response = $client->Calc($calc_request);

                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        echo '<pre>' . print_r($calc_response, true) . '</pre>';

                        foreach ($calc_response->return->List->List as $field) {
                            if ($field->Fields[4]->Value == 'Срочная') {
                                $cost = intval($field->Fields[0]->Value);
                                break;
                            }
                        }

                        error_log("cost = " . $cost, 0);

                        //$cost += $this->getTest1();


                        $rate = array(
                            'id' => $this->id,
                            'label' => $this->title,
                            'cost' => $cost
                        );

                        $this->add_rate($rate);

                    } else {
                        return;
                    }

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
}