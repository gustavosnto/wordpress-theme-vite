<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header relative">
    <div class="container mx-auto px-4">
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<h1><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
            }
            ?>
        </div>
        
        <button class="menu-toggle md:hidden">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
            ]);
            ?>
        </nav>
    </div>
</header>