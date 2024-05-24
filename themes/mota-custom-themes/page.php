<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>

<main id="main" class="site-main" role="main">


    <!-- Boucle WordPress pour afficher le contenu de la page -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h1><?php get_the_title(); ?></h1>
            <section class="container">
                <?php the_content(); ?>


            </section>

    <?php endwhile;
    endif; ?>



</main>
<?php
get_footer();
?>
