<header class="site-header">
    <div class="container">
        <div class="site-branding">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<h1><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
            }
            ?>
        </div>
        
        <nav class="main-navigation">
            <button class="menu-toggle" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
            ]);
            ?>
        </nav>
    </div>
</header>