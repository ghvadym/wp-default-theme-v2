<?php

//add_action('init', 'createPostTypes');

function createPostTypes()
{
    createPostType('Name', [
        'menu_icon' => 'dashicons-name',
        'supports'  => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'labels'    => [
            'name'          => __('Name', 'newspaper'),
            'singular_name' => __('Name', 'newspaper'),
            'add_new_item'  => __('Add New Name', 'newspaper'),
            'view_item'     => __('View Name', 'newspaper'),
            'search_items'  => __('Search Name', 'newspaper'),
            'not_found'     => __('No News found', 'newspaper'),
            'menu_name'     => __('Name', 'newspaper'),
        ],
    ]);
}


function createPostType($postType, $args = [])
{
    $args = array_merge([
        'public'        => true,
        'show_ui'       => true,
        'has_archive'   => true,
        'menu_position' => 20,
        'hierarchical'  => true,
        'supports'      => ['title', 'excerpt', 'thumbnail', 'editor'],
    ], $args);

    register_post_type($postType, $args);
}

function createTaxonomy($taxonomy, $postType, $args = [])
{
    $args = array_merge([
        'description'  => '',
        'public'       => true,
        'hierarchical' => true,
        'has_archive'  => true,
    ], $args);

    register_taxonomy($taxonomy, $postType, $args);
}