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
     * @return void
     */
    public function add_pages(): void
    {
        $this->add('login', [
            'post_name' => 'login',
            'post_title' => __('page.login', 'comblock-auth'),
            'post_content' => '<!-- wp:shortcode -->[comblock_login]<!-- /wp:shortcode -->',
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);

        $this->add('dashboard', [
            'post_name' => 'dashboard',
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
        $this->delete('login');
        $this->delete('dashboard');
    }

    /**
     * @since 1.0.0
     * @return WP_Post
     */
    public function get_login(): WP_Post
    {
        $slug = apply_filters("comblock_auth_page_get_login", 'login');

        return $this->get($slug);
    }

    /**
     * @since 1.0.0
     * @return WP_Post
     */
    public function get_dashboard(): WP_Post
    {
        $slug = apply_filters("comblock_auth_page_get_dashboard", 'dashboard');

        return $this->get($slug);
    }
}
