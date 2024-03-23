<?php

/**
 * Template Name Comblock Auth Login
 * 
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/views
 */

/**
 * @var Comblock_Auth_Data_Mapper $form
 */
$form = $args['form'];

/**
 * @since 1.0.0
 * @var string $template
 */
$template = <<<EOD
<form data-name="comblock-do_login" class="comblock comblock-form" method="POST" action="{$form->action}">
    <div data-name="user_login" class="comblock-form__input">
        <label for="user_login" class="comblock-form__input--label">{$form->user_login->label}</label>
        <input id="user_login" class="comblock-form__input--text" type="text" name="user_login" autocomplete="user_login" value="{$form->user_login->value}" placeholder="{$form->user_login->placeholder}" required="true" />
    </div>
    <div data-name="user_password" class="comblock-form__input">
        <label for="user_password" class="comblock-form__input--label">{$form->user_password->label}</label>
        <input id="user_password" class="comblock-form__input--text" type="password" name="user_password" autocomplete="user_password" value="{$form->user_password->value}" placeholder="{$form->user_password->placeholder}" required="true" />
    </div>
    <div data-name="remember" class="comblock-form__input">
        <label for="remember" class="comblock-form__input--label">{$form->remember->label}</label>
        <input id="remember" class="comblock-form__input--text" type="checkbox" name="remember" autocomplete="remember" value="{$form->remember->value}" />
    </div>
    <div data-name="_comblock_nonce_do_login" class="comblock-form__input comblock-hidden">
        {$form->_comblock_nonce_do_login}
    </div>
    <div data-name="do_login" class="comblock-form__input comblock-hidden">
        <input type="hidden" name="do_login" value="1" /
    </div>
    <div data-name="submit" class="comblock-form__input comblock-actions">
        <button type="reset" class="comblock-actions--reset">{$form->reset->label}</button>
        <button type="submit" class="comblock-actions--submit">{$form->submit->label}</button>
    </div>
</form>
EOD;

/**
 * @since 1.0.0
 */
do_action('comblock_view_login_before');

/**
 * @since 1.0.0
 */
print apply_filters('comblock_view_login_template', $template);

/**
 * @since 1.0.0
 */
do_action('comblock_view_login_after');
