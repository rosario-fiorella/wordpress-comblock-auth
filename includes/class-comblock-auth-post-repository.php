<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Post_Repository
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $post_type
     */
    protected string $post_type = 'post';

    /**
     * @since 1.0.0
     * @access protected
     * @var string $slug
     */
    protected string $slug = '';

    /**
     * @since 1.0.0
     * @access protected
     * @var array<string, mixed> $args
     */
    protected array $args = [];

    /**
     * @since 1.0.0
     * @param string $slug
     * @throws UnexpectedValueException
     */
    public function set_slug(string $slug): void
    {
        if (!$slug) {
            throw new UnexpectedValueException(__('error.post.slug.empty', 'comblock-auth'));
        }

        $this->slug = apply_filters("comblock_auth_page_{$slug}", $slug);
    }

    /**
     * @since 1.0.0
     * @param string $post_type
     * @throws UnexpectedValueException
     */
    public function set_post_type(string $post_type): void
    {
        if (!post_type_exists($post_type)) {
            throw new UnexpectedValueException(__('error.post_type.not_valid', 'comblock-auth'));
        }

        $this->post_type = $post_type;
    }

    /**
     * @since 1.0.0
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set_arg(string $key, $value): void
    {
        if (!$key) {
            throw new UnexpectedValueException(__('error.post.arg.key.empty', 'comblock-auth'));
        }

        $this->args[$key] = $value;
    }

    /**
     * @since 1.0.0
     * @return int
     * @throws UnexpectedValueException
     * @throws RuntimeException
     */
    public function add_post(): int
    {
        if (!$this->slug) {
            throw new UnexpectedValueException(__('error.post.slug.empty', 'comblock-auth'));
        }

        if (empty($this->args)) {
            throw new UnexpectedValueException(__('error.post.args.empty', 'comblock-auth'));
        }

        $post = get_page_by_path($this->slug, OBJECT, $this->post_type);

        if ($post) {
            return $post->ID;
        }

        $post_id = wp_insert_post($this->args, true);

        if (is_wp_error($post_id)) {
            throw new RuntimeException($post_id->get_error_message(), $post_id->get_error_code());
        }

        return $post_id;
    }

    /**
     * @since 1.0.0
     * @return void
     * @throws RuntimeException
     */
    public function delete_post(): void
    {
        $post = get_page_by_path($this->slug, OBJECT, $this->post_type);

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
     * @return WP_Post
     * @throws RuntimeException
     */
    public function get_post(): WP_Post
    {
        $post = get_page_by_path($this->slug, OBJECT, $this->post_type);

        if (!$post instanceof WP_Post) {
            throw new RuntimeException(__('error.post.not_found', 'comblock-auth'));
        }

        return $post;
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function get_permalink(): string
    {
        $post = $this->get_post();

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

    /**
     * @since 1.0.0
     * @return string
     */
    public function validate_post(): void
    {
    }
}
