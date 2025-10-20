<!-- Footer Profissional -->
<footer class="site-footer bg-gray-900 text-white relative overflow-hidden">
    <div class="relative z-10">
        <!-- Footer Principal -->
        <div class="container pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                
                <!-- Coluna 1: Sobre a Empresa -->
                <div class="footer-column space-y-6">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-rocket text-3xl text-blue-400"></i>
                        <h3 class="text-2xl font-bold"><?php bloginfo('name'); ?></h3>
                    </div>
                    <p class="company-description text-gray-300 leading-relaxed">
                        <?php bloginfo('description'); ?>
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-map-marker-alt text-blue-400 w-5"></i>
                            <span>Rua Exemplo, 123 - São Paulo, SP</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-phone text-blue-400 w-5"></i>
                            <span>(11) 9999-9999</span>
                        </div>
                        <div class="flex items-center space-x-3 text-gray-300">
                            <i class="fas fa-envelope text-blue-400 w-5"></i>
                            <span>contato@empresa.com</span>
                        </div>
                    </div>
                </div>

                <!-- Coluna 2: Produtos/Serviços -->
                <div class="footer-column space-y-6">
                    <h4 class="text-lg font-semibold text-white border-b border-blue-400 pb-2">Serviços</h4>
                    <nav class="footer-nav space-y-1">
                        <?php 
                        wp_nav_menu([
                            'theme_location' => 'footer-services',
                            'container' => false,
                            'menu_class' => '',
                            'items_wrap' => '%3$s',
                            'link_before' => '',
                            'link_after' => '',
                            'fallback_cb' => false,
                            'walker' => new class extends Walker_Nav_Menu {
                                function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                                    $output .= '<a href="' . esc_url($item->url) . '" class="block text-gray-300 hover:text-blue-400 transition-colors">' . esc_html($item->title) . '</a>';
                                }
                            }
                        ]);
                        ?>
                    </nav>
                </div>

                <!-- Coluna 3: Links Úteis -->
                <div class="footer-column space-y-6">
                    <h4 class="text-lg font-semibold text-white border-b border-blue-400 pb-2">Links Úteis</h4>
                    <nav class="footer-nav space-y-1">
                        <?php 
                        wp_nav_menu([
                            'theme_location' => 'footer-links',
                            'container' => false,
                            'menu_class' => '',
                            'items_wrap' => '%3$s',
                            'link_before' => '',
                            'link_after' => '',
                            'fallback_cb' => false,
                            'walker' => new class extends Walker_Nav_Menu {
                                function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                                    $output .= '<a href="' . esc_url($item->url) . '" class="block text-gray-300 hover:text-blue-400 transition-colors">' . esc_html($item->title) . '</a>';
                                }
                            }
                        ]);
                        ?>
                    </nav>
                </div>

                <!-- Coluna 4: Newsletter e Redes Sociais -->
                <div class="footer-column space-y-6">
                    <h4 class="text-lg font-semibold text-white border-b border-blue-400 pb-2">Mantenha-se Conectado</h4>
                    
                    <!-- Newsletter -->
                    <div class="space-y-4">
                        <p class="text-gray-300 text-sm">Receba nossas novidades e conteúdos exclusivos.</p>
                        <form class="newsletter-form space-y-3">
                            <div class="relative">
                                <input 
                                    type="email" 
                                    placeholder="Seu melhor e-mail"
                                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent backdrop-blur-sm"
                                    required
                                />
                                <button 
                                    type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-md transition-colors"
                                >
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Redes Sociais -->
                    <div class="space-y-4">
                        <p class="text-gray-300 text-sm">Siga-nos nas redes sociais:</p>
                        <div class="social-links flex space-x-3">
                            <a href="#" class="facebook group bg-white/10 hover:bg-blue-600 p-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                                <i class="fab fa-facebook text-white text-lg group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="instagram group bg-white/10 hover:bg-pink-600 p-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                                <i class="fab fa-instagram text-white text-lg group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="linkedin group bg-white/10 hover:bg-blue-500 p-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                                <i class="fab fa-linkedin text-white text-lg group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="twitter group bg-white/10 hover:bg-blue-400 p-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                                <i class="fab fa-twitter text-white text-lg group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="group bg-white/10 hover:bg-red-600 p-3 rounded-lg transition-all duration-300 backdrop-blur-sm">
                                <i class="fab fa-youtube text-white text-lg group-hover:scale-110 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom border-t border-white/10">
            <div class="container mx-auto px-4 lg:px-6 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <!-- Copyright -->
                    <div class="flex items-center space-x-4 text-gray-400 text-sm text-center md:text-left">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados. Desenvolvido por <a href="#" class="font-bold">3ww - Digital Solutions</a></p>
                    </div>

                    <!-- Links Legais -->
                    <nav class="flex items-center space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Termos de Uso</a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Privacidade</a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Cookies</a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Botão Voltar ao Topo -->
        <button id="back-to-top" class="fixed bottom-6 right-6 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50 hover:scale-110 w-12 h-12 flex items-center justify-center">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>