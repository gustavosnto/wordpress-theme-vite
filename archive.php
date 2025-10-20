<?php get_header(); ?>

<main class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            
            <header class="page-header mb-12 text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    <?php
                    if (is_category()) {
                        single_cat_title();
                    } elseif (is_tag()) {
                        single_tag_title();
                    } elseif (is_author()) {
                        echo 'Posts de ' . get_the_author();
                    } elseif (is_date()) {
                        if (is_year()) {
                            echo 'Posts de ' . get_the_date('Y');
                        } elseif (is_month()) {
                            echo 'Posts de ' . get_the_date('F Y');
                        } else {
                            echo 'Posts de ' . get_the_date();
                        }
                    } else {
                        echo 'Arquivo';
                    }
                    ?>
                </h1>
                
                <?php
                $description = get_the_archive_description();
                if ($description) :
                    echo '<div class="text-gray-600 max-w-2xl mx-auto">' . $description . '</div>';
                endif;
                ?>
            </header>
            
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-primary transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <div class="text-sm text-gray-500 mb-3">
                                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                <span class="mx-2">•</span>
                                <span><?php the_author(); ?></span>
                            </div>
                            
                            <div class="entry-content text-gray-700">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-primary hover:text-primary/80 font-medium transition-colors">
                                Leia mais →
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php
            // Paginação
            the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => '← Anterior',
                'next_text' => 'Próximo →',
                'class' => 'mt-12',
            ]);
            ?>
            
        <?php else : ?>
            <div class="text-center py-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Nenhum conteúdo encontrado</h2>
                <p class="text-gray-600">Não há posts para exibir nesta categoria no momento.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>