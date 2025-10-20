<?php get_header(); ?>

<main class="site-main">
    <div class="container mx-auto px-4 text-center py-16">
        <div class="max-w-md mx-auto">
            <h1 class="text-6xl font-bold text-gray-900 mb-4">404</h1>
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Página não encontrada</h2>
            <p class="text-gray-600 mb-8">A página que você procura não existe ou foi movida para outro local.</p>
            
            <div class="space-y-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors font-medium">
                    Voltar para a página inicial
                </a>
                
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Ou tente pesquisar:</h3>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>