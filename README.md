# WP Log
A log system for custom child themes and custom plugins.


    $r_log_content = array(
        'message',
        array(
            '1' => 'one',
            '2' => 'two'
        ),
        'another message'
    );
    
    r_log('success', $r_log_content );
