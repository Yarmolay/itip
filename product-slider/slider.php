<?php
/**
* Plugin Name: Product Slider
* Plugin URI: https://localhost/
* Description: A custom plugin for product slider with ACF image. Create ACF image field 'product_cropper_image' for product
* Version: 1.0
* Author: My Plugin
*
**/

require ('ACF_Active.php');

add_action('wp_head', 'ps_slider_show');
function ps_slider_show(){
    if (is_product()) {
        $slider_image = get_field('product_cropper_image', get_the_ID());

        if ($slider_image) {
            wp_enqueue_style('style', plugin_dir_url(__FILE__).'assets/css/plugin.css');
            add_action( 'woocommerce_product_thumbnails', 'custom_product_add_thumbnails', 20, 0);
        }
    }
}

add_action( 'after_setup_theme', 'remove_woo_three_support', 11 );
function remove_woo_three_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}

add_filter( 'woocommerce_single_product_carousel_options', 'ps_slider_options' );
function ps_slider_options($options) {
    $options['controlNav']     = true;
    $options['slideshow']      = true;
    $options['touch']          = true;
    $options['animationLoop']  = true;
    $options['prevText']       = "<";
    $options['nextText']       = ">";
    $options['directionNav']   = true;

    return $options;
}
function custom_product_add_thumbnails(){
    ?>
    <div id="thumnail_markup" class="woocommerce-product-gallery__image">
        <?php echo wp_get_attachment_image( get_field('product_cropper_image', get_the_ID()), 'woocommerce_single', false, array( "class" => "" ) ); ?>
    </div>
    <?php
}
