<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Activator
{
	/**
	 * @since 1.0.0
	 */
	public static function activate(): void
	{
		// TODO: Improve the management of transients 
		set_transient(__CLASS__, true, 5);

		$page = new Comblock_Auth_Page();
		$page->add_pages();
	}

	/**
	 * @since 1.0.0
	 */
	public static function notice(): void
	{
		if (!get_transient(__CLASS__)) {
			return;
		}

		delete_transient(__CLASS__);

		/**
		 * @var string $success
		 */
		$success = sprintf('<p>%s</p>', __('activator.notice.generic.success', 'comblock-auth'));

		/**
		 * @var string $errors
		 */
		$errors = '';

		$page = new Comblock_Auth_Page();
		foreach ($page->get_pages() as $page) {
			try {
				$post = $page->get_post();
				$post_url = $page->get_permalink();

				$success .= sprintf('<p><a href="%s">%s</a></p>', $post_url, $post->post_title);
			} catch (Throwable $e) {
				$errors .= sprintf('<p>%s</p>', $e->getMessage());
			}
		}

		printf('<div class="notice notice-success is-dismissible"><p>%s</p></div>', wp_kses_post($success));

		if (!$errors) {
			return;
		}

		printf('<div class="notice notice-error error is-dismissible"><p>%s</p></div>', wp_kses_post($errors));
	}
}
