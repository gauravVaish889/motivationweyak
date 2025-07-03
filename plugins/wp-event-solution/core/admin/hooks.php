<?php
/**
 * Admin Hooks Class
 *
 * @package Eventin
 */
namespace Etn\Core\Admin;

use Etn\Base\Exporter\Post_Exporter;
use Etn\Base\Importer\Post_Importer;
use Etn\Core\Event\Event_Model;
use Etn\Traits\Singleton;
use Eventin\Integrations\Zoom\ZoomCredential;
use Eventin\Template\CPT;
use Eventin\Template\DefaultTemplate;
use Eventin\Upgrade\Upgrade;
use Eventin\Upgrade\Upgraders\V_4_0_8;
use WP_Error;
use Wpeventin;
use Wpeventin_Pro;

/**
 * Admin Hooks Class
 */
class Hooks {
    use Singleton;

    /**
     * Initialize
     *
     * @return  void
     */
    public function init() {
        $this->handle_buy_pro_module();

        add_filter( 'eventin_settings', [$this, 'add_settings'] );

        add_filter( 'get_edit_post_link', [ $this, 'modifiy_event_edit_link' ], 10, 2 );

        add_action( 'in_plugin_update_message-' . Wpeventin::plugins_basename(), function( $plugin_data ) {
            $this->version_update_warning( Wpeventin::version(), $plugin_data['new_version'] );
        } );

        add_action( 'admin_init', [ $this, 'do_upgrade' ] );

        add_action( 'admin_init', [$this, 'etn_speaker_group_insert_to_user'] );

        add_filter( 'eventin_settings', [ $this, 'update_extra_field_settings' ] );

        add_action( 'eventin_event_updated', [ $this, 'update_seat_price' ] );

        add_action( 'eventin_event_after_clone', [ $this, 'update_clone_event_sold_tickets' ] );

        add_action( 'init', [$this, 'register_post_type' ] );

        add_action( 'init', [ $this, 'proxy_image' ] );

        add_action( 'after_setup_theme', [ $this, 'etn_activation_redirect' ], 99 );

        new \Etn\Core\Event\Api();

        // Todo: Temporary added this function for version compatibility. Need to remove this after 4.0.21
        add_action( 'admin_notices', [ $this, 'eventin_pro_admin_notice' ] );
        $this->add_eventin_pro_plugin_upgrade_notice();
    }

    /**
     * Get post ids
     *
     * @param   string  $post_type
     *
     * @return  array
     */
    private function get_post_ids( $post_type ) {
        $args = [
            'post_type'   => $post_type,
            'numberposts' => -1,
            'post_status' => 'publish',
            'fields'      => 'ids',
        ];

        $posts = get_posts( $args );

        return $posts;
    }

    /**
     * Added settings
     *
     * @param   array  $settings
     *
     * @return  array
     */
    public function add_settings( $settings ) {
        $payment_method = etn_get_option( 'payment_method' );
        $sells_engine   = etn_get_option( 'etn_sells_engine_stripe' ) ?: 'woocommerce';
        $payment_method = $payment_method ? $payment_method : $sells_engine; 

        $new_settings = [
            'wc_enabled'         => function_exists( 'WC' ),
            'payment_method'     => $payment_method,
            'plugin_version'     => Wpeventin::version(),  
            'modules'            => get_option( 'etn_addons_options' ),
            'zoom_authorize_url' => ZoomCredential::get_auth_url(),
            'event_url_editable' => etn_event_url_editable(),
            'email'              => etn_get_email_settings(), 
            'etn_settings_country_currency' => etn_currency(),
            'decimal_separator'  => etn_get_decimal_separator(),
            'thousand_separator' => etn_get_thousand_separator(),
            'decimals'           => etn_get_decimals(),
            'price_format'       => etn_get_price_format(),
            'currency_position'  => etn_get_currency_position(),
            'wc_order_status_list' => etn_get_wc_order_status_list(), 
            'wc_order_statuses'    => etn_get_wc_order_statuses(),
            'show_ticket_expiry_date'  => etn_get_option( 'show_ticket_expiry_date', false ),
            "add_to_cart_redirect"     => etn_get_option( 'add_to_cart_redirect','checkout' ),
            "order_thank_you_redirect" => etn_get_option( 'order_thank_you_redirect','eventin_thankyou' ),
        ];

        return array_merge( $settings, $new_settings );
    }

