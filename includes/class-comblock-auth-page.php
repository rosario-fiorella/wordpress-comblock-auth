<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Page
{
    /**
     * @since 1.0.0
     * @access protected
     * @var Comblock_Auth_Post_Repository[] $pages
     */
    protected array $pages = [];

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->set_page('login', new Comblock_Auth_Page_Login());
        $this->set_page('dashboard', new Comblock_Auth_Page_Dashboard());
    }

    /**
     * @since 1.0.0
     * @param string $alias
     * @param Comblock_Auth_Post_Repository $repository
     */
    public function set_page(string $alias, Comblock_Auth_Post_Repository $repository): void
    {
        $this->pages[$alias] = $repository;
    }

    /**
     * @since 1.0.0
     * @param string $alias
     * @return bool
     */
    public function has_page(string $alias): bool
    {
        return array_key_exists($alias, $this->pages);
    }

    /**
     * @since 1.0.0
     * @param string $alias
     * @return null|Comblock_Auth_Post_Repository
     */
    public function get_page(string $alias): ?Comblock_Auth_Post_Repository
    {
        if (!$this->has_page($alias)) {
            return null;
        }

        return $this->pages[$alias];
    }

    /**
     * @since 1.0.0
     * @param string $alias
     * @return void
     */
    public function unset_page(string $alias): void
    {
        if (!$this->has_page($alias)) {
            return;
        }

        unset($this->pages[$alias]);
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function add_pages(): void
    {
        foreach ($this->pages as $page) {
            $page->add_post();
            $page->validate_post();
        }
    }

    /**
     * @since 1.0.0
     * @return void
     * @throws RuntimeException
     */
    public function delete_pages(): void
    {
        $errors = [];

        foreach ($this->pages as $page) {
            try {
                $page->validate_post();
                $page->delete_post();
            } catch (Throwable $e) {
                $errors[] = $e->getMessage();
            }
        }

        if (!empty($errors)) {
            throw new RuntimeException(implode(PHP_EOL, $errors));
        }
    }
}
