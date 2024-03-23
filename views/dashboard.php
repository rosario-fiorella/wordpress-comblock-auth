<?php

/**
 * Template Name Comblock Auth Dashboard
 * 
 * @since 1.0.0
 * @package wordpress-comblock-auth
 * @subpackage wordpress-comblock-auth/views
 */

/**
 * @var WP_User $user
 */
$user = $args['user'];

/**
 * @var Comblock_Auth_Data_Mapper $text
 */
$text = $args['text'];

$template = <<<EOD
<div data-name="comblock-intro" class="comblock comblock-intro">
    <div class="comblock-intro__title">{$text->title} <span class="comblock-span">{$user->display_name}</span></div>
    <div class="comblock-intro__subtitle">{$text->subtitle} <span class="comblock-span">{$user->user_registered}</span></div>
    <div class="comblock-intro__info">{$text->email} <span class="comblock-span">{$user->user_email}</span></div>
    <div class="comblock-intro__info comblock-actions">
        <a href="{$text->logout_url}" class="comblock-actions--logout">{$text->logout}</a>
    </div>
</div>
EOD;

/**
 * @since 1.0.0
 */
do_action('comblock_view_dashboard_before');

/**
 * @since 1.0.0
 */
print apply_filters('comblock_view_dashboard_template', $template);

/**
 * @since 1.0.0
 */
do_action('comblock_view_dashboard_after');
