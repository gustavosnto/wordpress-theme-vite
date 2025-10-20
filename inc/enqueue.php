<?php
if (!defined('ABSPATH')) exit;

/**
 * Verifica se o servidor Vite está rodando
 */
function is_vite_development() {
    // Considera ambiente de dev se o servidor Vite estiver rodando
    $vite_server = 'http://localhost:5173';

    // Se a constante nativa do WP indicar dev, já consideramos verdadeiro
    if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'development') {
        return true;
    }

    // Tenta pingar o cliente do Vite rapidamente
    $context = stream_context_create([
        'http' => [
            'timeout' => 0.5,
            'method' => 'GET',
        ],
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
            $vite_server . '/src/js/main.js',
            ['vite-client'],
            null,
            true
        );
        wp_script_add_data('theme-main', 'type', 'module');

        // Garante que os scripts do Vite sejam carregados como modules
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            $module_handles = ['vite-client', 'theme-main'];
            if (in_array($handle, $module_handles, true)) {
                // Normaliza para módulo sempre
                return '<script type="module" src="' . esc_url($src) . '"></script>' . "\n";
            }
            return $tag;
        }, 10, 3);

        // Carrega o CSS principal como entrada separada (Vite atende e faz HMR de CSS)
        wp_enqueue_style(
            'theme-style',
            $vite_server . '/src/scss/style.scss',
            [],
            null
        );
        
        // Adiciona CSS para indicador visual de HMR no frontend
        add_action('wp_head', function() {
            echo '<style>
                body::before {
                    content: "🔥 HMR ATIVO";
                    position: fixed;
                    top: 0;
                    right: 0;
                    background: #00ff00;
                    color: black;
                    padding: 4px 8px;
                    font-size: 12px;
                    z-index: 9999;
                    font-family: monospace;
                    border-radius: 0 0 0 4px;
                }
            </style>';
        });
        
        // Adiciona comentário no HTML para debug
        add_action('wp_head', function() {
            echo "<!-- Vite Development Mode Active (Proxy: " . (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost:5173' ? 'YES' : 'NO') . ") -->\n";
        });
        
        // Não precisamos de WebSocket manual: @vite/client já cuida do HMR/full-reload
        
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