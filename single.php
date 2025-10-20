<?php get_header(); ?>

<main class="site-main">
    <div class="container max-w-4xl">
        <?php
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg overflow-hidden'); ?>>
                <header class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h1>
                    
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <time datetime="<?php echo get_the_date('c'); ?>" class="mr-4">
                            <?php echo get_the_date(); ?>
                        </time>
                        <span class="mr-4">Por <?php the_author(); ?></span>
                        
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                            echo '<div class="flex space-x-2">';
                            foreach ($categories as $category) :
                                echo '<span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs">' . esc_html($category->name) . '</span>';
                            endforeach;
                            echo '</div>';
                        endif;
                        ?>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail mb-8">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg shadow-md']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>
                
                <footer class="mt-12 pt-8 border-t border-gray-200">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                        echo '<div class="mb-6">';
                        echo '<h3 class="text-lg font-semibold mb-3">Tags:</h3>';
                        echo '<div class="flex flex-wrap gap-2">';
                        foreach ($tags as $tag) :
                            echo '<a href="' . get_tag_link($tag->term_id) . '" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm transition-colors">' . esc_html($tag->name) . '</a>';
                        endforeach;
                        echo '</div>';
                        echo '</div>';
                    endif;
                    ?>
                    
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            Compartilhar:
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                               class="ml-2 text-primary hover:text-primary/80 transition-colors" target="_blank">Twitter</a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                               class="ml-2 text-primary hover:text-primary/80 transition-colors" target="_blank">Facebook</a>
                        </div>
                        
                        <div class="text-sm text-gray-500">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-primary hover:text-primary/80 transition-colors">
                                ← Voltar ao blog
                            </a>
                        </div>
                    </div>
                </footer>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>