<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header Principal -->
<header class="site-header bg-white shadow-lg sticky top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 lg:px-6">
        <div class="flex items-center justify-between h-16 lg:h-20">
            
            <!-- Logo/Branding -->
            <div class="site-branding flex items-center">
                <?php if (has_custom_logo()): ?>
                    <div class="flex items-center">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else: ?>
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-rocket text-2xl text-blue-600"></i>
                        <h1 class="text-xl lg:text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="no-underline">
                                <?php echo get_bloginfo('name'); ?>
                            </a>
                        </h1>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Menu Desktop -->
            <nav class="main-navigation hidden lg:flex items-center space-x-8">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex items-center space-x-8',
                    'fallback_cb' => false,
                ]);
                ?>
                
                <!-- Botões de Ação -->
                <div class="flex items-center space-x-4 ml-6">
                    <button id="search-toggle" class="text-gray-600 hover:text-blue-600 transition-colors py-2 px-3 rounded-full hover:bg-gray-100" aria-label="Abrir busca">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <a href="#contact" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-colors font-medium">
                        <i class="fas fa-phone mr-2"></i>
                        Contato
                    </a>
                </div>
            </nav>

            <!-- Botão Mobile Menu -->
            <button class="menu-toggle lg:hidden flex justify-center items-center w-10 h-10 bg-transparent border-0 cursor-pointer p-0 relative z-50 text-gray-800 hover:text-blue-600 transition-colors" aria-label="Menu" aria-expanded="false">
                <i class="menu-icon fas fa-bars text-xl transition-all duration-300"></i>
                <i class="close-icon fas fa-times text-xl absolute opacity-0 scale-0 transition-all duration-300"></i>
            </button>
        </div>
    </div>

    <!-- Menu Mobile Overlay -->
    <div class="mobile-menu fixed inset-0 bg-white z-40 lg:hidden transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">
            <!-- Header do Menu Mobile -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-rocket text-xl text-blue-600"></i>
                    <span class="text-lg font-bold text-gray-800"><?php echo get_bloginfo('name'); ?></span>
                </div>
            </div>

            <!-- Navegação Mobile -->
            <nav class="flex-1 overflow-y-auto py-6">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'mobile-nav-menu',
                    'fallback_cb' => 'mobile_fallback_menu',
                ]);
                ?>
                
                <!-- Ações Mobile -->
                <div class="px-6 mt-8 space-y-4">
                    <button id="search-toggle-mobile" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 py-3 border-b border-gray-100 w-full text-left">
                        <i class="fas fa-search w-5"></i>
                        <span>Pesquisar</span>
                    </button>
                    <a href="#account" class="flex items-center space-x-3 text-gray-700 hover:text-blue-600 py-3 border-b border-gray-100">
                        <i class="fas fa-user w-5"></i>
                        <span>Minha Conta</span>
                    </a>
                </div>
                
                <!-- CTA Mobile -->
                <div class="px-6 mt-6">
                    <a href="#contact" class="flex items-center justify-center w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        <i class="fas fa-phone mr-2"></i>
                        Entre em Contato
                    </a>
                </div>
            </nav>

            <!-- Footer do Menu Mobile -->
            <div class="border-t border-gray-200 p-6">
                <div class="flex items-center justify-center space-x-6">
                    <a href="#facebook" class="text-gray-400 hover:text-blue-600 transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#instagram" class="text-gray-400 hover:text-pink-600 transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#linkedin" class="text-gray-400 hover:text-blue-700 transition-colors">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                    <a href="#twitter" class="text-gray-400 hover:text-blue-400 transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal de Busca -->
<div id="search-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 opacity-0 invisible transition-all duration-300">
    <div class="flex items-start justify-center min-h-screen pt-20 px-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl transform scale-95 transition-all duration-300">
            <!-- Header do Modal -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-search text-blue-600 text-xl"></i>
                    <h3 class="text-lg font-semibold text-gray-800">Pesquisar no Site</h3>
                </div>
                <button id="search-close" class="text-gray-500 hover:text-gray-700 p-1 rounded-full hover:bg-gray-100 transition-colors" aria-label="Fechar busca">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Formulário de Busca -->
            <div class="p-6">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="relative">
                        <input 
                            type="search" 
                            id="search-input"
                            class="w-full pl-12 pr-4 py-4 text-lg border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                            placeholder="Digite sua pesquisa..."
                            value="<?php echo get_search_query(); ?>"
                            name="s"
                            autocomplete="off"
                        />
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-lg"></i>
                        </div>
                        <button type="submit" class="absolute inset-y-0 right-2 flex items-center px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            Buscar
                        </button>
                    </div>
                </form>

                <!-- Sugestões Populares -->
                <div class="mt-6">
                    <p class="text-sm font-medium text-gray-600 mb-3">Pesquisas populares:</p>
                    <div class="flex flex-wrap gap-2">
                        <a href="<?php echo esc_url(home_url('/category/servicos')); ?>" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-blue-100 hover:text-blue-700 transition-colors">
                            <i class="fas fa-cog mr-1"></i>
                            Serviços
                        </a>
                        <a href="<?php echo esc_url(home_url('/category/produtos')); ?>" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-blue-100 hover:text-blue-700 transition-colors">
                            <i class="fas fa-box mr-1"></i>
                            Produtos
                        </a>
                        <a href="<?php echo esc_url(home_url('/about')); ?>" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-blue-100 hover:text-blue-700 transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>
                            Sobre
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="px-3 py-1.5 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-blue-100 hover:text-blue-700 transition-colors">
                            <i class="fas fa-envelope mr-1"></i>
                            Contato
                        </a>
                    </div>
                </div>

                <!-- Dica de Pesquisa -->
                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-lightbulb text-blue-600 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-blue-800">Dica de pesquisa</p>
                            <p class="text-sm text-blue-700 mt-1">Use palavras-chave específicas para resultados mais precisos. Exemplo: "serviços web design"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>