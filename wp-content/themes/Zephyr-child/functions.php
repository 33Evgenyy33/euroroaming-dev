<?php
/* Custom functions code goes here. */

/**
 * Load Enqueued Scripts in the Footer
 *
 * Automatically move JavaScript code to page footer, speeding up page loading time.
 */


/*remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    }
}
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;
        $output = '<div class="col-lg-4">';

        if ( has_post_thumbnail() ) {
            $output .= get_the_post_thumbnail( $post->ID, $size );
        } else {
            $output .= wc_placeholder_img( $size );
        }
        $output .= '</div>';
        return $output;
    }
}*/

/*add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_price', 10);
function woocommerce_template_loop_product_price($woocommerce_template_loop_price, $int) {
    global $post;
    $price = 0;

    switch ($post->ID){
        case 18402:
            $price = 1340;
            break;
        case 18455:
            $price = 750;
            break;
        case 28328:
            $price = 750;
            break;
        case 18446:
            $price = 1005;
            break;
        case 41120:
            $price = 1000;
            break;
        case 18453:
            $price = 1140;
            break;
        case 18438:
            $price = 2345;
            break;
        case 48067:
            $price = 750;
            break;
        case 18443:
            $price = 1780;
            break;
    }
    //echo '<h3 id="shop-plastic-price">'.$post->ID.'</h3>';
    echo '<style>#shop-plastic-price {padding: 0;color: #838b08;font-weight: 500;}</style><h3 id="shop-plastic-price">'.$price.'₽</h3>';
}*/


/* Отправление почты */
add_action('phpmailer_init', 'tweak_mailer_ssl', 999);
function tweak_mailer_ssl($phpmailer)
{
    $phpmailer->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
}

add_filter('woocommerce_states', 'custom_woocommerce_states');
function custom_woocommerce_states($states)
{

    $states['RU'] = array(
        'Респ Адыгея' => 'Республика Адыгея',
        'Респ Алтай' => 'Республика Алтай',
        'Респ Башкортостан' => 'Республика Башкортостан',
        'Респ Бурятия' => 'Республика Бурятия',
        'Респ Дагестан' => 'Республика Дагестан',
        'Респ Ингушетия' => 'Республика Ингушетия',
        'Кабардино-Балкарская Респ' => 'Кабардино-Балкарская республика',
        'Респ Калмыкия' => 'Республика Калмыкия',
        'Карачаево-Черкесская Респ' => 'Карачаево-Черкесская республика',
        'Респ Карелия' => 'Республика Карелия',
        'Респ Коми' => 'Республика Коми',
        'Респ Крым' => 'Крым',
        'Респ Марий Эл' => 'Республика Марий Эл',
        'Респ Мордовия' => 'Республика Мордовия',
        'Респ Саха /Якутия/' => 'Республика Саха (Якутия)',
        'Респ Северная Осетия - Алания' => 'Респ Северная Осетия-Алания',
        'Респ Татарстан' => 'Республика Татарстан',
        'Респ Тува' => 'Республика Тыва',
        'Удмуртская Респ' => 'Удмуртская республика',
        'Респ Хакасия' => 'Республика Хакасия',
        'Чеченская Респ' => 'Чеченская республика',
        'Чувашская Республика - Чувашия' => 'Чувашская республика',
        'Алтайский край' => 'Алтайский край',
        'Забайкальский край' => 'Забайкальский край',
        'Камчатский край' => 'Камчатский край',
        'Краснодарский край' => 'Краснодарский край',
        'Красноярский край' => 'Красноярский край',
        'Пермский край' => 'Пермский край',
        'Приморский край' => 'Приморский край',
        'Ставропольский край' => 'Ставропольский край',
        'Хабаровский край' => 'Хабаровский край',
        'Амурская обл' => 'Амурская область',
        'Архангельская обл' => 'Архангельская область',
        'Астраханская обл' => 'Астраханская область',
        'Белгородская обл' => 'Белгородская область',
        'Брянская обл' => 'Брянская область',
        'Владимирская обл' => 'Владимирская область',
        'Волгоградская обл' => 'Волгоградская область',
        'Вологодская обл' => 'Вологодская область',
        'Воронежская обл' => 'Воронежская область',
        'Ивановская обл' => 'Ивановская область',
        'Иркутская обл' => 'Иркутская область',
        'Калининградская обл' => 'Калининградская область',
        'Калужская обл' => 'Калужская область',
        'Кемеровская обл' => 'Кемеровская область',
        'Кировская обл' => 'Кировская область',
        'Костромская обл' => 'Костромская область',
        'Курганская обл' => 'Курганская область',
        'Курская обл' => 'Курская область',
        'Ленинградская обл' => 'Ленинградская область',
        'Липецкая обл' => 'Липецкая область',
        'Магаданская обл' => 'Магаданская область',
        'Московская обл' => 'Московская область',
        'Мурманская обл' => 'Мурманская область',
        'Нижегородская обл' => 'Нижегородская область',
        'Новгородская обл' => 'Новгородская область',
        'Новосибирская обл' => 'Новосибирская область',
        'Омская обл' => 'Омская область',
        'Оренбургская обл' => 'Оренбургская область',
        'Орловская обл' => 'Орловская область',
        'Пензенская обл' => 'Пензенская область',
        'Псковская обл' => 'Псковская область',
        'Ростовская обл' => 'Ростовская область',
        'Рязанская обл' => 'Рязанская область',
        'Самарская обл' => 'Самарская область',
        'Саратовская обл' => 'Саратовская область',
        'Сахалинская обл' => 'Сахалинская область',
        'Свердловская обл' => 'Свердловская область',
        'Смоленская обл' => 'Смоленская область',
        'Тамбовская обл' => 'Тамбовская область',
        'Тверская обл' => 'Тверская область',
        'Томская обл' => 'Томская область',
        'Тульская обл' => 'Тульская область',
        'Тюменская обл' => 'Тюменская область',
        'Ульяновская обл' => 'Ульяновская область',
        'Челябинская обл' => 'Челябинская область',
        'Ярославская обл' => 'Ярославская область',
        'г Москва' => 'Москва',
        'г Санкт-Петербург' => 'Санкт-Петербург',
        'г Севастополь' => 'Севастополь',
        'Еврейская Аобл' => 'Еврейская автономная область',
        'Ненецкий АО' => 'Ненецкий автономный округ',
        'Ханты-Мансийский Автономный округ - Югра' => 'Ханты-Мансийский автономный округ - Югра',
        'Чукотский АО' => 'Чукотский автономный округ',
        'Ямало-Ненецкий АО' => 'Ямало-Ненецкий автономный округ'
    );
    return $states;
}

