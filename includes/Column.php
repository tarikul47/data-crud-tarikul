<?php

namespace Tarikul\PostViewCount;

/**
 * Post Column Class
 */
class Column
{
    /**
     * Constructor method 
     */
    public function __construct()
    {
        // add post column 
        add_filter('manage_posts_columns', [$this, 'manage_posts_columns']);
        //display column data
        add_action('manage_posts_custom_column', [$this, 'manage_posts_custom_column'], 10, 2);

        add_filter('manage_edit-post_sortable_columns', [$this, 'add_sortable_column']);
    }

    /**
     * Column add
     */
    public function manage_posts_columns($columns)
    {
        $columns['view_count'] = __('Post View Number', 'post-view-count');
        $columns['shortcode'] = __('Views Shortcode', 'post-view-count');
        return $columns;
    }
    /**
     * Column content 
     */
    public function manage_posts_custom_column($column, $post_id)
    {
        if ($column == 'shortcode') {
            echo '[post_view_counter id="' . esc_html($post_id) . '"]';
        } elseif ($column == 'view_count') {
            $views = get_post_meta($post_id, 'post_views', true);
            echo isset($views) ? esc_html($views) : '0';
        }
    }

    function add_sortable_column($columns)
    {
        $columns['view_count'] = 'view_count';
        return $columns;
    }

}