<?php
namespace Eventin\Order;

use Etn\Core\Attendee\Attendee_Model;
use Etn\Core\Event\Event_Model;
use Eventin\Emails\AdminOrderEmail;
use Eventin\Emails\AttendeeOrderEmail;
use Eventin\Mails\Mail;
use WP_Error;
use WP_REST_Controller;
use WP_REST_Server;

/**
 * Payment controller class
 * 
 * @package Eventin
 */
class PaymentController extends WP_REST_Controller {
    /**
     * Constructor for PaymentController
     *
     * @return void
     */
    public function __construct() {
        $this->namespace = 'eventin/v2';
        $this->rest_base = 'payment';
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
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'create_payment'],
                'permission_callback' => [$this, 'create_payment_permission_check'],
            ],
            [
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => [$this, 'payment_complete'],
                'permission_callback' => [$this, 'create_payment_permission_check'],
            ],
        ] );
    }

    /**
     * Create payment persmission check
     *
     * @param   WP_REST_Request  $request
     *
     * @return  bool
     */
    public function create_payment_permission_check( $request ) {
        return true;
    }

    /**
     * Create payment itentents
     *
     * @param   WP_REST_Request  $request  
     *
     * @return  JSON
     */
    public function create_payment( $request ) {
        $data            = json_decode( $request->get_body(), true );
        $order_id        = ! empty( $data['order_id'] ) ? intval( $data['order_id'] ) : 0;
        $payment_method  = ! empty( $data['payment_method'] ) ? sanitize_text_field( $data['payment_method'] ) : '';


        $payment        = PaymentFactory::get_method( $payment_method );
        $order          = new OrderModel( $order_id );

        $response = $payment->create_payment( $order );

        if ( is_wp_error( $response ) ) {
            return new WP_Error( 'payment_error', $response->get_error_message() );
        }

        // Update payment id.
        $order->update([
            'payment_id'     => $response['id'],
            'payment_method' => $payment_method
        ]);

        return rest_ensure_response( $response );
    }

    /**
     * Payment complete
     *
     * @return  JSON
     */
    public function payment_complete( $request ) {
        $data            = json_decode( $request->get_body(), true );
        $order_id        = ! empty( $data['order_id'] ) ? intval( $data['order_id'] ) : 0;
        $payment_status  = ! empty( $data['payment_status'] ) ? $data['payment_status'] : 0;

        $order = new OrderModel( $order_id );

        if ( 'completed' === $order->status ) {
            return;
        }

        if ( 'success' !== $payment_status ) {
            return new WP_Error( 'payment_error', __( 'Failed to completed your order', 'eventin' ), ['status' => 422] );
        }

        if ( 'wc' === $order->payment_method && ! $this->wc_payment( $order_id ) ) {
            return new WP_Error( 'payment_error', __( 'Invalid payment', 'eventin' ), ['status' => 422] );
        }

        $order->update([
            'status' => 'completed'
        ]);

        do_action( 'eventin_order_completed', $order );
        $this->send_email( $order );

        $response = [
            'success' => true,
            'message' => __( 'Sucessfully payment updated', 'eventin' ),
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Send email after payment complete
     *
     * @param   OrderModel  $order  [$order description]
     *
     * @return  void
     */
    private function send_email( $order ) {
        $order->send_email();
    }

    /**
     * Check wc order is completed
     *
     * @param   integer  $eventin_order_id  [$eventin_order_id description]
     *
     * @return  bool
     */
    private function wc_payment( $eventin_order_id ) {
        $post_type = etn_is_enable_wc_synchronize_order() ? 'shop_order' : 'shop_order_placehold'; 

        $args = [
            'post_type'   => $post_type,
            'post_status' => 'any',
            'posts_per_page' => -1,
            'fields'          => 'ids',        
            'meta_query'    => [
                [
                    'key'   => 'eventin_order_id',
                    'value' => $eventin_order_id,
                    'compare' => '='
                ]
            ]
        ];


        $orders_ids = get_posts( $args );

        if ( ! $orders_ids ) {
            return false;
        }

        $order = wc_get_order( $orders_ids[0] );

        if ( ! $order ) {
            return false;
        }

        $statuses =  etn_get_wc_order_statuses();

        if ( ! in_array( $order->get_status(), $statuses ) ) {
            return false;
        }

        return true;
    }
}
