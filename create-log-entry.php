<?php
/**
 * Create log entry
 *
 * @param $type
 * @param array $content
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

function r_log($type, array $content) {
    $log_args = array(
        'post_title' => $type,
        'post_type' => 'logs',
        'post_status' => 'private',
        'meta_input' => array(
            'content' => $content
        )
    );

    wp_insert_post($log_args);
}
