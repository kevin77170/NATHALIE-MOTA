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
                <!-- intégration du menu burger -->
                   <div id="navbar" class="navbar" aria-controls="primary-menu" aria-expanded="false">
        <button class="navbar-burger navbar-open" aria-expanded="true">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
        </button>        
        <div class="navbar-content">
            <ul>
                <li class="navbar-acceuil">
                <a href="page accueil">CCUEIL</a>
                </li>
                <li class="navbar-a-propos">
                <a href="page a propos">À PROPOS</a>
                </li>
                <li class="navbar-contact">
                <a href="page contact">CONTACT</a>
                </li>
            </ul> 
        </div>  
    </header>
</body>
</html>