<?php

namespace Tarikul\PostViewCount;

/**
 * Shortcode Class
 */
class Shortcode
{
    /**
     * Constructor method 
     */
    public function __construct()
    {
        // add shortcode 
        add_shortcode('post_view_counter', [$this, 'post_views_counter']);
    }

    /**
     * Shortocde Hanlder 
     */
    public function post_views_counter($atts)
    {
        $default_values = [
            'id' => null,
        ];

        $attributes = shortcode_atts($default_values, $atts);

        if (empty($attributes['id'])) {
            return "<p>Please provide a valid post id</p>";
        }

        // Start output buffering
        ob_start();

        // Include the HTML content from a separate file
        // include POST_VIEW_COUNT_PLUGIN_DIR . 'views/shortcode-content.php';
        new Content($attributes['id']);

        // Get the buffered content and clean the buffer
        $html = ob_get_clean();

        // Return the HTML content
        return $html;

    }

}