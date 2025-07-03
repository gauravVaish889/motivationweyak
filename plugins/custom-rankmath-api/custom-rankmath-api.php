<?php
/*
Plugin Name: Custom Rank Math SEO API
Description: Provides a custom REST API to update Rank Math SEO metadata using post slug.
Version: 1.0
Author: Gaurav Vaish
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

add_action('rest_api_init', function () {
    register_rest_route('custom-rankmath/v1', '/export-meta', [
        'methods'  => 'GET',
        'callback' => 'custom_export_meta_to_excel',
    ]);
});

function custom_export_meta_to_excel($request) {
    require_once __DIR__ . '/vendor/autoload.php'; // Path to PhpSpreadsheet autoload

    $limit = intval($request->get_param('limit') ?? 500);
    if ($limit <= 0 || $limit > 10000) {
        return new WP_Error('invalid_param', 'Limit must be between 1 and 10000.', ['status' => 400]);
    }

    $args = [
        'post_type'      => 'video',
        'post_status'    => 'publish',
        'posts_per_page' => $limit,
        'orderby'        => 'ID',
        'order'          => 'ASC',
        'fields'         => 'ids',
    ];

    $post_ids = get_posts($args);

    if (empty($post_ids)) {
        return new WP_Error('no_posts', 'No posts found.', ['status' => 404]);
    }

    // Prepare Excel
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Meta Export');

    $sheet->setCellValue('A1', 'Post ID');
    $sheet->setCellValue('B1', 'Slug');
    $sheet->setCellValue('C1', 'Meta Title');
    $sheet->setCellValue('D1', 'Meta Description');

    $row = 2;
    foreach ($post_ids as $post_id) {
        $meta_title = get_post_meta($post_id, 'rank_math_title', true);
        $meta_description = get_post_meta($post_id, 'rank_math_description', true);
        $post_guid = get_the_guid($post_id);
        $sheet->setCellValue("A$row", $post_id);
        $sheet->setCellValue("B$row", $post_guid);
        $sheet->setCellValue("C$row", $meta_title);
        $sheet->setCellValue("D$row", $meta_description);
        $row++;
    }

    // Generate unique filename and save to wp-content/uploads
    $upload_dir = wp_upload_dir();
    $upload_path = trailingslashit($upload_dir['basedir']);
    $filename = 'meta_export_' . time() . '.xlsx';
    $file_path = $upload_path . $filename;

    // Save Excel file
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($file_path);

    // Return download URL
    $file_url = trailingslashit($upload_dir['baseurl']) . $filename;

    return rest_ensure_response([
        'file_url' => $file_url,
        'message'  => 'Excel file created successfully.',
    ]);
}




add_action('rest_api_init', function () {
    register_rest_route('custom-rankmath/v1', '/update-seo', [
        'methods'  => 'POST',
        'callback' => 'custom_update_rank_math_meta'
    ]);
});

function custom_update_rank_math_meta($request) {
    $params = $request->get_json_params();

    // Normalize single object to array
    if (isset($params['slug'])) {
        $params = [$params];
    }

    if (!is_array($params)) {
        return new WP_Error('invalid_payload', 'Request body must be a JSON object or an array of objects.', ['status' => 400]);
    }

    $responses = [];

    foreach ($params as $index => $item) {
        $slug          = sanitize_text_field($item['slug'] ?? '');
        $title         = sanitize_text_field($item['title'] ?? '');
        $description   = sanitize_text_field($item['description'] ?? '');
        $focus_keyword = sanitize_text_field($item['focus_keyword'] ?? '');

        if (empty($slug)) {
            $responses[] = [
                'success' => false,
                'slug'    => null,
                'message' => 'Missing slug at index ' . $index
            ];
            continue;
        }

        $post = get_page_by_path($slug, OBJECT, 'post');

        if (!$post) {
            $responses[] = [
                'success' => false,
                'slug'    => $slug,
                'message' => 'Post not found.'
            ];
            continue;
        }

        $post_id = $post->ID;

        if (!empty($title)) {
            update_post_meta($post_id, 'rank_math_title', $title);
        }

        if (!empty($description)) {
            update_post_meta($post_id, 'rank_math_description', $description);
        }

        if (!empty($focus_keyword)) {
            update_post_meta($post_id, 'rank_math_focus_keyword', $focus_keyword);
        }

        $responses[] = [
            'success' => true,
            'slug'    => $slug,
            'post_id' => $post_id,
            'message' => 'Metadata updated successfully.'
        ];
    }

    return rest_ensure_response($responses);
}


add_action('rest_api_init', function () {
    register_rest_route('custom-rankmath/v1', '/post/(?P<slug>[a-zA-Z0-9-_]+)', array(
        'methods' => 'GET',
        'callback' => 'custom_get_rank_math_meta',
    ));
});

function custom_get_rank_math_meta($request) {
    $slug = $request->get_param('slug');
    $post = get_page_by_path($slug, OBJECT, 'video');

    if (!$post) {
        return new WP_Error('post_not_found', 'Post not found.', ['status' => 404]);
    }

    $post_id = $post->ID;

    $data = [
        'post_id'                   => $post_id,
        'slug'                      => $slug,
        'rank_math_title'           => get_post_meta($post_id, 'rank_math_title', true),
        'rank_math_description'     => get_post_meta($post_id, 'rank_math_description', true),
        'rank_math_focus_keyword'   => get_post_meta($post_id, 'rank_math_focus_keyword', true),
    ];

    return rest_ensure_response($data);
}



add_action('rest_api_init', function () {
    register_rest_route('custom-rankmath/v1', '/generate-meta', [
        'methods'  => 'POST',
        'callback' => 'custom_generate_rank_math_meta',
    ]);
});

function custom_generate_rank_math_meta($request) {
    $params = $request->get_json_params();
    $limit  = intval($params['limit'] ?? 100);     // Recommended: 100–1000
    $offset = intval($params['offset'] ?? 0);       // For pagination
    if ($limit <= 0 || $limit > 10000) {
        return new WP_Error('invalid_param', 'Limit must be between 1 and 10000.', ['status' => 400]);
    }
    set_time_limit(300);
    $args = [
    'post_type'        => 'video',
    'post_status'      => 'publish',
    'posts_per_page'   => $limit,
    'offset'           => $offset,
    'orderby'          => 'ID',
    'order'            => 'ASC',
    'fields'           => 'ids',
    'suppress_filters' => false,
    'meta_query'       => [
        'relation' => 'AND',
        [
            'key'     => 'rank_math_title',
            'compare' => 'NOT EXISTS',
        ],
        [
            'key'     => 'rank_math_description',
            'compare' => 'NOT EXISTS',
        ],
    ],
];

    $post_ids = get_posts($args);
    $last_id = null;
    $updated_count = 0;

    foreach ($post_ids as $post_id) {
        $post = get_post($post_id);

        $existing_meta = get_post_meta($post_id, 'rank_math_title', true);
        if (!empty($existing_meta)) {
            continue;
        }

        $post_title   = wp_strip_all_tags($post->post_title);
        $post_excerpt = wp_strip_all_tags($post->post_excerpt ?: wp_trim_words($post->post_content, 55, ''));

        $prompt = "Generate a meta description (under 160 characters) for a video about making a volcano using baking soda and vinegar. Ensure the description includes the phrase \"Experimemt Video -\ at the start of every description.:
        Title: $post_title
        Description: $post_excerpt

        Respond in JSON format:
        {
          \"meta_title\": \"...\",
          \"meta_description\": \"...\"
        }";

        $api_response[$post_id] = call_chatgpt_api($prompt);

        
        // Optional delay to avoid hitting rate limits
        sleep(1);
    }
    
        // Process API response
        if (empty($api_response)) {
            return new WP_Error('api_error', 'Failed to generate metadata from API.', ['status' => 500]);
        }

        // Update post meta with generated data
      $updated_posts = [];

        foreach ($api_response as $post_id => $api_response) {
            if (isset($api_response['meta_title']) && isset($api_response['meta_description'])) {
                $meta_title = $api_response['meta_title'];
                $meta_description = $api_response['meta_description'];

                update_post_meta($post_id, 'rank_math_title', $meta_title);
                update_post_meta($post_id, 'rank_math_description', $meta_description);

                error_log("✅ Updated Post ID: $post_id");
                $last_id = $post_id;
                $updated_count++;
                $updated_posts[] = $post_id;
            } else {
                error_log("❌ Post ID $post_id: Failed to generate meta.");
            }
        }
        $last_two_posts = array_slice($updated_posts, -10);
        $last_two_data = array_map(function($id) {
             return [
                    'ID'                => $id,
                    'title'             => get_the_title($id),
                    'link'              => get_permalink($id),
                    'rank_math_title'   => get_post_meta($id, 'rank_math_title', true),
                    'rank_math_description' => get_post_meta($id, 'rank_math_description', true),
                ];
        }, $last_two_posts);

        return rest_ensure_response([
            'pro_offcessed_count'        => count($post_ids),
            'updated_count'          => $updated_count,
            'last_updated_post_id'   => $last_id,
            'last_two_updated_posts' => $last_two_data,
            'nextset'            => $offset + $limit,
            'has_more'               => count($post_ids) === $limit
        ]);

}

function call_gemini_api($prompt) {
    $api_key = 'AIzaSyBncsYudNV02txTh-k-J1fB4XTTX_Qz-A4';
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$api_key";

    $body = json_encode([
        'contents' => [
            [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ]
    ]);

    $response = wp_remote_post($url, [
        'headers' => ['Content-Type' => 'application/json'],
        'body'    => $body,
        'timeout' => 30,
    ]);

    if (is_wp_error($response)) {
        error_log('API call failed: ' . $response->get_error_message());
        return null;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!empty($data['candidates'][0]['content']['parts'][0]['text'])) {
        $raw_text = $data['candidates'][0]['content']['parts'][0]['text'];
        $clean_text = trim(preg_replace('/^```json|```$/m', '', $raw_text));
        $meta_data = json_decode($clean_text, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $meta_data;
        } else {
            error_log('JSON decode error: ' . json_last_error_msg());
        }
    }

    return null;
}

function call_chatgpt_api($prompt) {
    $api_key = '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'; // Replace with your real API key
    $url = 'https://api.openai.com/v1/chat/completions';

    $body = json_encode([
        'model' => 'gpt-4o',  // or 'gpt-3.5-turbo' for cheaper, faster results
        'messages' => [
            ['role' => 'system', 'content' => 'You are an SEO assistant. Output JSON with meta_title and meta_description.'],
            ['role' => 'user', 'content' => $prompt],
        ],
        'temperature' => 0.7,
    ]);

    $response = wp_remote_post($url, [
        'headers' => [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $api_key,
        ],
        'body'    => $body,
        'timeout' => 30,
    ]);

    if (is_wp_error($response)) {
        error_log('ChatGPT API call failed: ' . $response->get_error_message());
        return null;
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!empty($data['choices'][0]['message']['content'])) {
        $raw_text = $data['choices'][0]['message']['content'];
        $clean_text = trim(preg_replace('/^```json|```$/m', '', $raw_text));
        $meta_data = json_decode($clean_text, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $meta_data;
        } else {
            error_log('JSON decode error: ' . json_last_error_msg());
        }
    }

    return null;
}
