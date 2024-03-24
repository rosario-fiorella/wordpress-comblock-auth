# FILTERS

## Login/Dashboard slug filters
```PHP
add_filter("comblock_auth_page_login_slug", function (string $slug): string {
    return 'my-login-slug';
});

add_filter("comblock_auth_page_login_options", function (array $args): array {

    // update $args here

    return $args;
});

add_filter("comblock_auth_page_dashboard_slug", function (string $slug): string {
    return 'my-dashboard-slug';
});

add_filter("comblock_auth_page_dashboard_options", function (array $args): array {

    // update $args here

    return $args;
});
```

## Generic page slug filters
```PHP
add_filter("comblock_auth_{$slug}_add_slug", function (string $slug): string {
    return 'my-generic-page-slug';
});

add_filter("comblock_auth_{$slug}_add_options", function (array $args): array {

    // update $args here

    return $args;
});
```

## Generic page options filters
```PHP
add_filter("comblock_auth_{$slug}_delete_slug", function (string $slug): string {
    return 'my-generic-page-slug';
});

add_filter("comblock_auth_{$slug}_get_slug", function (string $slug): string {
    return 'my-generic-page-slug';
});
```

## Login/Dashboard redirect filters
```PHP
add_filter('comblock_redirect_login', function (string $permalink): string {
    return 'my-custom-logunt-redirect';
});

add_filter('comblock_redirect_logout', function (string $permalink): string {
    return 'my-custom-logout-redirect';
});

add_filter('comblock_redirect_dashboard', function (string $permalink): string {
    return 'my-custom-dashboard-redirect';
});
```

## Login/Dashboard html code filters
```PHP
add_filter('comblock_view_dashboard_template', function (string $template): string {
    return 'my-custom-dashboard-html';
});

add_filter('comblock_view_login_template', function (string $template): string {
    return 'my-custom-login-html-form';
});
```

## Login/Dashboard output filters
```PHP
add_filter('comblock_view_dashboard_render', function (string $template): string {
    return 'filter-html-dashboard-output';
});

add_filter('comblock_view_login_render', function (string $template): string {
    return 'filter-html-login-output';
});
```

# ACTIONS

## Login/Dashboard rendering actions
```PHP
add_action('comblock_view_dashboard_before', function () {
    // print code here
});

add_action('comblock_view_dashboard_after', function () {
    // print code here
});

add_action('comblock_view_login_before', function () {
    // print code here
});

add_action('comblock_view_login_after', function () {
    // print code here
});
```