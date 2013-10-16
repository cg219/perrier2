<? 
    get_template_part("consts");
    get_header();
?>
<body>
    <? get_template_part("nav"); ?>
    <div class="div wrap" id="wrapper">
        <div class="container" id="main">
            <h2>Search Results for "<? echo get_search_query(); ?>"</h2>
            <?
                global $query_string;
                $query_string = esc_attr($query_string); // Escaping search queries to eliminate potential MySQL-injections
                $blogs = get_blog_list(0, 'all');
                $allposts = array();
                foreach ($blogs as $blog):
                    switch_to_blog($blog['blog_id']);
                    $search = new WP_Query($query_string . "&posts_per_page=3");
                    if ($search->found_posts > 0) :
                        foreach ($search->posts as $post):
                            setup_postdata($post);
                            $thepost = new stdClass();
                            $cats = array();
                            $terms2 = wp_get_post_terms(get_the_ID(), "primary_category");
                            for( $i=0; $i < count($terms2); $i++){
                                array_push($cats, $terms2[$i]);
                            }

                            $thepost->categories = $cats;
                            $thepost->has_thumb = has_post_thumbnail();
                            $thepost->thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumb');
                            $thepost->permalink = get_permalink();
                            $thepost->title = get_the_title();
                            $thepost->excerpt = $post->post_excerpt;
                            $thepost->termlink = get_term_link($cats[0]);
                            $thepost->time = get_the_time("U");

                            array_push($allposts, $thepost);
                        endforeach;
                    endif;
                    restore_current_blog();
                endforeach;

                function sort_func($a, $b){
                    if( $a->time == $b->time ) return 0;

                    return ($a->time > $b->time) ? -1 : 1;
                }

                uasort($allposts, sort_func);

                foreach($allposts as $post):

            ?>
            <div class="media article">
                <a href="<? echo $post->permalink; ?>" class="pull-left">
                    <? 
                        if( $post->has_thumb ) :
                            $img = $post->thumb;
                    ?>
                        <img src="<? echo $img[0]; ?>" class="media-object" />
                    <? else :?>
                    <img src="" alt="">
                    <? endif; ?>
                </a>
                <div class="media-body">
                    <? $thisCat = $post->termlink; ?>
                    <h5><a href="<? echo $thisCat->errors ? "" : $thisCat;?>"><? echo $post->categories[0]->name; ?></a></h5>
                    <h3><a href="<? echo $post->permalink; ?>"><? echo $post->title; ?></a></h3>
                    <p><? echo $post->excerpt; ?> <a class="readmore" href="<? echo $post->permalink; ?>">Read More</a></p>
                </div>
            </div>
            <? endforeach; ?>
        </div>
        <? get_sidebar(); ?>
    </div>
    <? get_footer(); ?>
