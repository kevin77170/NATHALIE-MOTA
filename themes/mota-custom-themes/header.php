<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF+1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <header class="main-menu" role="navigation">
        <div class="logo">
        <?php
            // Vérification et affichage du logo personnalisé du site
            if (function_exists('the_custom_logo')) {
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
            }
        }
        ?>
        </div> 
        <div class=menu>
            <nav class="menu-header">
                <?php
                     wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'menu',
                        ));
                ?>
            </nav>
            <!-- menu mobile -->
            <div id="navbar" class="navbar toggled" aria-controls="primary-menu" aria-expanded="false"> 
                <button id="navbar-burger" class="navbar-burger navbar-open" aria-expanded="true"> 
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
            <nav id="menu-header" class="menu-header">
            <?php
                 wp_nav_menu(array(
	            'theme_location' => 'primary',
	            'menu_class' => 'menu',
	        ));
            ?>
            </nav>
</header>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/menu-burger.js"></script>
</body>
</html>