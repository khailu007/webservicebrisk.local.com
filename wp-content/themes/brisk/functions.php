<?php

/**
 * Brisk functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Brisk
 */
defined('ABSPATH') || exit;
$uicore_settings = get_option( 'uicore_theme_options_admin', [] );
$uicore_settings['purchase_info'] = [
	'code' => '*****'
];
update_option( 'uicore_theme_options_admin', $uicore_settings );
update_option( 'uicore_connect', array('url' => get_site_url(), 'token' => '********-****-****-****-************'));
//Global Constants
define('UICORE_THEME_VERSION', '5.0.4');
define('UICORE_THEME_NAME', 'Brisk');
define('UICORE_FRAMEWORK_VERSION', '5.0.4');

$brisk_includes = array(
	'/setup.php',
	'/default.php',
	'/template-tags.php',
	'/plugin-activation.php'
);

foreach ($brisk_includes as $file) {
	require_once get_template_directory() . '/inc' . $file;
}


//Rquired
if ( ! isset( $content_width ) ) {
	$content_width = 1000;
}
if ( is_singular() ) {
	wp_enqueue_script( "comment-reply" );
}

//disable element pack self update
function ui_disable_plugin_updates( $value ) {

    $pluginsToDisable = [
        'bdthemes-element-pack/bdthemes-element-pack.php',
        'metform-pro/metform-pro.php'
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ($pluginsToDisable as $plugin) {
            if ( isset( $value->response[$plugin] ) ) {
                unset( $value->response[$plugin] );
            }
        }
    }
    return $value;
}
add_filter( 'site_transient_update_plugins', 'ui_disable_plugin_updates' );