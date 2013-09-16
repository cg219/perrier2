<?
get_template_part("consts");
get_header();
?>
<body>
    <? get_template_part("nav"); ?>
    <div class="div wrap" id="wrapper">
        <div class="container" id="main">
            <?
            $searchfor = get_search_query(); // Get the search query for display in a headline
            ?>

            <h1>Search results for <?php echo $searchfor; ?>;'</h1>

            <?php
            $query_string = esc_attr($query_string); // Escaping search queries to eliminate potential MySQL-injections
            $blogs = get_blog_list(0, 'all');
            foreach ($blogs as $blog):
                switch_to_blog($blog['blog_id']);
                $search = new WP_Query($query_string);
                if ($search->found_posts > 0) {
                    foreach ($search->posts as $post) {
                        setup_postdata($post);
                        $author_data = get_userdata(get_the_author_meta('ID'));
                        ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <p>
                                <span><?php the_time('Y/m/d') ?></span>
                                By <?php the_author_posts_link(); ?> </p>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div id="entry-content"><?php the_excerpt(); ?>
                            </div>

                        </div>
            <?php
        }
    }
endforeach;
restore_current_blog(); // Reset settings to the current blog
?>
        </div>
            <? get_sidebar(); ?>
    </div>
            <? get_footer(); ?>



