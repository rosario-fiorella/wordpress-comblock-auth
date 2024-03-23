<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_Views_Resolver
{
    /**
     * @since 1.0.0
     * @access protected
     * @var string $prefix
     */
    protected string $prefix = '';

    /**
     * @since 1.0.0
     * @access protected
     * @var string $suffix
     */
    protected string $suffix = '';

    /**
     * @since 1.0.0
     * @access protected
     * @var string $filename
     */
    protected string $filename = '';

    /**
     * @since 1.0.0
     * @param string $filename
     * @throws UnexpectedValueException
     */
    public function __construct(string $filename)
    {
        if (!trim($filename)) {
            throw new UnexpectedValueException(__('error.filename.empty', 'comblock-auth'));
        }

        $this->filename = $filename;
    }

    /**
     * @since 1.0.0
     * @param string $prefix
     * @return void
     */
    public function set_prefix(string $prefix = ''): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @since 1.0.0
     * @param string $suffix
     * @return void
     */
    public function set_suffix(string $suffix = ''): void
    {
        $this->suffix = $suffix;
    }

    /**
     * @since 1.0.0
     * @access protected
     * @return string
     * @throws RuntimeException
     */
    public function resolve_view(): string
    {
        $view = sprintf('%s%s%s', $this->prefix, $this->filename, $this->suffix);

        if (strpos($view, WP_CONTENT_DIR) === 0 && file_exists($view)) {
            return $view;
        }

        throw new RuntimeException(__('error.view.not_resolved', 'comblock-auth'));
    }

    /**
     * @since 1.0.0
     * @param array $data
     * @param bool $once
     * @return void
     */
    public function load_view(array $data = [], bool $once = true): void
    {
        $template = $this->resolve_view($this->filename);

        if (in_array($template, get_included_files())) {
            return;
        }

        load_template($template, $once, $data);
    }
}
