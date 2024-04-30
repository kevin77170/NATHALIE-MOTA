<?php

/* ajout des fonction au theme personaliser*/

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'header-style', get_stylesheet_directory_uri() . '/assets/css/header.css' );
    wp_enqueue_style( 'footer-style', get_stylesheet_directory_uri() . '/assets/css/footer.css' );
    wp_enqueue_style( 'modal-style', get_stylesheet_directory_uri() . '/assets/css/modal.css' );
    wp_enqueue_style( 'single-photo-style', get_stylesheet_directory_uri() . '/assets/css/single-photo.css' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'modal-js', get_stylesheet_directory_uri() . '/assets/js/modal.js' );
    wp_enqueue_script('miniature-js', get_stylesheet_directory_uri() . '/assets/js/miniature.js');
    wp_enqueue_script( 'menu-burger-js', get_stylesheet_directory_uri() . '/assets/js/menu-burger.js' );

}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


function nathalie_custom_support () {
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo', array(
    'height' => 14,
    'width'  => 216,
) );
}
add_action('after_setup_theme', 'nathalie_custom_support');


// Enregistrement des emplacements de menu
function register_custom_menus() {
    register_nav_menus( array(
        'primary' => 'Main menu', // Emplacement du menu principal
        'footer'  => 'Menu footer', // Emplacement du menu pied de page
    ) );
}
add_action( 'after_setup_theme', 'register_custom_menus' );







