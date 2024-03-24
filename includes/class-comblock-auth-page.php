<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Page extends Comblock_Auth_Post_Manager
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
     * @var string $slug_login
     */
    protected string $slug_login = 'login';

    /**
     * @since 1.0.0
     * @access protected
     * @var string $slug_dashboard
     */
    protected string $slug_dashboard = 'dashboard';

    /**
     * @since 1.0.0
     * @return void
     */
    public function add_pages(): void
    {
        $this->add($this->slug_login, [
            'post_name' => $this->slug_login,
            'post_title' => __('page.login', 'comblock-auth'),
            'post_content' => '<!-- wp:shortcode -->[comblock_login]<!-- /wp:shortcode -->',
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);

        $this->add($this->slug_dashboard, [
            'post_name' => $this->slug_dashboard,
            'post_title' => __('page.dashboard', 'comblock-auth'),
            'post_content' => '<!-- wp:shortcode -->[comblock_dashboard]<!-- /wp:shortcode -->',
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function delete_pages(): void
    {
        $this->delete($this->slug_login);
        $this->delete($this->slug_dashboard);
    }

    /**
     * @since 1.0.0
     * @return WP_Post
     */
    public function get_login(): WP_Post
    {
        $slug = apply_filters("comblock_auth_page_get_login", $this->slug_login);

        return $this->get($slug);
    }

    /**
     * @since 1.0.0
     * @return WP_Post
     */
    public function get_dashboard(): WP_Post
    {
        $slug = apply_filters("comblock_auth_page_get_dashboard", $this->slug_dashboard);

        return $this->get($slug);
    }
}