/*********************************Woocommerce промокод************************************************/



/* Загрузка скрипта для страницы CHECKOUT*/
add_action( 'wp_enqueue_scripts', 'my_checkout_scripts' );
function my_checkout_scripts() {
    if ( is_page( 'checkout' ) ) {
        //wp_enqueue_style('suggestions-css', get_stylesheet_directory_uri() . '/css/suggestions.css');
        //wp_enqueue_script( 'suggestions-js', get_stylesheet_directory_uri() . '/js/jquery.suggestions.min.js' );
        wp_enqueue_script( 'mycheckout', get_stylesheet_directory_uri() . '/js/mycheckout.js' );
    }
}

/*add_filter('affwp_currencies', 'affwp_custom_add_currency');
function affwp_custom_add_currency($currencies)
{
    $currencies['ye'] = 'YE';
    return $currencies;
}*/

/*add_filter('show_admin_bar', 'my_function_admin_bar');
function my_function_admin_bar()
{
    if (members_current_user_has_role('cashier') || members_current_user_has_role('editor') || members_current_user_has_role('administrator') || members_current_user_has_role('shop_manager')) {
        return true;
    } else {
        return false;
    }
}*/

add_action('wp_logout', create_function('', 'wp_redirect(home_url());exit();'));


//add_action('woocommerce_before_checkout_form', 'action_woocommerce_before_checkout_form', 10, 2);
//function action_woocommerce_before_checkout_form($woocommerce_checkout_login_form, $int)
//{
//    global $woocommerce;
//
//    $product_in_cart = false;
//
//    foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
//        $_product = $values['data'];
//        $terms = get_the_terms($_product->id, 'product_cat');
//        foreach ($terms as $term) {
//            $_categoryid = $term->term_id;
//            if ($_categoryid == 139) {
//                //category is in cart!
//                $product_in_cart = true;
//            }
//        }
//    }
//
//    if ($product_in_cart == true) {
//        echo '<p style="box-shadow: 0 1px 1px 0 rgba(0,0,0,0.05), 0 1px 3px 0 rgba(0,0,0,0.25);border-width: 1px 1px;background: #ffef74;padding: 20px;border-left: .618em solid rgba(0,0,0,.15);">Для выбора способа доставки или пункта самовывоза заполните все обязательные поля, отмеченные звездочкой <span style="color: #F60000;font-size: 18px;">*</span></p>';
//    }
//}

add_action('woocommerce_review_order_before_payment', 'action_woocommerce_checkout_before_order_review', 10, 0);
function action_woocommerce_checkout_before_order_review()
{
    echo '<h3 style="background: #f8f8f8;padding: 7px 0 7px 0;text-align: center;">Выберите способ оплаты</h3>';
}

add_filter('comment_form_default_fields', 'crunchify_disable_comment_url');
function crunchify_disable_comment_url($fields)
{
    unset($fields['url']);
    return $fields;
}

/**
 * Add new section to WP profile and create custom fields
 */
