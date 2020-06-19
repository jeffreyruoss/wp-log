# WP Log
A log system for custom child themes and custom plugins.



## Setup
Add this to your custom child theme or plugin:
    
    /**
     * Setup for the WP Log plugin
     */
    
    function wpl( $message, array $content ) {
        if ( function_exists('wpl_create_log_entry') ) {
            wpl_create_log_entry($message, $content);
        }
        else {
            error_log('Function not found: wpl_create_log_entry()');
        }
    }


## Create a log entry 
wpl() takes a string for the log entry type <br>and an array of log items that you want to show (they can be strings or arrays):

    $wpl_content = array(
        'My log message text.',
        array(
            '1' => 'one',
            '2' => 'two'
        ),
        'More log message text.'
    );
    
    wpl('success', $wpl_content );

The above will appear like this in the log:

![WPL error screenshot](wpl-error-readme-screenshot.png "WPL error screenshot")

Log entry types are:
 - error
 - warning
 - info
 - success
