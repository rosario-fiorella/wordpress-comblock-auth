<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_View_Manager
{
    /**
     * @since 1.0.0
     * @access protected
     * @var Comblock_Auth_Views_Resolver $resolver
     */
    protected Comblock_Auth_Views_Resolver $resolver;

    /**
     * @since 1.0.0
     * @access protected
     * @var string[] $path
     */
    protected array $path = [];

    /**
     * @since 1.0.0
     * @param string $filenam
     */
    public function __construct(string $filename)
    {
        $this->resolver = new Comblock_Auth_Views_Resolver($filename);
        $this->resolver->set_suffix('.php');

        $this->add_path(sprintf('%s/comblock/views/', get_template_directory()));
        $this->add_path(sprintf('%sviews/', plugin_dir_path(__DIR__)));
    }

    /**
     * @since 1.0.0
     * @param string $folder
     * @return void
     */
    public function add_path(string $folder): void
    {
        $this->path[] = $folder;
    }

    /**
     * @since 1.0.0
     * @param array $data
     * @param bool $once
     * @return void
     * @throws RuntimeException
     */
    public function view(array $data = [], bool $once = true): void
    {
        $load = false;

        foreach ($this->path as $folder) {
            try {
                $this->resolver->set_prefix($folder);
                $this->resolver->load_view($data, $once);

                $load = true;
                break;
            } catch (RuntimeException $e) {
                continue;
            }
        }

        if (!$load) {
            throw new RuntimeException(__('error.view.not_load', 'comblock-auth'));
        }
    }
}
