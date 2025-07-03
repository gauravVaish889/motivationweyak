<?php
namespace Eventin\Event;

use Eventin\Abstracts\Provider;

/**
 * Event Provider Class
 */
class EventProvider extends Provider {
    /**
     * Store all services
     *
     * @var array
     */
    protected $services = [
        EventTemplate::class,
    ];
}
