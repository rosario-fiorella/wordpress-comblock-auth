<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes/pages
 */
class Comblock_Auth_Page_Dashboard extends Comblock_Auth_Post_Repository
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $post_type
     */
    protected string $post_type = 'page';

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->set_slug('comblock-auth-dashbaord');

        $this->set_args();
    }

    /**
     * @since 1.0.0
     */
    public function set_args(): void
    {
        $this->set_arg('post_name', $this->slug);
        $this->set_arg('post_title', __('page.dashboard', 'comblock-auth'));
        $this->set_arg('post_content', '<!-- wp:shortcode -->[comblock_dashboard]<!-- /wp:shortcode -->');
        $this->set_arg('post_status', 'publish');
        $this->set_arg('post_type', $this->post_type);
    }

    /**
     * @since 1.0.0
     * @throws RuntimeException
     */
    public function validate_post(): void
    {
        $post = $this->get_post();

        if (!has_shortcode($post->post_content, 'comblock_dashboard')) {
            throw new RuntimeException(__('error.validation.post', 'comblock-auth'));
        }
    }
}
