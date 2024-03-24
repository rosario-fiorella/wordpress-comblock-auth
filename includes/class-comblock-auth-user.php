<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_User
{
	/**
	 * @since 1.0.0
	 * @access protected
	 * @var Comblock_Auth_Page $page
	 */
	protected Comblock_Auth_Page $page;

	/**
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->page = new Comblock_Auth_Page();
	}

	/**
	 * @since 1.0.0
	 * @return bool
	 */
	public function is_logged(): bool
	{
		return is_user_logged_in();
	}

	/**
	 * @since 1.0.0
	 * @return null|WP_User
	 */
	public function get_current_user(): ?WP_User
	{
		$user_id = get_current_user_id();

		if (!$user_id) {
			return null;
		}

		return get_user_by('ID', $user_id);
	}

	/**
	 * @since 1.0.0
	 * @see https://developer.wordpress.org/reference/functions/wp_signon/
	 * @return void
	 */
	public function do_login(): void
	{
		if (!array_key_exists(__FUNCTION__, $_POST)) {
			return;
		}

		wp_clear_auth_cookie();

		try {
			/**
			 * @var int|false $nonce
			 */
			$nonce = wp_verify_nonce($_REQUEST['_comblock_nonce_do_login'], '_comblock_do_login');

			if (!$nonce) {
				throw new RuntimeException(__('error.invalid_nonce', 'comblock-auth'));
			}

			/**
			 * @var WP_User|WP_Error $user
			 */
			$user = wp_signon($_POST, true);

			if (is_wp_error($user)) {
				throw new RuntimeException($user->get_error_message());
			}

			wp_set_current_user($user->ID);

			wp_set_auth_cookie($user->ID, true, true);

			$dashboard = $this->page->get_dashboard();

			$link = apply_filters('comblock_redirect_dashboard', get_permalink($dashboard->ID));

			wp_redirect($link);
			exit;
		} catch (Throwable $e) {
			add_filter(
				'comblock_view_login_render',
				/**
				 * @since 1.0.0
				 * @param string $output
				 * @return string
				 */
				function (string $output) use ($e): string {
					return sprintf('%s%s', $e->getMessage(), $output);
				}
			);
		}
	}

	/**
	 * @since 1.0.0
	 * @return void
	 */
	public function do_logout(): void
	{
		if (!array_key_exists(__FUNCTION__, $_REQUEST)) {
			return;
		}

		wp_logout();

		$login = $this->page->get_login();

		$link = apply_filters('comblock_redirect_logout', get_permalink($login->ID));

		wp_redirect($link);
		exit;
	}

	/**
	 * @since 1.0.0
	 * @return void
	 */
	public function login_redirect(): void
	{
		/**
		 * @var null|WP_Post $post
		 */
		global $post;

		if (headers_sent() || is_admin()) {
			return;
		}

		/**
		 * @var bool $is_logged
		 */
		$is_logged = $this->is_logged();

		/**
		 * @var WP_Post $login
		 */
		$login = $this->page->get_login();

		/**
		 * @var WP_Post $login
		 */
		$dashboard = $this->page->get_dashboard();

		if (!$is_logged && $post && has_shortcode($post->post_content, 'comblock_dashboard')) {
			$redirect = apply_filters('comblock_redirect_login', get_permalink($login->ID));
		} elseif (!$is_logged && is_page($dashboard->post_name)) {
			$redirect = apply_filters('comblock_redirect_login', get_permalink($login->ID));
		} elseif ($is_logged && is_page($login->post_name)) {
			$redirect = apply_filters('comblock_redirect_dashboard', get_permalink($dashboard->ID));
		} else {
			return;
		}

		wp_redirect($redirect);
		exit;
	}
}
