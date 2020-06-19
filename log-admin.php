<?php
/**
 * Log admin page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


/**
 * Add log admin menu item
 */

function wpl_log_admin_menu_item() {
    add_menu_page( 'Log', 'Log', 'manage_options', 'log.php', 'wpl_log_admin_page', 'dashicons-text-page', 30  );
}

add_action( 'admin_menu', 'wpl_log_admin_menu_item' );


/**
 * Log admin page
 */

function wpl_log_admin_page(){
    ?>
    <div class="wrap">
        <h2>Log</h2>

        <form role="search" method="get" class="search-form" action="/wp-admin/admin.php" style="display: flex; flex-wrap: wrap; margin-top: 15px;">
            <label style="flex: 1;">
                <span class="screen-reader-text">Search for:</span>
                <input type="search" class="search-field" placeholder="Search …" value="" name="s" style="width: 100%;">
                <input type="hidden" name="page" value="log.php">
            </label>
            <input type="submit" class="search-submit" value="Search" style="margin-left: 10px; cursor: pointer;">
        </form>

        <p class="searched">
            <?php
            if (isset($_GET['s'])) {
                echo 'You searched: <span style="font-weight: bold;">' . $_GET['s'] . '</span> <a href="admin.php?page=log.php">clear this search</a>';
            }
            ?>
        </p>

        <p><a href="#" class="log-expand-all">Expand all</a> | <a href="#" class="log-contract-all">Contract all</a></p>

        <script>
            jQuery('.log-expand-all').on('click', function(e){e.preventDefault();jQuery('.r-log-entries li').addClass('log-entry-expanded')});
            jQuery('.log-contract-all').on('click', function(e){e.preventDefault();jQuery('.r-log-entries li').removeClass('log-entry-expanded')});
        </script>

        <?php

        $paged = ( $_GET['paged'] ) ? $_GET['paged'] : '';

        $per_page = 10;

        if ( isset($_GET['s']) ) {
            $search_keywords = htmlspecialchars($_GET['s']);
        }

        $args = array(
            'posts_per_page' => $per_page,
            'paged' => $paged,
            'post_type' => 'logs',
            's' => $search_keywords
        );

        $the_query = new WP_Query( $args );

        $max_pages = $the_query->max_num_pages;
        $nextpage = $paged + 1;

        if ( $the_query->have_posts() ) :
            ?>
            <style>
                .r-log-entries { background: #fff; padding: 0; border-radius: 5px; color: #444; overflow: hidden; }
                .r-log-entries li { display: flex; border-bottom: 1px solid #eee; padding: 5px; margin-bottom: 0; position: relative; }
                .r-log-entries li:last-child { border-bottom: none; }
                .r-log-entries .log-entry-time { margin-right: 15px; padding-top: 4px; flex: 0 0 212px; color: #8672a7; }
                .r-log-entries .log-entry-type { margin-right: 15px; color: #fff; padding: 3px 7px 5px; border-radius: 3px; background-color: #9e9e9e; min-width: 62px; text-align: center; text-transform: uppercase; display: block; height: 17px; }
                .r-log-entries .log-entry-type-info { background-color: #5495C5; }
                .r-log-entries .log-entry-type-warning { background-color: #EBAD3E; }
                .r-log-entries .log-entry-type-error { background-color: #BD2F34; }
                .r-log-entries .log-entry-type-success { background-color: #69A955; }
                .r-log-entries .log-entry-content { white-space: nowrap; overflow: hidden; }
                .r-log-entries .log-entry-content:after { content: "..."; position: absolute; right: 0; top: 0; background-color: #fff; padding-top: 9px; padding-left: 5px; padding-right: 5px; color: #0073aa; }
                .r-log-entries .log-entry-content p { margin: 0; }
                .r-log-entries .log-entry-content .array { }

                .r-log-entries li:hover { cursor: pointer; background-color: aliceblue; }
                .r-log-entries li:hover .log-entry-content:after { background-color: aliceblue; }
                .r-log-entries li.log-entry-expanded { }
                .r-log-entries li.log-entry-expanded .log-entry-content { overflow: visible; }
                .r-log-entries li.log-entry-expanded .log-entry-content .log-text { display: block;}
                .r-log-entries li.log-entry-expanded .log-entry-content .log-array { white-space: pre;}
                .r-log-entries li.log-entry-expanded .log-entry-content:after { display: none; }
            </style>
            <ul class="r-log-entries contracted">
                <?php
                while ( $the_query->have_posts() ) : $the_query->the_post();
                    ?>
                    <li>
                        <span class="log-entry-time"><?php echo get_post_time("d-M-Y H:i:s T" ); ?></span>
                        <span class="log-entry-type log-entry-type-<?php echo get_the_title();?>"><?php the_title(); ?></span>
                        <span class="log-entry-content">
                            <?php
                            $content = get_post_meta(get_the_ID(), 'content');
                            foreach($content[0] as $item) {
                                if (is_array($item)) {
                                    echo '<span class="log-array">';
                                    print_r($item);
                                    echo '</span>';
                                }
                                else {
                                    echo '<span class="log-text">' .  $item . ' </span>';
                                }
                            }
                            ?>
                        </span>
                    </li>
                <?php
                endwhile;
                ?>
            </ul>
            <script>
                jQuery('.r-log-entries li').on('click', function() {
                    jQuery('.r-log-entries li').removeClass('log-entry-expanded');
                    jQuery(this).addClass('log-entry-expanded');
                });
            </script>

        <?php if ($paged == '') {$paged = 1;} ?>

            <style>.log-entries-pagination > * { display: block; margin-right: 15px; }</style>
            <div class="log-entries-pagination" style="display: flex; flex-wrap: wrap; align-items: center;">
                <span><?php echo 'Per page: ' . $per_page ; ?></span>
                <span><?php echo 'Total: ' . $the_query->found_posts; ?></span>
                <span><?php echo 'Page '. $paged . ' of ' . $max_pages;?></span>
                <a href="admin.php?page=log.php&paged=<?php echo $paged - 1; ?>"><button <?php echo $paged <= 1 ? 'disabled' : ''; ?> style="cursor: pointer;">Newer</button></a>
                <a href="admin.php?page=log.php&paged=<?php echo $paged + 1; ?>"><button <?php echo $paged == $max_pages ? 'disabled' : ''; ?> style="cursor: pointer;">Older</button></a>
            </div>
            <?php

            wp_reset_postdata();

        else:
            echo 'Sorry, no posts matched your criteria.';
        endif; ?>
    </div>
    <?php
}
