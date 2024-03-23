<?php

/**
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/includes
 */
class Comblock_Auth_View_Login
{
    /**
     * @since 1.0.0
     * @return string
     */
    public function render(): string
    {
        $render = new Comblock_Auth_Shortcode_Render();
        $render->process(function (): void {
            $view = new Comblock_Auth_View_Manager('login');
            $view->view($this->dto());
        });

        return apply_filters('comblock_view_login_render', $render->get_output());
    }

    /**
     * @since 1.0.0
     * @return array<string, mixed>
     */
    protected function dto(): array
    {
        $dto = new Comblock_Auth_Data_Mapper();
        $dto->form = new Comblock_Auth_Data_Mapper();
        $dto->form->action = '';
        $dto->form->_comblock_nonce_do_login = wp_nonce_field('_comblock_do_login', '_comblock_nonce_do_login', true, false);

        $dto->form->user_login = new Comblock_Auth_Data_Mapper();
        $dto->form->user_login->label = __('user_login.label', 'comblock-auth');
        $dto->form->user_login->value = '';
        $dto->form->user_login->placeholder = __('user_login.placeholder', 'comblock-auth');
        $dto->form->user_login->error = __('user_login.error', 'comblock-auth');

        $dto->form->user_password = new Comblock_Auth_Data_Mapper();
        $dto->form->user_password->label = __('user_password.label', 'comblock-auth');
        $dto->form->user_password->value = '';
        $dto->form->user_password->placeholder = __('user_password.placeholder', 'comblock-auth');
        $dto->form->user_password->error = __('user_password.error', 'comblock-auth');

        $dto->form->remember = new Comblock_Auth_Data_Mapper();
        $dto->form->remember->label = __('remember.label', 'comblock-auth');
        $dto->form->remember->value = 1;
        $dto->form->remember->error = __('remember.error', 'comblock-auth');

        $dto->form->reset = new Comblock_Auth_Data_Mapper();
        $dto->form->reset->label = __('reset.label', 'comblock-auth');

        $dto->form->submit = new Comblock_Auth_Data_Mapper();
        $dto->form->submit->label = __('submit.label', 'comblock-auth');

        return $dto->to_array();
    }
}
