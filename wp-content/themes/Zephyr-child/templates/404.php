<?php defined('ABSPATH') OR die('This script cannot be accessed directly.');
/**
 * The template for displaying the 404 page
 */
US_Layout::instance()->sidebar_pos = 'none';
?>
<?php get_header() ?>
<div class="l-main">
    <div class="l-main-h i-cf">

        <div class="l-content">

            <section class="l-section">
                <div class="l-section-h i-cf">

                    <?php do_action('us_before_404') ?>


                    <?php

                    $the_content = '<style>.l-section-h {padding:0!important;}.notfound{background:url(https://euroroaming.ru/wp-content/uploads/2016/06/bg.png) no-repeat;width:1103px;height:711px;margin:0 auto;position:relative;top:-2px}.notfound-url{background:url(https://euroroaming.ru/wp-content/uploads/2016/06/404-url.png) no-repeat;width:295px;height:100px;display:block;position:absolute;bottom:41px;right:152px}</style><div class="notfound"><a href="/" class="notfound-url"></a></div>';
                    echo apply_filters('us_404_content', $the_content);

                    ?>


                    <?php do_action('us_after_404') ?>

                </div>
            </section>

        </div>

    </div>
</div>
<?php get_footer() ?>
