<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_View_Dashboard
{
    /**
     * @since 1.0.0
     * @param array|string $attributes
     * @param string $content
     * @return string
     */
    public function render($attributes = '', $content = ''): string
    {
        $render = new Comblock_Auth_Shortcode_Render();
        $render->process(function (): void {
            $view = new Comblock_Auth_View_Manager("dashboard");
            $view->view($this->dto());
        });

        return apply_filters('comblock_view_dashboard_render', $render->get_output());
    }

    /**
     * @since 1.0.0
     * @return array<string, mixed>
     */
    protected function dto(): array
    {
        $user = new Comblock_Auth_User();

        $dto = new Comblock_Auth_Data_Mapper();
        $dto->user = $user->get_current_user();

        $dto->text = new Comblock_Auth_Data_Mapper();
        $dto->text->title = __('dashboard.title', 'comblock-auth');
        $dto->text->subtitle = __('dashboard.subtitle', 'comblock-auth');
        $dto->text->email = __('dashboard.email', 'comblock-auth');
        $dto->text->logout = __('dashboard.logout', 'comblock-auth');

        $dto->text->logout_url = esc_url(sprintf('%s?do_logout=true', site_url('/')));

        return $dto->to_array();
    }
}
