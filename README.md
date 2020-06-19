# WP Log
A log system for custom child themes and custom plugins.


    $wpl_content = array(
        'message',
        array(
            '1' => 'one',
            '2' => 'two'
        ),
        'another message'
    );
    
    wpl('success', $r_log_content );
