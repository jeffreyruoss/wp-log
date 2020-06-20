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

function wpl_create_log_entry($type, array $content) {
    $log_args = array(
        'post_title' => $type,
        'post_type' => 'log',
        'post_status' => 'private',
        'meta_input' => array(
            'content' => $content
        )
    );

    wp_insert_post($log_args);
}
