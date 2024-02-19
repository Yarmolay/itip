<?php

if ( !class_exists('ACF_Active')) {
    class ACF_Active {
        /**
         * if ACF active
         **/
        static function install() {
            if ( !in_array('advanced-custom-fields/acf.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
                deactivate_plugins(__FILE__);
                $error_message = __('This plugin requires <a href="https://uk.wordpress.org/plugins/advanced-custom-fields/">ACF</a> plugin to be active!', '');

                die($error_message);
            }
        }
    }
}

register_activation_hook(__FILE__, array('ACF_Active', 'install'));