    /**
     * Modify event edit link
     *
     * @param   string  $link
     * @param   integer  $post_id
     *
     * @return  string
     */
    public function modifiy_event_edit_link( $link, $post_id ) {
        $post_type = get_post_type( $post_id );

        if ( 'etn' !== $post_type ) {
            return $link;
        }

        $url = admin_url( "admin.php?page=eventin#/events/create/{$post_id}/basic" );

        return $url;
    }

    /**
     * Plugin upgrade warning notification
     *
     * @param   string  $current_version  Plugin current version
     * @param   string  $new_version      Plugin new version
     *
     * @return  void
     */
    public function version_update_warning( $current_version, $new_version ) {
        if ( version_compare( $current_version, $new_version, '>=',  ) ) {
            return;
        }

        ?>
            <hr class="e-major-update-warning__separator" />
            <div class="e-major-update-warning">
                <div class="e-major-update-warning__icon">
                    <i class="eicon-info-circle"></i>
                </div>
                <div>
                    <div class="e-major-update-warning__title">
                        <?php echo esc_html__('Heads up! Please backup before upgrading!', 'eventin'); ?>
                    </div>
                    <div class="e-major-update-warning__message">
                        <?php
                        printf(
                            esc_html__( 'Eventin 4.0, the latest version, includes major changes across different areas of the plugin. For a smooth transition, we strongly advise you to backup your site before upgrading and testing it in a staging environment first.', 'eventin' )
                        );
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }

    public function migrate_speaker_organizer() {
        $installed_version = get_option( 'etn_version' );
        $upgrade_versions  = ['4.0.0'];

        if ( $installed_version && version_compare( $installed_version, end( $upgrade_versions ), '<' ) ) {
            return;
        }

        $args = [
            'post_type'      => 'etn',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        ];
        $events = [];

        $post_query   = new \WP_Query();
        $query_result = $post_query->query( $args );

        foreach ( $query_result as $post ) {
            $event = new Event_Model( $post->ID );

            $this->migrate_event_speaker_organizer( $event );
        }
    }

    /**
     * Migrate event speaker and organizer
     *
     * @param   Event_Model  $event  [$event description]
     *
     * @return  void
     */
    protected function migrate_event_speaker_organizer( $event ) {
        $organizer = get_post_meta( $event->id, 'etn_event_organizer', true );
        $speaker   = get_post_meta( $event->id, 'etn_event_speaker', true );

        

        $speaker_category   = get_term_by( 'slug', 'speaker', 'etn_speaker_category' );
        $organizer_category = get_term_by( 'slug', 'organizer', 'etn_speaker_category' );

        if ( $speaker_category ) {
            $speaker_category = $speaker_category->term_id;
        }

        if ( $organizer_category ) {
            $organizer_category = $organizer_category->term_id;
        }

        if ( $organizer ) {
            $event->update( [
                'etn_event_organizer' => $this->prepare_organizer(),
                'organizer_type'      => 'group',
                'organizer_group'     => [$organizer_category],
            ] );
        }

        if ( $speaker ) {
            $event->update( [
                'etn_event_speaker' => $this->prepare_speaker(),
                'speaker_type'      => 'group',
                'speaker_group'     => [$speaker_category],
            ] );
        }
    }

    /**
     * Get organizer by term slug
     *
     * @return  array
     */
    protected function prepare_organizer() {
        $args = array(
            'numberposts'   => -1,
            'post_type'     => 'etn-speaker',
            'post_status'   => 'any',
            'fields'        => 'ids',
            
            'tax_query' => array(
                'relation' => 'AND',
                [
                    'taxonomy' => 'etn_speaker_category',
                    'field'    => 'slug',
                    'terms'    => 'organizer'
                ]
            )
        );

        $organizers = get_posts( $args );

        return $organizers;
    }

    /**
     * Get speaker by term slug
     *
     * @return  array
     */
    protected function prepare_speaker() {
        $args = array(
            'numberposts'   => -1,
            'post_type'     => 'etn-speaker',
            'post_status'   => 'any',
            'fields'        => 'ids',
            
            'tax_query' => array(
                'relation' => 'AND',
                [
                    'taxonomy' => 'etn_speaker_category',
                    'field'    => 'slug',
                    'terms'    => 'speaker'
                ]
            )
        );

        $speakers = get_posts( $args );

        return $speakers;
    }

