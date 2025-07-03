<?php
/**
 * Template Model class
 * 
 * @package Eventin
 */
namespace Eventin\Template;

use Etn\Base\Post_Model;
use Etn\Core\Attendee\Attendee_Model;
use Etn\Core\Event\Event_Model;

/**
 * Template Model
 */
class TemplateModel extends Post_Model {
    /**
     * Store post type
     *
     * @var string
     */
    protected $post_type = 'etn-template';

    /**
     * Template properties
     *
     * @var array
     */
    protected $data = [
        'type'          => '',
        'orientation'   => '',
        'is_clone'      => '',
        'is_pro'        => '',
        'thumbnail'     => '',
        'template_css'  => '',
    ];

    /**
     * Constructor for the TemplateModel class
     *
     * @param   mixed  $template
     *
     * @return  void
     */
    public function __construct( $template = 0) {
        parent::__construct( $template );
    }

    /**
     * Get template name
     *
     * @return  string  Return template title if post exist otherwise null
     */
    public function get_name() {
        $post = get_post( $this->id );

        if ( ! $post ) {
            return null;
        }

        return $post->post_title;
    }

    /**
     * Get template content
     *
     * @return  string  Return template content if post exist otherwise null
     */
    public function get_content() {
        $post = get_post( $this->id );

        if ( ! $post ) {
            return null;
        }

        return $post->post_content;
    }

    /**
     * Get template status
     *
     * @return  string  Return template content if post exist otherwise null
     */
    public function get_status() {
        $post = get_post( $this->id );

        if ( ! $post ) {
            return null;
        }

        return $post->post_status;
    }

    /**
     * Get template orientation
     *
     * @return  string  Return orientation Landscape or Protrait
     */
    public function get_orientation() {
        return $this->orientation;
    }

    /**
     * Get template type
     *
     * @return  string  Return template template type will be ticket, certificate, event
     */
    public function get_type() {
        return $this->type;
    }

    /**
     * Get placeholders
     *
     * @return  array
     */
    public function get_place_holder( $attendee_id ) {
        $attendee = new Attendee_Model( $attendee_id );
        $event    = new Event_Model( $attendee->etn_event_id );

        $date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' );

		$start_date   = date( $date_format, strtotime( $event->etn_start_date ) );
		$end_date     = date( $date_format, strtotime( $event->etn_end_date ) );

		$start_date_time = $event->etn_start_date . ' ' . $event->etn_start_time;

		$end_date_time = $event->etn_end_date . ' ' . $event->etn_end_time;

		$start_time	  = date( $time_format, strtotime( $start_date_time ) );
		$end_time	  = date( $time_format, strtotime( $end_date_time ) );

        return [
            '{{event_title}}'       => $event->get_title(),
            '{{event_location}}'    => $event->get_address(),
            '{{event_start_date}}'  => $start_date,
            '{{event_end_date}}'    => $end_date,
            '{{event_start_time}}'  => $start_time,
            '{{event_end_time}}'    => $end_time,
            '{{event_timezone}}'    => $event->event_timezone,
            '{{ticket_price}}'      => $attendee->etn_ticket_price,
            '{{ticket_type}}'       => $attendee->ticket_name,
            '{{payment_status}}'    => $attendee->etn_status,
            '{{ticket_id}}'         => $attendee->etn_unique_ticket_id,
            '{{attendee_name}}'     => $attendee->etn_name,
            '{{attendee_email}}'    => $attendee->etn_email,
            '{{attendee_phone}}'    => $attendee->etn_phone,
            '{{extra_fields}}'      => $attendee->get_extra_fields_content(),
            // '{{qr_code}}',
        ];
    }

    /**
     * Get html content
     *
     * @return  string
     */
    public function get_html_content() {
        return do_blocks( $this->add_proxy_image( $this->get_content() ) );
    }

    /**
     * Render html with actual value
     *
     * @param   array  $data  
     *
     * @return  
     */
    public function get_rendable_content( $attendee_id ) {
        if ( ! $attendee_id ) {
            return null;
        }

        $placeholder = $this->get_place_holder( $attendee_id );

        return strtr( $this->get_html_content(), $placeholder );
    }

    /**
     * Render html with actual value
     *
     * @param   array  $data  
     *
     * @return  
     */
    public function get_default_rendable_content( $attendee_id, $template_name ) {
        if ( ! $attendee_id ) {
            return null;
        }


        $placeholder = $this->get_place_holder( $attendee_id );

        $template = DefaultTemplate::get_template( $template_name );

        return strtr( $template['content'], $placeholder );
    }

    /**
     * Render block content
     *
     * @param   string  $template_name
     *
     * @return  void 
     */
    public function render_content( $template_name = '' ) {
        if ( ! $template_name ) {
            echo $this->get_html_content();
        } else {
            $template = DefaultTemplate::get_template( $template_name );

            echo $template['content'];
        }
    }

    /**
     * Render demo content
     *
     * @return  void
     */
    public function get_demo_content() {
        $placeholder = $this->get_demo_placeholder();

        return strtr( $this->get_html_content(), $placeholder );
    }

    /**
     * Get demo placeholder
     *
     * @return  array
     */
    public function get_demo_placeholder() {
        $date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' );

        return [
            '{{event_title}}'       => 'Event Title',
            '{{event_location}}'    => 'Springfield, IL 62701, United States',
            '{{event_start_date}}'  => date( $date_format ),
            '{{event_end_date}}'    => date( $date_format ),
            '{{event_start_time}}'  => date( $time_format ),
            '{{event_end_time}}'    => date( $time_format ),
            '{{event_timezone}}'    => 'America/New_York',
            '{{ticket_price}}'      => 500,
            '{{ticket_type}}'       => 'VIP',
            '{{payment_status}}'    => 'success',
            '{{ticket_id}}'         => 'sdjlkadf',
            '{{attendee_name}}'     => 'John Doe',
            '{{attendee_email}}'    => 'john@gmail.com',
            '{{attendee_phone}}'    => '995571089087',
            // '{{qr_code}}',
        ];
    }

    /**
     * Replace image and backgroud url for remote server
     *
     * @param   string  $content
     *
     * @return  string
     */
    public function add_proxy_image( $content ) {
        $proxy_url_base = site_url() . '?action=proxy_image&url=';

        // Replace all image url.
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $content, $matches);

        if ( ! empty( $matches[1] ) ) {
            foreach ( $matches[1] as $image_url ) {
                if ( ! $this->is_same_origin( $image_url ) ) {
                    $proxied_image_url = $proxy_url_base . urlencode($image_url);
                    $content = str_replace( $image_url, $proxied_image_url, $content );
                }
            }
        }

        // Replace all background image url
        preg_match_all( '/background-image\s*:\s*url\(["\']?([^"\')]+)["\']?\)/i', $content, $background_matches );

        if ( ! empty( $background_matches[1] ) ) {
            foreach ( $background_matches[1] as $bg_image_url ) {
        
                if ( ! $this->is_same_origin( $bg_image_url ) ) {
                    $proxied_bg_image_url = $proxy_url_base . urlencode( $bg_image_url );
                    $content = str_replace( $bg_image_url, $proxied_bg_image_url, $content );
                }
            }
        }

        return $content;
    }

    /**
     * Site url and requested url are same  or not
     *
     * @param   string  $url
     *
     * @return  bool
     */
    public function is_same_origin( $url ) {
        return strpos( $url, site_url() ) !== false;
    }
}
