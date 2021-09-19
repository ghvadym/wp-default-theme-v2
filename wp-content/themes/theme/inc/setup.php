<?php

add_action('wp_enqueue_scripts', 'theme_styles');
add_action('wp_enqueue_scripts', 'theme_scripts');

function theme_styles()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('app-style', get_template_directory_uri() . '/assets/css/app.css');
    wp_enqueue_style('owl-style', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
}

function theme_scripts()
{
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/app.js', ['jquery'], time(), true);
    wp_enqueue_script('owl-script', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', ['jquery'], time(), true);
    wp_localize_script('main-script', 'myajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}

add_filter('upload_mimes', 'upload_files');
function upload_files($files)
{
    $files['svg'] = 'image/svg+xml';
    $files['webp'] = 'image/webp';

    return $files;
}

add_action('after_setup_theme', function () {

    register_nav_menus([
        'main_header'   => 'Main Header',
        'footer_menu_1' => 'Footer Menu 1',
        'footer_menu_2' => 'Footer Menu 2',
        'footer_menu_3' => 'Footer Menu 3',
    ]);

    add_theme_support('post-thumbnails', ['car']);

    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Theme General Settings',
            'menu_title'	=> 'Theme Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Header',
            'menu_title'	=> 'Header',
            'parent_slug'	=> 'theme-general-settings',
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Footer',
            'menu_title'	=> 'Footer',
            'parent_slug'	=> 'theme-general-settings',
        ));
    }
});

add_action('init', 'my_remove_editor_from_post_type');
function my_remove_editor_from_post_type() {
    remove_post_type_support( 'page', 'editor');
    add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
    add_filter( 'use_widgets_block_editor', '__return_false' );
}

add_action('admin_menu', 'remove_default_post_types');
function remove_default_post_types()
{
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}

add_action('the_content', 'wrap_content_div');
function wrap_content_div($content)
{
    return '<div class="article-content">' . $content . '</div>';
}