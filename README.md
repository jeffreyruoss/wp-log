# WP Log
A log system for custom child themes and custom plugins.



## Setup
Add this to your custom child theme or plugin:
    
    /**
     * Setup for the WP Log plugin
     */
    
    function wpl( $type, $title, $content ) {
        if ( function_exists('wpl_create_log_entry') ) {
            wpl_create_log_entry($type, $title, $content);
        }
        else {
            error_log('Function not found: wpl_create_log_entry()');
        }
    }


## Create a log entry 

    wpl( 'error', 'This is my title', 'This is my log data.' );

Pass a string, array or object through the $content arg.
    
If it's a mix of strings, array and or objects use print_r like this:
    
    $content = print_r(array('one', 'two'), true) . ' More log message text.;
    
    wpl( 'error', 'My log message text.', $content );
    

The above will appear something like this in the log:

![WPL error screenshot](wpl-error-readme-screenshot.png "WPL error screenshot")

Log entry types are:
 - error
 - warning
 - info
 - success
