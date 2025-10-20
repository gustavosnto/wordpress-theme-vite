<?php
if (!defined('ABSPATH')) exit;

function theme_setup() {
    // Suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Suporte a imagens destacadas
    add_theme_support('post-thumbnails');
    
    // Suporte a HTML5
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);
    
    // Registrar menus
    register_nav_menus([
        'primary' => __('Menu Principal', 'meu-tema'),
        'footer' => __('Menu Rodapé', 'meu-tema'),
    ]);
    
    // Suporte a logo customizado
    add_theme_support('custom-logo', [
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ]);
}
add_action('after_setup_theme', 'theme_setup');