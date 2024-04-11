<?php

/* ajout des fonction au theme personaliser*/

function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/assets/css/main.css' );
    wp_enqueue_script( 'script-js', get_stylesheet_directory_uri() . '/assets/js/script.js' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function nathalie_custom_support () {
add_theme_support( 'title-tag' );
add_theme_support( 'custom-logo', array(
    'height' => 14,
    'width'  => 216,
) );
}
add_action('after_setup_theme', 'nathalie_custom_support');


function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );
?>


