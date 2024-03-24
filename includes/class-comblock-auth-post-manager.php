<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Post_Manager
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $post_type
     */
    protected string $post_type = 'post';

    /**
     * @since 1.0.0
     * @param string $slug
     * @param array $options
     * @return int
     * @throws RuntimeException
     */
    public function add(string $slug, array $options = []): int
    {
        $slug = apply_filters("comblock_auth_{$slug}_add_slug", $slug);

        $post = get_page_by_path($slug, OBJECT, $this->post_type);

        if ($post) {
            return $post->ID;
        }

        $options = apply_filters("comblock_auth_{$slug}_add_options", $options);

        $id = wp_insert_post($options, true);

        if (is_wp_error($id)) {
            throw new RuntimeException($id->get_error_message(), $id->get_error_code());
        }

        return $id;
    }

    /**
     * @since 1.0.0
     * @param string $slug
     * @return void
     * @throws RuntimeException
     */
    public function delete(string $slug): void
    {
        $slug = apply_filters("comblock_auth_{$slug}_delete_slug", $slug);

        $post = get_page_by_path($slug, OBJECT, $this->post_type);

        if (!$post instanceof WP_Post) {
            throw new RuntimeException(__('error.post.not_found', 'comblock-auth'));
        }

        $result = wp_delete_post($post->ID);

        if (!$result) {
            throw new RuntimeException(__('error.post.delete', 'comblock-auth'));
        }
    }

    /**
     * @since 1.0.0
     * @param string $slug
     * @return WP_Post
     * @throws RuntimeException
     */
    public function get(string $slug): WP_Post
    {
        $slug = apply_filters("comblock_auth_{$slug}_get_slug", $slug);

        $post = get_page_by_path($slug, OBJECT, $this->post_type);

        if (!$post instanceof WP_Post) {
            throw new RuntimeException(__('error.post.not_found', 'comblock-auth'));
        }

        return $post;
    }
}
