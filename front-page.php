<?php get_header(); ?>

<main class="site-main">
    <!-- Hero Section com Swiper -->
    <section class="hero-section bg-gradient-to-r from-primary to-primary/80 text-white py-20">
        <div class="container">
            <div class="swiper hero-swiper max-w-4xl mx-auto">
                <div class="swiper-wrapper">
                    <div class="swiper-slide text-center">
                        <h1 class="text-5xl font-bold mb-6">Bem-vindo ao Nosso Site! (TESTE AUTO-REFRESH) ✨</h1>
                        <p class="text-xl mb-8 opacity-90">Tema WordPress moderno com TailwindCSS e Swiper</p>
                        <a href="#sobre" class="btn btn-outline">
                            Saiba Mais
                        </a>
                    </div>
                    <div class="swiper-slide text-center">
                        <h1 class="text-5xl font-bold mb-6">Tecnologia Moderna</h1>
                        <p class="text-xl mb-8 opacity-90">Desenvolvido com Vite, TailwindCSS e Hot Module Replacement</p>
                        <a href="#projetos" class="btn btn-outline">
                            Ver Projetos
                        </a>
                    </div>
                    <div class="swiper-slide text-center">
                        <h1 class="text-5xl font-bold mb-6">Performance Otimizada</h1>
                        <p class="text-xl mb-8 opacity-90">Carregamento rápido e experiência de usuário superior</p>
                        <a href="#contato" class="btn btn-outline">
                            Entre em Contato
                        </a>
                    </div>
                </div>
                
                <!-- Navegação -->
                <div class="swiper-button-next text-white"></div>
                <div class="swiper-button-prev text-white"></div>
                
                <!-- Paginação -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Seção de Posts Recentes -->
    <section class="py-16 bg-gray-50">
        <div class="container">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Posts Recentes</h2>
            
            <?php
            $recent_posts = new WP_Query([
                'posts_per_page' => 6,
                'post_status' => 'publish'
            ]);
            
            if ($recent_posts->have_posts()) :
                echo '<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">';
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    ?>
                    <article class="card card-post group">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail overflow-hidden">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-image group-hover:scale-105 transition-transform duration-300']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <div class="card-meta">
                                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                            </div>
                            
                            <div class="card-content">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="card-link">
                                Leia mais →
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p class="text-center text-gray-600">Nenhum post encontrado.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- Seção de Recursos -->
    <section class="py-16">
        <div class="container">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Recursos do Tema</h2>
            
            <div class="swiper features-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="text-center p-8 bg-white rounded-lg shadow-md">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4">Performance Rápida</h3>
                            <p class="text-gray-600">Otimizado com Vite para carregamento ultra-rápido e Hot Module Replacement</p>
                        </div>
                    </div>
                    
                    <div class="swiper-slide">
                        <div class="text-center p-8 bg-white rounded-lg shadow-md">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4">Design Responsivo</h3>
                            <p class="text-gray-600">Desenvolvido com TailwindCSS para experiência perfeita em todos os dispositivos</p>
                        </div>
                    </div>
                    
                    <div class="swiper-slide">
                        <div class="text-center p-8 bg-white rounded-lg shadow-md">
                            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-4">Fácil Customização</h3>
                            <p class="text-gray-600">Estrutura modular e bem organizada para fácil personalização e manutenção</p>
                        </div>
                    </div>
                </div>
                
                <!-- Paginação -->
                <div class="swiper-pagination mt-8"></div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>