<?php get_header(); ?>

<main class="site-main">
    <div class="container max-w-4xl">
        <?php
        while (have_posts()) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg p-8'); ?>>
                <header class="mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h1>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail mb-8">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg shadow-md']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>