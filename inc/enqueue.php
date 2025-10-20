<?php
if (!defined('ABSPATH')) exit;

/**
 * Verifica se o servidor Vite está rodando
 */
function is_vite_development() {
    $vite_server = 'http://localhost:5173';
    
    // Verifica se WP_DEBUG está ativo
    if (!defined('WP_DEBUG') || !WP_DEBUG) {
        return false;
    }
    
    // Verifica se o servidor Vite está respondendo
    $context = stream_context_create([
        'http' => [
            'timeout' => 1,
            'method' => 'GET'
        ]
    ]);
    
    $response = @file_get_contents($vite_server . '/@vite/client', false, $context);
    return $response !== false;
}

function theme_vite_assets() {
    $vite_server = 'http://localhost:5173';
    $is_dev = is_vite_development();
    
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
        
        // Adiciona comentário no HTML para debug
        add_action('wp_head', function() {
            echo "<!-- Vite Development Mode Active -->\n";
        });
        
    } else {
        // Modo produção
        $manifest_path = get_template_directory() . '/assets/.vite/manifest.json';
        
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
            $theme_version = wp_get_theme()->get('Version') ?: '1.0.0';
            
            // Carrega o JavaScript principal
            if (isset($manifest['js/main.js'])) {
                $js_file = $manifest['js/main.js']['file'];
                wp_enqueue_script(
                    'theme-main',
                    get_template_directory_uri() . '/assets/' . $js_file,
                    [],
                    $theme_version,
                    true
                );
                
                // Carrega os CSS associados ao JS
                if (isset($manifest['js/main.js']['css'])) {
                    foreach ($manifest['js/main.js']['css'] as $index => $css_file) {
                        wp_enqueue_style(
                            'theme-style-' . $index,
                            get_template_directory_uri() . '/assets/' . $css_file,
                            [],
                            $theme_version
                        );
                    }
                }
            }
            
            // Carrega CSS adicional se existir separadamente
            if (isset($manifest['scss/style.scss'])) {
                $css_file = $manifest['scss/style.scss']['file'];
                wp_enqueue_style(
                    'theme-style-scss',
                    get_template_directory_uri() . '/assets/' . $css_file,
                    [],
                    $theme_version
                );
            }
            
            // Adiciona comentário no HTML para debug
            add_action('wp_head', function() {
                echo "<!-- Vite Production Mode Active -->\n";
            });
        } else {
            // Fallback caso não exista o manifest
            add_action('wp_head', function() {
                echo "<!-- Warning: Vite manifest not found. Run 'npm run build' -->\n";
            });
        }
    }
}
add_action('wp_enqueue_scripts', 'theme_vite_assets');

// Remove o style.css padrão do tema (já que usamos Vite)
function remove_default_theme_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_default_theme_styles', 100);

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

/**
 * Adiciona informações de debug no admin bar para desenvolvedores
 */
function vite_admin_bar_info($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    $is_dev = is_vite_development();
    $status = $is_dev ? 'DEV (HMR)' : 'PROD';
    $color = $is_dev ? '#00ff00' : '#ff9500';
    
    $wp_admin_bar->add_node([
        'id' => 'vite-status',
        'title' => '<span style="color: ' . $color . ';">⚡ Vite: ' . $status . '</span>',
        'href' => false,
    ]);
}
add_action('admin_bar_menu', 'vite_admin_bar_info', 100);