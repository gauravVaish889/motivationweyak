<?php
/**
 * Jove API Handle
 *
 * @package Jove
 */

namespace Jove\Inc;

/**
 * Class Utils
 */
class Jove_API {
    public function __construct(){

    }
    /**
     * Fetches data from an API.
     *
     * @param string $url The API URL.
     * @param array  $params The parameters to be appended to the URL as a query string.
     *
     * @return array|string The API response as an associative array, or an error message.
     */
    public static function fetch_jove_api_data( $url , $type ='get',  $post_body = [] ) {        
        $args = [
            'headers' => [
                'x-api-key'    => JOVE_VIDEO_API_KEY,
            ],
            'timeout' => 15,
        ];
        // Fetch API response
        if ( $type === 'post' ) {
            $args['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
            $args['body'] = $post_body;
        $response = wp_remote_post( $url, $args );
        } else {
            $response = wp_remote_get( $url, $args );
        }
        // Check for errors
        if (is_wp_error($response)) {
            $error_code = $response->get_error_code(); // Error Code
            $error_message = $response->get_error_message(); // Error Message
            $error_message = isset($error_message) ? $error_message : 'Error fetching data';
            $return_arr = [
                'error' => true,
                'code' => $error_code,
                'message' => $error_message
            ];
            // return $return_arr;
        }

        // Get the response body
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true); // Convert JSON to an associative array
       
        $return_arr = [
            'success' => true,
            'code' => 200,
            'data' => $data
        ];
        return $return_arr??[];
    }
}