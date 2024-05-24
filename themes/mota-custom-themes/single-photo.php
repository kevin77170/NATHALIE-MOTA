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
        <!-- miniature et fleches -->
        <div class="navigation-miniature">
    <?php
    $current_post_id = get_the_ID();
    $args_before = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC', // Du plus récent au moins récent
        'date_query'     => array(
            array(
                'before' => get_the_date('c', $current_post_id) // c pour le format ISO 8601
            )
        ),
    );

    $previous_post_query = new WP_Query($args_before);

    $args_after = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'ASC', // Du moins récent au plus récent
        'date_query'     => array(
            array(
                'after' => get_the_date('c', $current_post_id) // c pour le format ISO 8601
            )
        ),
    );

    $next_post_query = new WP_Query($args_after);

    // Pour l'article précédent
    if ($previous_post_query->have_posts()) {
        while ($previous_post_query->have_posts()) {
            $previous_post_query->the_post();
            // Affichage des informations de l'article, comme le titre, l'image, etc.
            $thumbnail_url_id = get_the_post_thumbnail_url(get_the_ID());
            $post_title = get_the_title();
            $post_permalink = get_permalink();
            ?>
            <a href="<?php echo $post_permalink; ?>">
                <img class="thumbnails img-before" src="<?php echo $thumbnail_url_id; ?>" alt="<?php echo $post_title; ?>">
            </a>
            <?php
        }
    } else {
        // Si aucune photo précédente, afficher la première photo
        $args_first = array(
            'post_type'      => 'photo',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC', // Du moins récent au plus récent
        );

        $first_post_query = new WP_Query($args_first);

        if ($first_post_query->have_posts()) {
            while ($first_post_query->have_posts()) {
                $first_post_query->the_post();
                // Affichage des informations de l'article, comme le titre, l'image, etc.
                $thumbnail_url_id = get_the_post_thumbnail_url(get_the_ID());
                $post_title = get_the_title();
                $post_permalink = get_permalink();
                ?>
                <a href="<?php echo $post_permalink; ?>">
                    <img class="thumbnails img-before" src="<?php echo $thumbnail_url_id; ?>" alt="<?php echo $post_title; ?>">
                </a>
                <?php
            }
        }

        // Réinitialisation des données globales de post
        wp_reset_postdata();
    }


    // Pour l'article suivant
    if ($next_post_query->have_posts()) {
        while ($next_post_query->have_posts()) {
            $next_post_query->the_post();
            // Affichage des informations de l'article, comme le titre, l'image, etc.
            $after_thumbnail_url_id = get_the_post_thumbnail_url(get_the_ID());
            $post_title = get_the_title();
            $after_permalink = get_permalink();
            ?>
            <a href="<?php echo $after_permalink; ?>">
                <img class="thumbnails img-after" src="<?php echo $after_thumbnail_url_id; ?>" alt="<?php echo $post_title; ?>">
            </a>
            <?php
        }
    } else {
        // Si aucune photo suivante, afficher la dernière photo
        $args_last = array(
            'post_type'      => 'photo',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'ASC', // Du plus récent au moins récent
        );

        $last_post_query = new WP_Query($args_last);

        if ($last_post_query->have_posts()) {
            while ($last_post_query->have_posts()) {
                $last_post_query->the_post();
                // Affichage des informations de l'article, comme le titre, l'image, etc.
                $after_thumbnail_url_id = get_the_post_thumbnail_url(get_the_ID());
                $post_title = get_the_title();
                $after_permalink = get_permalink();
?>
                <a href="<?php echo $after_permalink; ?>">
                    <img class="thumbnails img-after" src="<?php echo $after_thumbnail_url_id; ?>" alt="<?php echo $post_title; ?>">
                </a>
                <?php
            }
        }

        // Réinitialisation des données globales de post
        wp_reset_postdata();
    }
    ?>
    <div class="arrows">
        <div class="arrow-left">
            <img src="<?php echo  get_stylesheet_directory_uri() . '/assets/img/arrow-left.png'; ?>" alt="logo fleche gauche">
        </div>
        <div class="arrow-right">
            <img src="<?php echo  get_stylesheet_directory_uri() . '/assets/img/arrow-right.png'; ?>" alt="logo fleche droite">
        </div>
    </div>
</div>
        <!-- photos apparentée à la categorie -->
        <?php
// Nouvelle instance de WP_Query pour récupérer 2 posts de la même catégorie que le post actuel
$args_related_photos = array(
    'post_type' => 'photo',
    'posts_per_page' => 2,  
    'orderby' => 'rand',
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $categorie_name,
        ),
    ),
    'meta_query' => array(
        array(
            'key' => 'references',
            'value' => $references,
            'compare' => '!=', // Exclut les posts avec la même référence
        ),
    ),
);

$related_photos = new WP_Query($args_related_photos);

// Compter le nombre de publications dans la catégorie
$count_posts = wp_count_posts('photo');
$num_posts = $count_posts->publish;

if ($related_photos->have_posts()) :
    


?>
<div class="photo-apparentee">
    <h3>Vous aimerez aussi</h3>
    <div class="catalogue-photos">
        <?php
        while ($related_photos->have_posts()) :
            $related_photos->the_post();
            // Structure du catalogue
            get_template_part('/assets/template-part/catalogue-photos');
        endwhile;
        ?>
    </div>
</div>

<?php
endif;

wp_reset_postdata();
?>
</article>
</section>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/miniature.js"></script>
<?php get_footer();?>