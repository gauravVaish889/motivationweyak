<?php
/**
 * Template Controller
 * 
 * @package Eventin
 */
namespace Eventin\Template\Api;

use Eventin\Template\DefaultTemplate;
use Eventin\Template\TemplateModel;
use WP_REST_Controller;
use WP_REST_Server;

class TemplateController extends WP_REST_Controller {
    /**
     * Constructor for TemplateController
     *
     * @return void
     */
    public function __construct() {
        $this->namespace = 'eventin/v2';
        $this->rest_base = 'templates';
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function register_routes() {
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_items'],
                'permission_callback' => [$this, 'get_item_permissions_check'],
            ],
        ]);
    }

    /**
     * Get collections  of template
     *
     * @param   WP_Rest_Request  $request  Rest request object
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function get_items( $request ) {
        $per_page = ! empty( $request['per_page'] ) ? intval( $request['per_page'] ) : 20;
        $paged    = ! empty( $request['paged'] ) ? intval( $request['paged'] ) : 1;
        $status   = ! empty( $request['status'] ) ? sanitize_text_field( $request['status'] ) : '';
        $type     = ! empty( $request['type'] ) ? sanitize_text_field( $request['type'] ) : '';
        $search_keyword = ! empty( $request['search'] ) ? sanitize_text_field( $request['search'] ) : '';

        $args = [
            'post_type'      => 'etn-template',
            'post_status'    => 'any',
            'posts_per_page' => $per_page,
            'paged'          => $paged,
        ];

        if ( 'all' === $type ) {
            $type = '';
        }

        if ( ! empty( $status ) ) {
            $args['post_status'] = $status;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            $args['author'] = get_current_user_id(); 
        }

        $meta_query = [];

        if ( $search_keyword ) {
            $args['s'] = $search_keyword;
        }

        if ( ! empty( $type ) ) {
            $meta_query[] = [
                'key'     => 'type',
                'value'   => $type,
                'compare' => '=',
            ];
        }

        if ( ! empty( $meta_query ) ) {
            $args['meta_query'] = $meta_query;   
        }

        $post_query   = new \WP_Query();
        $query_result = $post_query->query( $args );
        $total_posts  = $post_query->found_posts;
        $templates    = [];

        foreach( $query_result as $post ) {
            $template = new TemplateModel( $post->ID );
            $templates[] = $this->prepare_item_for_response( $template, $request );
        }

        $response = rest_ensure_response( $templates );
    
        $response->header( 'X-WP-Total', $total_posts );
    
        return $response;
    }

    /**
     * Prepare item for response
     *
     * @param   TemplateModel  $item     [$item description]
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  array
     */
    public function prepare_item_for_response( $item, $request ) {
        $response = [
            'id'            => $item->id,
            'name'          => $item->get_name(),
            'status'        => $item->get_status(),
            'type'          => $item->get_type(),
            'orientation'   => $item->get_orientation(),
            'thumbnail'     => $item->thumbnail,
            'content'       => $item->get_content(),
            'is_clone'      => $item->is_clone,
            'is_pro'        => $item->is_pro,
            'edit_with_elementor' => $this->check_post_edit_with_elementor( $item->id ),
            'template_css'  => $item->template_css,
        ];

        return $response;
    }

    /**
     * Get item permission check
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function get_item_permissions_check( $request ) {
        return true;
    }

    /**
     * Disable Elementor for a given post
     *
     * @param int $post_id The ID of the post to disable Elementor for
     * @return void
     */
    public function check_post_edit_with_elementor( $post_id ) {

        if ( ! did_action( 'elementor/loaded' ) ) {
            return false;
        }

        // Get the Elementor document for the post
        $document = \Elementor\Plugin::$instance->documents->get( $post_id );
        
        // Check if the post is built with Elementor
        $built_with_elementor =  $document->is_built_with_elementor();
        
        return $built_with_elementor;
    }
}
