<?php
/**
 * Create log entry
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

function wpl_create_log_entry($type, $title, $content) {
    $log_args = array(
        'post_title' => $title,
        'post_type' => 'log',
        'post_status' => 'private',
        'meta_input' => array(
            'type' => $type,
            'content' => $content
        )
    );

    wp_insert_post($log_args);
}
