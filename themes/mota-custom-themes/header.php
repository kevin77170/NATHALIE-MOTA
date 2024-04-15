<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF+1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body>
    
</body>
</html>
    <header>
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
        </div>   
    </header>
</body>
</html>