function affwp_custom_extra_profile_fields($user)
{
    if (is_object($user)) {
        $actual_address = esc_attr(get_the_author_meta('actual_address', $user->ID));
        $billing_partner = esc_attr(get_the_author_meta('billing_partner', $user->ID));
        $promocod_partner = esc_attr(get_the_author_meta('promocod_partner', $user->ID));
    } else {
        $actual_address = null;
        $billing_partner = null;
        $promocod_partner = null;
    }
    ?>

    <h3>Адрес партнера</h3>
    <table class="form-table">
        <tr>
            <th><label for="actual_address">Фактический адрес</label></th>
            <td>
                <input type="text" name="actual_address" id="actual_address"
                       value="<?php echo $actual_address; ?>"
                       class="regular-text"/><br/>
            </td>
        </tr>
    </table>
    <h3>Платежная информация партнера</h3>
    <table class="form-table">
        <tr>
            <th><label for="billing_partner">Форма оплаты</label></th>
            <td>
                <input type="text" name="billing_partner" id="billing_partner"
                       value="<?php echo $billing_partner; ?>"
                       class="regular-text"/><br/>
            </td>
        </tr>
    </table>
    <h3>Промокод партнера</h3>
    <table class="form-table">
        <tr>
            <th><label for="promocod_partner">Промокод</label></th>
            <td>
                <input type="text" name="promocod_partner" id="promocod_partner"
                       value="<?php echo $promocod_partner; ?>"
                       class="regular-text"/><br/>
            </td>
        </tr>
    </table>

<?php }

add_action('show_user_profile', 'affwp_custom_extra_profile_fields');
add_action('edit_user_profile', 'affwp_custom_extra_profile_fields');
add_action("user_new_form", 'affwp_custom_extra_profile_fields');

/**
 * Save the fields when the values are changed on the profile page
 */
function affwp_custom_save_extra_profile_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id))
        return false;
    update_user_meta($user_id, 'billing_partner', $_POST['billing_partner']);
    update_user_meta($user_id, 'actual_address', $_POST['actual_address']);
    update_user_meta($user_id, 'promocod_partner', $_POST['promocod_partner']);

}

add_action('user_register', 'affwp_custom_save_extra_profile_fields');
add_action('profile_update', 'affwp_custom_save_extra_profile_fields');
add_action('personal_options_update', 'affwp_custom_save_extra_profile_fields');
add_action('edit_user_profile_update', 'affwp_custom_save_extra_profile_fields');


/*************************Описание точки выдачи при оформлении заказа*****************************/
/*add_action('woocommerce_review_order_before_local_pickup_location', 'local_pickup_instructions');
function local_pickup_instructions()
{
    ?>
    <p style="font-weight: 500;padding: 3px;margin-bottom: 16px;border-bottom: 1px solid #f19321;">Выберите пункт самовывоза из выпадающего списка</p>
    <?php
}*/


add_filter('woocommerce_default_address_fields', 'bbloomer_override_postcode_validation');
function bbloomer_override_postcode_validation($address_fields)
{
    $address_fields['postcode']['required'] = false;
    $address_fields['postcode']['label'] = 'Почтовый индекс (для почты РФ)';
    $address_fields['city']['label'] = 'Город (населенный пункт)';

    return $address_fields;
}


add_action('pre_user_query', 'tgm_order_users_by_date_registered');
function tgm_order_users_by_date_registered($query)
{
    global $pagenow;
    if (!is_admin() || 'users.php' !== $pagenow) {
        return;
    }
    $query->query_orderby = 'ORDER BY user_registered DESC';
}

/*add_filter( 'option_active_plugins', 'lg_disable_plugin' );
function lg_disable_plugin($plugins){

    $plugins_not_needed = array();

    if( $_SERVER['REQUEST_URI'] ==  '/checkout/') {
        $key = array_search( 'wp-store-locator/wp-store-locator.php' , $plugins );
        if ( false !== $key ) {
            unset( $plugins[$key] );
        }
    }

    return $plugins;
}*/

/****************************Store Locator Custom Templates and Custom Fields***************************/

add_filter('wpsl_templates', 'custom_templates');
function custom_templates($templates)
{

    /**
     * The 'id' is for internal use and must be unique ( since 2.0 ).
     * The 'name' is used in the template dropdown on the settings page.
     * The 'path' points to the location of the custom template,
     * in this case the folder of your active theme.
     */
    $templates[] = array(
        'id' => 'custom',
        'name' => 'Custom template',
        'path' => get_stylesheet_directory() . '/' . 'wpsl-templates/custom.php',
    );

    return $templates;
}




add_action('admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');
function wpdocs_enqueue_custom_admin_style()
{
    $role = 'cashier';
    $user = wp_get_current_user();

    if (in_array($role, (array)$user->roles)) {

        wp_register_style('cashier_admin_style', get_stylesheet_directory_uri() . '/css/cashier-admin-style.css', false, '1.0.0');
        wp_enqueue_style('cashier_admin_style');

    }

}

add_action('admin_init', 'redirect_so_15396771');
function redirect_so_15396771()
{
    $role = 'cashier';
    $user = wp_get_current_user();

    if ($_SERVER['REQUEST_URI'] == '/wp-admin/' && in_array($role, (array)$user->roles)) {
        wp_redirect('/wp-admin/admin.php?page=wc_pos_registers', 301);
        exit;
    }

    if ($_SERVER['REQUEST_URI'] == '/wp-admin/index.php' && in_array($role, (array)$user->roles)) {
        wp_redirect('/wp-admin/admin.php?page=wc_pos_registers', 301);
        exit;
    }
}