    /**
     * Upgrade the plugin migration
     *
     * @return  void
     */
    public function do_upgrade() {
        $db_migration    = get_option( 'etn_db_migration' );
        $current_version = Wpeventin::version();

        if ( ! $db_migration || version_compare( $current_version, $db_migration, '>' ) ) {
            
            Upgrade::register();
            update_option( 'etn_db_migration', $current_version, true );
        }
    }

    /**
     * Include speaker group to user
     * 
     * @since 4.0.7
     * return void
     */
    public function etn_speaker_group_insert_to_user() {

        // Check if the 'Uncategorized' term exists in the 'etn_speaker_category' taxonomy
        $term = term_exists('Uncategorized', 'etn_speaker_category');

        // If the term doesn't exist, create it
        if ( ! $term ) {
            $term = wp_insert_term( 'Uncategorized', 'etn_speaker_category' );
        }
        // Get the term_id
        $term_id    = is_array( $term ) ? $term['term_id'] : '';
        $args       = array(
            'role__in' => array('etn-speaker', 'etn-organizer'),
            'meta_key' => 'etn_speaker_group',
            'meta_compare' => 'NOT EXISTS'
        );
    
        $users      = get_users( $args );
    
        if ( $users ) {
            foreach ( $users as $user ) {
                update_user_meta($user->ID, 'etn_speaker_group', $term_id, true);
            }

            // Determine the 'etn_speaker_category' value based on the user's role
            if ( in_array('etn-speaker', $user->roles ) ) {
                $category_value = ['speaker'];
            } elseif ( in_array('etn-organizer', $user->roles) ) {
                $category_value = ['organizer'];
            }

            // Update or add the 'etn_speaker_category' user meta
            update_user_meta($user->ID, 'etn_speaker_category', $category_value, true);
        }
        
    }

    /**
     * Update settins extra fields
     *
     * @param   array  $settings
     *
     * @return  array
     */
    public function update_extra_field_settings( $settings ) {
        $extra_fields = $extra_fields = etn_get_option( 'extra_fields', [] ) ?: etn_get_option( 'attendee_extra_fields', [] );

        $settings['extra_fields'] = $extra_fields;
        unset($settings['attendee_extra_fields']);

        return $settings;
    }
    
    /**
     * Update seat price when update event tickets
     *
     * @param   Event_Model  $event  [$event description]
     *
     * @return  void
     */
    public function update_seat_price( $event ) {
        $event_id          = $event->id;
        $tickets           = $event->etn_ticket_variations;
        $seats             = $event->seat_plan;

        if ( ! $seats ) {
            return;
        }

        foreach ( $seats as $seat_key => $seat ) {
            $ticket_price = $event->get_ticket_price_by_name( $seat['ticketType'] );

            if ( 'table' === $seat['type'] ) {
                $chairs = [];
                foreach( $seat['chairs'] as $chair_key => $chair ) {
                    $chair['price'] = $ticket_price;

                    $chairs[] = $chair;
                }
                $seats[$seat_key]['chairs'] = $chairs;
            } else {
                $seats[$seat_key]['price'] = $ticket_price;
            }
        }
    
        $event->update( [
            'seat_plan' => $seats
        ] );
    }

    /**
     * Update sold tickets on event clone
     *
     * @param   Event_Model  $event  [$event description]
     *
     * @return  void
     */
    public function update_clone_event_sold_tickets( $event ) {
        $tickets = $event->etn_ticket_variations;

        if ( is_array( $tickets ) ) {
            foreach( $tickets as &$ticket ) {
                $ticket['etn_sold_tickets'] = 0;
            }
        }
        
        $event->update([
            'etn_ticket_variations' => $tickets
        ]);
    }
    
    /**
     * Register post type
     *
     * @return  void
     */
    public function register_post_type() {
        $template_post_type = new CPT();

        $template_post_type->register_post_type();
    }

