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
     * @var Comblock_Auth_Post_Manager[] $pages
     */
    protected array $pages = [];

    /**
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->pages[] = new Comblock_Auth_Page_Login();
        $this->pages[] = new Comblock_Auth_Page_Dashboard();
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function add_pages(): void
    {
        foreach ($this->pages as $page) {
            $page->add_page();
        }
    }

    /**
     * @since 1.0.0
     * @return void
     */
    public function delete_pages(): void
    {
        foreach ($this->pages as $page) {
            $page->delete_page();
        }
    }
}
