<?php get_header();?>

<?php
//* Récupérer les champs ACF
$references = get_field('references');
$type = get_field('type');

//* Récupérer les termes de la taxonomie "catégorie"
$categories = get_the_terms(get_the_ID(), 'categorie');
// Vérifier si des catégories existent
if ($categories && !is_wp_error($categories)) {
    foreach ($categories as $categorie) {
        // Récupérer le nom de chaque catégorie dans $categorie_name
        $categorie_name = $categorie->name;
    }
}

//* Récupérer les termes de la taxonomie "format"
$formats = get_the_terms(get_the_ID(), 'format');
// Vérifier si des formats existent
if ($formats && !is_wp_error($formats)) {
    foreach ($formats as $format) {
        // Récupérer le nom de chaque format dans $format_name
        $format_name = $format->name;
    }
}

//* Récupérer les termes de la taxonomie "année"
$annees = get_the_terms(get_the_ID(), 'annee');
// Vérifier si des années existent
if ($annees && !is_wp_error($annees)) {
    foreach ($annees as $annee) {
        // Récupérer le nom de chaque année dans $annee_name
        $annee_name = $annee->name;
    }
}

$type_name = '';
if (is_array($type) || is_object($type)) {
    foreach ($type as $t) {
        $type_name = $t;
    }
}

?>

<!-- descriptif photo -->
<section class="container">
    <article class="content">
        <div class="meta-photo">
            <h2 class="title-photo"><?php the_title(); ?></h2>
            <div class="meta">
            <p>RÉFÉRENCE : <?php echo $references; ?></p>
            <p>CATÉGORIE : <?php echo $categorie_name; ?> </p>
            <p>FORMAT : <?php echo $format_name; ?> </p>
            <p>TYPE : <?php echo $type; ?> </p>
            <p>ANNÉE : <?php echo $annee->name; ?></p>
            </div>
        </div>
        <!-- photo -->
        <div class="photo-container">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

        </div>
        <!-- bouton contact -->
        <div class="contact">
            <p>Cette photo vous intéresse ?</p>
            <button class="btn btn-contact menu-item-118" data-reference="<?php echo esc_attr($references); ?>">Contact</button>
        </div>
        <!-- slider miniature -->
        <div class="navigation-miniature">
            <?php
            $current_post_id = get_the_ID();

            $args_thumbnails_slider = array(
                'post_type' => 'photo',
                'posts_per_page' => 2,
                'post__not_in' => array($current_post_id), // Exclure l'id de la publication actuelle
            );

            $thumbnails_slider = new WP_Query($args_thumbnails_slider);

            if ($thumbnails_slider->have_posts()) {
                while ($thumbnails_slider->have_posts()) {
                    $thumbnails_slider->the_post();

                    // récupere les infos : image mise en avant par rapport à l'id (thumbnail_url), url du post, titre
                    $thumbnail_url_id = get_the_post_thumbnail_url(get_the_ID());
                    $post_title = get_the_title();
                    $post_permalink = get_permalink();
            ?>
                                <a href="<?php echo $post_permalink; ?>">
                        <img class="thumbnails" src="<?php echo $thumbnail_url_id; ?>" alt="<?php echo $post_title; ?>">
                    </a>
            <?php
                }
                wp_reset_postdata();
            }
            ?>
            <div class="arrows">
                <svg class="arrow-left" xmlns="http://www.w3.org/2000/svg" width="26" height="8" viewBox="0 0 26 8" fill="none">
                    <path d="M0.646447 3.64645C0.451184 3.84171 0.451184 4.15829 0.646447 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659728 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646447 3.64645ZM1 4.5H26V3.5H1V4.5Z" fill="black" />
                </svg>

                <svg class="arrow-right" xmlns="http://www.w3.org/2000/svg" width="26" height="8" viewBox="0 0 26 8" fill="none">
                    <path d="M25.3536 3.64645C25.5488 3.84171 25.5488 4.15829 25.3536 4.35355L22.1716 7.53553C21.9763 7.7308 21.6597 7.7308 21.4645 7.53553C21.2692 7.34027 21.2692 7.02369 21.4645 6.82843L24.2929 4L21.4645 1.17157C21.2692 0.976311 21.2692 0.659728 21.4645 0.464466C21.6597 0.269204 21.9763 0.269204 22.1716 0.464466L25.3536 3.64645ZM25 4.5H0V3.5H25V4.5Z" fill="black" />
                </svg>
            </div>
        </div>

    </article>
</section>
<?php get_footer();?>