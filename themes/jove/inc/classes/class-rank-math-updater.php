<?php
/**
 * Rank Math Updater
 *
 * @package Jove
 */

namespace Jove\Inc;

use Jove\Inc\Traits\Singleton;
use Jove\Inc\Utils;

/**
 * Handles API data loading.
 *
 * @package Jove
 */
class Rank_Math_Updater {

	use Singleton;

	private $post_type = 'video';       // Replace with your custom post type
    private $taxonomy = 'keyword';      // Replace with your custom taxonomy
    private $limit = 100;              // Posts to process per cycle
    private $option_name = 'jove_rank_math_update_offset';
    private $cron_hook = 'jove_rank_math_update_cron';

	/**
	 * Constructor.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Setup hooks.
	 */
	protected function setup_hooks() {

		add_filter( 'cron_schedules', [ $this, 'add_cron_interval' ] );
		add_action( 'init', [ $this, 'initialize' ] );
		add_action( 'init', [ $this, 'check_completion' ] );
		add_action( $this->cron_hook, [ $this, 'update_keywords' ] );
	}

	/**
     * Add custom 5-minute cron interval
     */
    public function add_cron_interval($schedules) {
        $schedules['every_3_minutes'] = array(
            'interval' => 180, // 3 minutes in seconds
            'display'  => __('Every 3 Minutes'),
        );
        return $schedules;
    }

    /**
     * Initialize the update process
     */
    public function initialize() {
        if (false === get_option($this->option_name)) {
            update_option($this->option_name, 0);
            $this->schedule_cron();
        }
    }

    /**
     * Schedule the cron event
     */
    private function schedule_cron() {
        if (!wp_next_scheduled($this->cron_hook)) {
            wp_schedule_event(time(), 'every_3_minutes', $this->cron_hook);
        }
    }

    /**
     * Main function to update focus keywords
     */
    public function update_keywords() {
        $offset = (int) get_option($this->option_name, 0);

        $args = array(
            'post_type'      => $this->post_type,
            'posts_per_page' => $this->limit,
            'offset'         => $offset,
            'orderby'        => 'ID',
            'order'          => 'ASC',
            'post_status'    => 'publish',
            'fields'         => 'ids',
        );

        $posts = get_posts($args);

        if (empty($posts)) {
            $this->cleanup();
            return;
        }

        foreach ($posts as $post_id) {
            // Check if the meta value is already set
            $existing_keyword = get_post_meta($post_id, 'rank_math_focus_keyword', true);

            // Only update if the meta value is empty
            if (empty($existing_keyword)) {
                $terms = wp_get_post_terms($post_id, $this->taxonomy, array('fields' => 'names'));

                if (!empty($terms) && !is_wp_error($terms)) {
                    $focus_keyword = implode(', ', $terms);
                    update_post_meta($post_id, 'rank_math_focus_keyword', $focus_keyword);
                }
            }
        }

        update_option($this->option_name, $offset + $this->limit);
    }

    /**
     * Check if processing is complete and clean up
     */
    public function check_completion() {
        $offset = get_option($this->option_name);

        if (false !== $offset) {
            $args = array(
                'post_type'      => $this->post_type,
                'posts_per_page' => 1,
                'offset'         => $offset,
                'fields'         => 'ids',
            );

            if (empty(get_posts($args))) {
                $this->cleanup();
            }
        }
    }

    /**
     * Cleanup options and cron when done
     */
    private function cleanup() {
        delete_option($this->option_name);

        $timestamp = wp_next_scheduled($this->cron_hook);
        if ($timestamp) {
            wp_unschedule_event($timestamp, $this->cron_hook);
        }
    }
}