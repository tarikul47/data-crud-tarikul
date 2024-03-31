<?php
namespace Tarikul\PostViewCount;

/**
 * Shortcode Conent Class 
 */
class Content
{
    // current post id 
    private $id;

    /**
     * Constructor method 
     */
    public function __construct($post_id)
    {
        // post id assign 
        $this->id = $post_id;

        // Shortocde assign 
        $this->shortcode_cotent();
    }

    /**
     * Shortcode Conent 
     */
    public function shortcode_cotent()
    {
        $views = get_post_meta($this->id, 'post_views', true);
        ?>
        <div class="view-count-box">
            <div class="view-count-box__child">
                <p class="view-count-box__child___content">Page views</p>
                <span class="view-count-box__child___content__text">Total Views</span>
                <span class="view-count-box__child___content">
                    <?php echo isset($views) ? number_format(esc_html($views)) : 0; ?>
                </span>
            </div>
        </div>
        <?php
    }

}