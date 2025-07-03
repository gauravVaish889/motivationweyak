<?php
/**
 * Extension Controller
 *
 * @package Eventin
 */

namespace Eventin\Extensions\Api;
use Eventin\Extensions\Extension;
use Eventin\Extensions\PluginManager;
use Eventin\Input;
use WP_Error;
use WP_HTTP_Response;
use WP_REST_Controller;

/**
 * Extension Controller
 *
 */
class ExtensionController extends WP_REST_Controller {

    /**
     * Store api namespace
     *
     * @since 4.0.13
     *
     * @var string $namespace
     */
    protected $namespace = 'eventin/v2';

    /**
     * Store rest base
     *
     * @since 4.0.13
     *
     * @var string $rest_base
     */
    protected $rest_base = 'extensions';

    /**
     * Register routes
     *
     * @return void
     */
    public function register_routes() {
        /*
         * Register route
         */
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_items'],
                'permission_callback' => function () {
                    return current_user_can( 'etn_manage_addons' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => \WP_REST_Server::EDITABLE,
                'callback'            => [$this, 'update_item'],
                'permission_callback' => function () {
                    return current_user_can( 'etn_manage_addons' );
                },
            ],
        ] );

    }

    /**
     * Get all extensions
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  WP_Rest_Response
     */
    public function get_items( $request ) {
        $type = ! empty( $request['type'] ) ? $request['type'] : 'all';

        $types = [
            'module' => Extension::modules(), 
            'addon'  => Extension::addons(),
            'plugin' => Extension::plugins(),
            'all'    => Extension::get()
        ];

        return rest_ensure_response( $types[$type] );
    }

    /**
     * Enable or disable extension
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Response | WP_Error
     */
    public function update_item( $request ) {
        $input_data = json_decode( $request->get_body(), true );

        $input  = new Input( $input_data );
        $name   = $input->get('name');
        $status = $input->get('status');

        $statuses = ['off', 'on', 'install', 'activate', 'deactivate'];

        if ( ! $name ) {
            return new WP_Error( 'extension_name_error', __( 'Please enter extension name', 'eventin' ), ['status' => 422] );
        }

        if (  ! $status ) {
            return new WP_Error( 'extension_status_error', __( 'Please enter status', 'eventin' ), ['status' => 422] );
        }

        if ( ! in_array( $status, $statuses ) ) {
            return new WP_Error( 'extension_status_error', __( 'Please enter status on/off', 'eventin' ), ['status' => 422] );
        }

        if ( ! Extension::find( $name ) ) {
            return new WP_Error( 'invalid_extension', __( 'Invalid extension.', 'eventin' ), ['status' => 422] );
        }

        $update = Extension::update( $name, $status );  
        
        if ( is_wp_error( $update ) ) {
            return new WP_Error( 'update_error', strip_tags($update->get_error_message()), ['status' => 422] );
        }

        if ( ! $update ) {
            return new WP_Error( 'update_error', __( 'Extension couldn\'t ' . $status, 'eventin' ), ['status' => 422] );
        }

        $response = [
            'message' => __( 'Successfully updated', 'eventin' ),
        ];

        return rest_ensure_response( $response );
    }
}
