<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Shortcode
{
    /**
     * @since 1.0.0
     * @param array|string $attributes
     * @param string $content
     * @return string
     */
    public function login($attributes = '', $content = '')
    {
        $view = new Comblock_Auth_View_Login();

        return $view->render();
    }

    /**
     * @since 1.0.0
     * @param array|string $attributes
     * @param string $content
     * @return string
     */
    public function dashboard($attributes = '', $content = '')
    {
        $view = new Comblock_Auth_View_Dashboard();

        return $view->render();
    }
}
