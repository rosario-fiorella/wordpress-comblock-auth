# README
WordPress plugin that allows you to authenticate users in the frontend in a reserved area 

- [Shortcode](#SHORTCODE)
- [Template](#TEMPLATE)
- [Filters](#FILTERS)
- [Actions](#ACTIONS)

# SHORTCODE
Apply the shortcode ``[comblock_login]`` to a page to manage the login in the front-end.

The restricted area in the front-end is accessible from the page that implements this shortcode ``[comblock_dashboard]``.

# TEMPLATE

## Overwrite the login/dashboard template with a custom template
Copy the ``views`` plugin folder inside the current theme subfolder ```wp-content/themes/your-active-theme/comblock/views```

# FILTERS

## Change login/dashboard default slug
```PHP
add_filter("comblock_auth_post_{$slug}", function (string $slug): string {
    return 'my-slug';
});

add_filter("comblock_auth_post_{$slug}_args", function (array $args): array {

    // map args here

    return $args;
});
```
Note: replace ``$slug`` in the hook name with the slug generated by the plugin.

## Custom login/dashboard redirection
```PHP
add_filter('comblock_redirect_login', function (string $permalink): string {
    return 'my-login-link';
});

add_filter('comblock_redirect_logout', function (string $permalink): string {
    return 'my-logout-link';
});

add_filter('comblock_redirect_dashboard', function (string $permalink): string {
    return 'my-dashboard-link';
});
```

## Custom login/dashboard html template snippet

Dashboard info
```PHP
add_filter('comblock_view_dashboard_template', function (string $template): string {

    // filter html snippet dashboard template here

    return $template;
});
```

Login form
```PHP
add_filter('comblock_view_login_template', function (string $template): string {

    // filter html snippet login template here

    return $template;
});
```

## Filter final html output from login/dashboard pages
```PHP
add_filter('comblock_view_dashboard_render', function (string $template): string {

    // filter final html output template here

    return $template;
});

add_filter('comblock_view_login_render', function (string $template): string {

    // filter final html output template here

    return $template;
});
```

# ACTIONS

## Adds custom HTML rendering before and after the main HTML output of the plugin in login/dashboard pages
```PHP
add_action('comblock_view_dashboard_before', function () {
    // print html here
    // this snippet will be displayed before the main dashboard render
});

add_action('comblock_view_dashboard_after', function () {
    // print html here
    // this snippet will be displayed after the main dashboard render
});

add_action('comblock_view_login_before', function () {
    // print html here
    // this snippet will be displayed before the main login render
});

add_action('comblock_view_login_after', function () {
    // print html here
    // this snippet will be displayed after the main login render
});
```
