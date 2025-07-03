<?php
/**
 * Admin Assets Class
 * 
 * @package Eventin
 */
namespace Eventin\Enqueue;

/**
 * Admin Scripts and Styles class
 */
class AdminAssets implements AssetsInterface {

    /**
     * Register scripts
     *
     * @return  array
     */
    public static function get_scripts() {
        $scripts = [
            //TODO: make deps load dynamically
            'etn-packages' => [
                'src'       => \Wpeventin::plugin_url( 'build/js/packages.js' ),
                'deps'      => ['moment', 'react', 'react-dom', 'wp-api-fetch', 'wp-block-editor', 'wp-block-library', 'wp-blocks', 'wp-components', 'wp-compose', 'wp-data', 'wp-element', 'wp-hooks', 'wp-html-entities', 'wp-i18n', 'wp-keyboard-shortcuts', 'wp-primitives', 'wp-url'],
                'in_footer' => false,
            ],
            'etn-app-index'     => [
                'src'       => \Wpeventin::plugin_url( 'build/js/index-calendar.js' ),
                'deps'      => [ 'jquery' ],
                'in_footer' => true,
            ],
            'etn-onboard-index' => [
                'src'       => \Wpeventin::plugin_url( 'build/js/index-onboard.js' ),
                'deps'      => [ 'jquery',],
                'in_footer' => true,
            ],
            'etn-ai' => [
                'src'       => \Wpeventin::plugin_url( 'build/js/index-ai-script.js' ),
                'deps'      => [ 'jquery', 'wp-scripts' ],
                'in_footer' => true,
            ],
             'etn-html-2-canvas' => [
                'src'       => \Wpeventin::plugin_url( 'assets/lib/js/html2canvas.min.js' ),
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-dashboard' => [
                'src'       => \Wpeventin::plugin_url( 'build/js/dashboard.js' ),
                'deps'      => ['etn-packages', 'wp-format-library','etn-html-2-canvas'],
                'in_footer' => true,
            ],
        ];

           
        return apply_filters( 'etn_admin_register_scripts', $scripts );
    }




    /**
     * Get styles
     *
     * @return  array
     */
    public static function get_styles() {
        $styles = [
            'etn-onboard-index'    => [
                'src' => \Wpeventin::plugin_url( 'build/css/index-onboard.css' ),
            ],
            'etn-ai'    => [
                'src' => \Wpeventin::plugin_url( 'build/css/index-ai-style.css' ),
            ],
            'etn-dashboard'    => [
                'src' => \Wpeventin::plugin_url( 'build/css/dashboard.css' ),
                'deps' => ['wp-edit-blocks']
            ],
            'etn-event-manager-admin'    => [
                'src' => \Wpeventin::plugin_url( 'build/css/event-manager-admin.css' ),
            ],
        ];

        return apply_filters( 'etn_admin_register_styles', $styles );
    }
}