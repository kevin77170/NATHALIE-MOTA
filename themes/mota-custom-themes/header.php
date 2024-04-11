<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>
    
</body>
</html>
    <header>
        <nav id="site-navigation" class="main-navigation">
            <div class="logo">
            <?php
                if (function_exists('the_custom_logo')) {
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a>';
                }
            }
            ?>
            </div> 
            <div>
            <?php
                // fonction pour afficher le menu WP 
            wp_nav_menu( array(
                'menu' => 'Custom Menu', // Assurez-vous de correspondre à l'emplacement du menu que vous avez créé.
                'container' => false ,
                'menu_class' => 'menu',
            ) );
            ?>
            </div>   
        </nav>
    </header>
    <!-- Le reste de votre contenu HTML irait ici -->
</body>
</html>