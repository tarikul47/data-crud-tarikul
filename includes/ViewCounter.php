<?php

namespace Tarikul\PostViewCount;

class ViewCounter
{

    /**
     * Constructor method 
     */
    public function __construct()
    {
        // post view functions 
        add_action('wp_head', [$this, 'count_post_views']);
    }
    /**
     * Post views number processing 
     */
    public function count_post_views()
    {
        if (is_single()) {
            $post_id = get_the_ID();
            $views = get_post_meta($post_id, 'post_views', true);
            $views = $views ? $views : 0;
            $views++;
            update_post_meta($post_id, 'post_views', $views);
        }
    }
}