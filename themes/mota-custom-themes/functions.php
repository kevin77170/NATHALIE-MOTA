<?php

// Fonction pour charger les styles et les scripts du thème
function theme_enqueue_styles() {
    // Styles
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'header-style', get_stylesheet_directory_uri() . '/assets/css/header.css' );
    wp_enqueue_style( 'footer-style', get_stylesheet_directory_uri() . '/assets/css/footer.css' );
    wp_enqueue_style( 'modal-style', get_stylesheet_directory_uri() . '/assets/css/modal.css' );
    wp_enqueue_style( 'single-photo-style', get_stylesheet_directory_uri() . '/assets/css/single-photo.css' );
    wp_enqueue_style( 'catalogue-photos-style', get_stylesheet_directory_uri() . '/assets/css/catalogue-photos.css' );
    wp_enqueue_style( 'front-page-style', get_stylesheet_directory_uri() . '/assets/css/front-page.css' );
    wp_enqueue_style( 'lightbox-style', get_stylesheet_directory_uri() . '/assets/css/lightbox.css' );

    // Scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'modal-js', get_stylesheet_directory_uri() . '/assets/js/modal.js' );
    wp_enqueue_script( 'miniature-js', get_stylesheet_directory_uri() . '/assets/js/miniature.js' );
    wp_enqueue_script( 'menu-burger-js', get_stylesheet_directory_uri() . '/assets/js/menu-burger.js' );
    wp_enqueue_script( 'ajax-js', get_stylesheet_directory_uri() . '/assets/js/ajax.js' );

    // Bibliothèque Font Awesome
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array());

    // Script ajax
    wp_enqueue_script( 'ajax-js', get_stylesheet_directory_uri() . '/assets/js/ajax.js', array('jquery'), '1.0', true);
    wp_localize_script('ajax', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'ajax_nonce' => wp_create_nonce('load_more_photos')));

    // Bibliothèque Select2 pour les selects de tri
    wp_enqueue_script( 'select2-js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.1.0/select2.js', array( 'jquery' ), '3.1.0', true );
    wp_enqueue_style( 'select2-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/3.1.0/select2.css', array() );
}

// Enregistrement de l'emplacement du logo dans la partie menu personaliser
function nathalie_custom_support() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo', array(
        'height' => 14,
        'width'  => 216,
    ) );
}

// Enregistrement des emplacements de menu
function register_custom_menus() {
    register_nav_menus( array(
        'primary' => 'Main menu', // Emplacement du menu principal
        'footer'  => 'Menu footer', // Emplacement du menu pied de page
    ) );
}

// AJAX handler for loading more photos
function load_more_photos() {

    $paged = isset($_POST['page']) ? intval($_POST['page']) + 1 : 1;

    // Vérifier et sécuriser les valeurs des filtres
    $cat_filter = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format_filter = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $annee_filter = isset($_POST['annee']) ? sanitize_text_field($_POST['annee']) : '';


    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $paged,
        'tax_query' => array(),
        'meta_query' => array(),
    );

    if (!empty($cat_filter)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $cat_filter,
        );
    }

    if (!empty($format_filter)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format_filter,
        );
    }
    // Ajouter le tri par date si une année est sélectionnée
    if (!empty($annee_filter)) {
        $args['orderby'] = 'date';
        $args['order'] = ($annee_filter == 'recentes') ? 'DESC' : 'ASC'; // Plus récentes ou plus anciennes
    }

    $photos_query = new WP_Query($args);
    if ($photos_query->have_posts()) {
        while ($photos_query->have_posts()) {
            $photos_query->the_post();
            // Structure du catalogue
            get_template_part('assets/template-part/catalogue-photos');
        }
    }

    wp_reset_postdata();

    $response = ob_get_clean();
    echo $response;
    exit;
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');

// Add_action WordPress
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );  // Chargement des styles et des scripts
add_action( 'after_setup_theme', 'nathalie_custom_support' );  // Configuration du logo
add_action( 'after_setup_theme', 'register_custom_menus' );  // Enregistrement des emplacements de menu








