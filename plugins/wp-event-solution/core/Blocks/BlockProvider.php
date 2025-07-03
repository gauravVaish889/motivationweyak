<?php
namespace Eventin\Blocks;

use Eventin\Abstracts\Provider;

/**
 * BlockProvider class
 */
class BlockProvider extends Provider {
    /**
     * Store services
     *
     * @var array
     */
    protected $services = [
        BlockTypesController::class
    ];
}