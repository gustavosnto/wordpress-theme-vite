<?php
if (!defined('ABSPATH')) exit;

// Adicione seus custom post types aqui
// Exemplo:
/*
function create_portfolio_post_type() {
    register_post_type('portfolio', [
        'labels' => [
            'name' => __('Portfolio', 'meu-tema'),
            'singular_name' => __('Portfolio Item', 'meu-tema'),
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'portfolio'],
    ]);
}
add_action('init', 'create_portfolio_post_type');
*/