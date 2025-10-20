<?php
// Previne acesso direto
if (!defined('ABSPATH')) exit;

// Inclui arquivos de configuração
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/custom-post-types.php';

/**
 * Fallback menu para mobile quando não há menu cadastrado
 */
function mobile_fallback_menu() {
    echo '<ul class="mobile-nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '"><i class="fas fa-home w-5"></i> Início</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '"><i class="fas fa-info-circle w-5"></i> Sobre</a></li>';
    echo '<li><a href="' . esc_url(home_url('/services')) . '"><i class="fas fa-cogs w-5"></i> Serviços</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '"><i class="fas fa-envelope w-5"></i> Contato</a></li>';
    echo '</ul>';
}

/**
 * Customiza output do menu WordPress para incluir ícones FontAwesome apenas no menu principal
 */
function add_menu_icons($items, $args) {
    // Ícones APENAS para menu principal
    if ($args->theme_location == 'primary') {
        $menu_icons = [
            'início' => 'fas fa-home',
            'home' => 'fas fa-home', 
            'sobre' => 'fas fa-info-circle',
            'about' => 'fas fa-info-circle',
            'serviços' => 'fas fa-cogs',
            'services' => 'fas fa-cogs',
            'produtos' => 'fas fa-box',
            'products' => 'fas fa-box',
            'blog' => 'fas fa-blog',
            'notícias' => 'fas fa-newspaper',
            'news' => 'fas fa-newspaper',
            'contato' => 'fas fa-envelope',
            'contact' => 'fas fa-envelope',
            'galeria' => 'fas fa-images',
            'gallery' => 'fas fa-images'
        ];

        foreach ($menu_icons as $text => $icon) {
            $items = str_replace(
                '>' . ucfirst($text) . '</a>',
                '>' . ucfirst($text) . '</a>',
                $items
            );
        }
    }
    
    return $items;
}
add_filter('wp_nav_menu_items', 'add_menu_icons', 10, 2);