<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Shortcode_Render
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $output
     */
    protected string $output = '';

    /**
     * @since 1.0.0
     * @param string $output
     * @return void
     */
    public function set_output(string $output): void
    {
        $this->output = $output;
    }

    /**
     * @since 1.0.0
     * @param string $output
     * @return void
     */
    public function add_output(string $output): void
    {
        $this->output = $this->get_output() . $output;
    }

    /**
     * @since 1.0.0
     * @return string
     */
    public function get_output(): string
    {
        return $this->output;
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function init(): void
    {
        ob_start();
    }

    /**
     * @since 1.0.0
     * @see https://developer.wordpress.org/reference/hooks/pre_do_shortcode_tag/
     * @see https://codex.wordpress.org/Shortcode_API#Output
     *
     * @param callable $callback
     * @param array $args
     * @param bool $append
     * @return void
     */
    public function process(callable $callback, array $args = [], bool $append = false): void
    {
        $this->init();

        call_user_func_array($callback, $args);

        $output = ob_get_contents();

        if ($append) {
            $this->add_output($output);
        } else {
            $this->set_output($output);
        }

        $this->destroy();
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return void
     */
    protected function destroy(): void
    {
        ob_end_clean();
    }
}
