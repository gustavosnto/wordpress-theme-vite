<?php
if (!defined('ABSPATH')) exit;

function theme_vite_assets() {
    $is_dev = defined('WP_DEBUG') && WP_DEBUG;
    $vite_server = 'http://localhost:5173';
    
    if ($is_dev) {
        // Modo desenvolvimento com HMR
        wp_enqueue_script(
            'vite-client',
            $vite_server . '/@vite/client',
            [],
            null,
            false
        );
        wp_script_add_data('vite-client', 'type', 'module');
        
        wp_enqueue_script(
            'theme-main',
            $vite_server . '/js/main.js',
            ['vite-client'],
            null,
            true
        );
        wp_script_add_data('theme-main', 'type', 'module');
        
    } else {
        // Modo produção
        $manifest_path = get_template_directory() . '/assets/manifest.json';
        
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            
            if (isset($manifest['src/scss/style.scss'])) {
                $css_file = $manifest['src/scss/style.scss']['file'];
                wp_enqueue_style(
                    'theme-style',
                    get_template_directory_uri() . '/assets/' . $css_file,
                    [],
                    null
                );
            }
            
            if (isset($manifest['src/js/main.js'])) {
                $js_file = $manifest['src/js/main.js']['file'];
                wp_enqueue_script(
                    'theme-main',
                    get_template_directory_uri() . '/assets/' . $js_file,
                    [],
                    null,
                    true
                );
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'theme_vite_assets');

// Remove recursos desnecessários do WordPress
function remove_wp_bloat() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'remove_wp_bloat');