<?php
namespace Eventin\Schedule;

use Eventin\Abstracts\Provider;

/**
 * Schedule Provider Class
 */
class ScheduleProvider extends Provider {
    /**
     * Store all schedule related services
     *
     * @var array
     */
    protected $services = [
        ScheduleTemplate::class
    ];
}
