<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes/pages
 */
class Comblock_Auth_Page_Login extends Comblock_Auth_Post_Manager
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $post_type
     */
    protected string $post_type = 'page';

    /**
     * @since 1.0.0
     * @access protected
     * @var string $slug
     */
    protected string $slug;

    /**
     * @since 1.0.0
     * @access protected
     * @var array<string, mixed> $args
     */
    protected array $args = [];

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->slug = apply_filters('comblock_auth_page_login_slug', 'login');

        $this->args = apply_filters('comblock_auth_page_login_options', [
            'post_name' => $this->slug,
            'post_title' => __('page.login', 'comblock-auth'),
            'post_content' => '<!-- wp:shortcode -->[comblock_login]<!-- /wp:shortcode -->',
            'post_status' => 'publish',
            'post_type' => $this->post_type
        ]);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function add_page(): void
    {
        $this->add($this->slug, $this->args);
    }

    /**
     * @since 1.0.0
     */
    public function delete_page(): void
    {
        $this->delete($this->slug);
    }

    /**
     * @since 1.0.0
     * @return WP_Post
     */
    public function get_page(): WP_Post
    {
        return $this->get($this->slug);
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function get_permalink(): string
    {
        $post = $this->get_page();

        return get_permalink($post->ID);
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function get_slug(): string
    {
        return $this->slug;
    }
}
