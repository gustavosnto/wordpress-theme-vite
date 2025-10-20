<?php get_header(); ?>

<main class="site-main">
    <div class="container mx-auto px-4">
        <?php
        if (have_posts()) :
            echo '<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">';
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('card card-post'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail overflow-hidden">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-image']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h2 class="card-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <div class="card-meta">
                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                            <span>•</span>
                            <span><?php the_author(); ?></span>
                        </div>
                        
                        <div class="card-content">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="card-link">
                            Leia mais →
                        </a>
                    </div>
                </article>
                <?php
            endwhile;
            echo '</div>';
            
            // Paginação
            the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => '← Anterior',
                'next_text' => 'Próximo →',
                'class' => 'mt-12',
            ]);
        else :
            echo '<div class="text-center py-12">';
            echo '<h2 class="text-2xl font-bold text-gray-900 mb-4">Nenhum conteúdo encontrado</h2>';
            echo '<p class="text-gray-600">Não há posts para exibir no momento.</p>';
            echo '</div>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>