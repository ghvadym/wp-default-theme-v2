<?php

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

function get_template_part_var($template, $data = [])
{
    extract($data);
    require locate_template($template . '.php');
}

function wp_get_current_url()
{
    return home_url($_SERVER['REQUEST_URI']);
}

function getImage($name): string
{
    return get_template_directory_uri() . '/assets/img/' . $name;
}

function getBgImage($name): string
{
    $image = getImage($name);
    return 'background-image: url(' . $image . ')';
}

function getAcfImage($field): string
{
    return 'background-image: url(' . $field . ')';
}

function getAcfBtn($field, $class)
{
    return '<a class="' . $class . '" href="' . $field['url'] . '" target="' . $field['target'] . '">' . $field['title'] . '</a>';
}

function textLimiter($text, $limit = 40): string
{
    $plainText = strip_tags($text);
    return strlen($plainText) > $limit ? mb_strimwidth($plainText, 0, $limit, "...") : $plainText;
}

function footerWidgets()
{
    $widgets = [
        //
    ];
    foreach ($widgets as $widget) {
        if (is_active_sidebar($widget)) {
            dynamic_sidebar($widget);
        }
    }
}

function getPosts($key, $count = -1): array
{
    $args = [
        'post_type'      => 'car',
        'post_status'    => 'publish',
        'posts_per_page' => $count,
        'meta_key'       => $key,
        'meta_value'     => 1,
        'orderby'        => 'menu_order',
        'order'          => 'desc',
    ];
    return get_posts($args);
}