    /**
     * Preapre proxi image for template builder
     *
     * @return  string
     */
    public function proxy_image() {
        $action = isset( $_GET['action'] ) ? $_GET['action'] : '';

        if ( $action !== 'proxy_image' ) {
            return;
        }

        ob_start();

        if ( $_SERVER['REQUEST_METHOD'] === 'OPTIONS' ) {
            http_response_code(200);
            ob_end_flush();
            exit;
        }

        $imageUrl = isset( $_GET['url'] ) ? $_GET['url'] : null;

        if ( $imageUrl ) {
            $imageContent = file_get_contents( $imageUrl );

            if ( $imageContent !== false ) {
                $finfo    = finfo_open( FILEINFO_MIME_TYPE );
                $mimeType = finfo_buffer( $finfo, $imageContent );
                finfo_close( $finfo );
                header("Content-Type: $mimeType");

                
                $tempStream = fopen('php://temp', 'r+');
                fwrite( $tempStream, $imageContent );
                rewind( $tempStream );

                fpassthru( $tempStream );
                fclose( $tempStream );
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(400);
        }

        ob_end_flush(); // End output buffering
    }

    /**
     * Show buy-pro menu if pro plugin not active
     *
     * @return void
     */
    public function handle_buy_pro_module() {

        /**
         * Show banner (codename: jhanda)
         */
        $filter_string = 'eventin,eventin-free-only';

        if ( class_exists( 'Wpeventin_Pro' ) ) {

            $filter_string .= ',eventin-pro';
            $filter_string = str_replace( ',eventin-free-only', '', $filter_string );

        }
        \Wpmet\Libs\Banner::instance('eventin')
            // ->is_test(true)
            ->set_filter(ltrim($filter_string, ','))
            ->set_api_url('https://demo.themewinter.com/public/jhanda')
            ->set_plugin_screens('toplevel_page_eventin')

             ->call();
    }

    /**
     * redirect to setup wizard when active pluginn
     *
     */
    public function etn_activation_redirect() {
        if ( ( ! get_option( 'etn_wizard' ) ) ) {
            update_option( 'etn_wizard', 'active' );
            wp_redirect( admin_url( 'admin.php?page=etn-wizard' ) );
            exit;
        }
    }

    /**
     * Add admin notice
     * if eventin is not acitve add notice to active eventin
     * if eventin pro version is 4.0.0 then add notice to required eventin verion 4.0.0
     * @return void
     */
    public function eventin_pro_admin_notice() {

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $message = '';

        $eventin_pro_required_version = '4.0.17';

        if ( class_exists( 'Wpeventin_Pro' ) && version_compare( Wpeventin_Pro::version(), '4.0.17', '<' ) ) {
            $message = sprintf(
                '<div class="notice notice-warning is-dismissible">
                    <p><strong>%s</strong> %s <a href="%s" target="_blank">%s</a></p>
                </div>',
                __( 'Important Update:', 'eventin' ),
                __( 'A new version of <strong>Eventin Pro</strong> is available with major improvements and new features. Please update to the latest version for the best experience.', 'eventin' ),
                esc_url( 'https://themewinter.com/eventin/pricing' ),
                __( 'Update Now', 'eventin' )
            );
        }

        if ( ! empty( $message ) ) {
            ?>
                <p>
                    <?php echo wp_kses_post( $message ); ?>                
                </p>
            <?php
        }
    }
    
    /**
     * Show plugin update notice for upgrade version
     *
     * @return  void
     */
    public function add_eventin_pro_plugin_upgrade_notice() {

        if ( ! class_exists( 'Wpeventin_Pro' ) ) {
            return;
        }

        require_once Wpeventin_Pro::plugin_dir() . 'utils/updater/edd-warper.php';
        require_once Wpeventin_Pro::core_dir() . 'License/Utils.php';

        $is_valid = \EventinPro\License\Utils::is_valid_license();

        if ( ! $is_valid ) {
            return;
        }

        $required_version = '4.0.17';
        $pro_version      = Wpeventin_Pro::version();

        if ( version_compare( $pro_version, $required_version, '<' ) ) {
            $license_key = \EventinPro\License\Utils::get_license_key();
            
            new \Etn_Pro\Utils\Updater\Edd_Warper(
                'https://themewinter.com',
                'eventin-pro/eventin-pro.php',
                array(
                    'version' => Wpeventin_Pro::version(),
                    'license' => $license_key,
                    'item_id' => '1013',
                    'author'  => 'themewinter',
                    'url'     => site_url(),
                )
            );
        }
    }
}
