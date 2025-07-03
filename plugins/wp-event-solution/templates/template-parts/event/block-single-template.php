<?php 
use Etn\Core\Event\Event_Model;
use Eventin\Template\TemplateModel;

if ( wp_is_block_theme() ) {
    block_header_area();
    wp_head();
} else {
    get_header();
}
    
    $default_template_name = [
        'event-one'     => 'event-template-one',
        'event-two'     => 'event-template-two',
        'event-three'   => 'event-template-three',
    ];

    $event_id = get_the_ID();
    $event    = new Event_Model( $event_id );

    $template_id = $event->event_layout;

    if ( ! $template_id ) {
        $template_id = etn_get_option( 'event_template', 'event-one' );
    }

    $template = new TemplateModel( $template_id );

    if ( $template && get_post_type( $template_id ) == 'etn-template' ) {
        $template->render_content();
    } else {
        $template->render_content( $default_template_name[$template_id] );
    }
    
    if ( wp_is_block_theme() ) {
        block_footer_area();
        wp_footer();
    } else {
        get_footer();
    }
?>
