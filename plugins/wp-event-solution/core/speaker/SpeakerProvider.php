<?php
namespace Eventin\Speaker;

use Eventin\Abstracts\Provider;

/**
 * Speaker Provider Class
 */
class SpeakerProvider extends Provider {
    /**
     * Store all services
     *
     * @var array
     */
    protected $services = [
        SpeakerTemplate::class
    ];
}
