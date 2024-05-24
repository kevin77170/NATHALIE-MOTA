<?php
// Récupérer les informations : image mise en avant (thumbnail_url), URL du post, titre, catégorie, référence
$thumbnail_url = get_the_post_thumbnail_url();
$post_url = get_permalink();
$post_title = get_the_title();
$reference = get_field('references');
$categories = get_the_terms(get_the_ID(), 'categorie');

// Initialiser un tableau pour stocker les noms des catégories
$categorie_names = [];

if ($categories && !is_wp_error($categories)) {
    foreach ($categories as $categorie) {
        // Ajouter le nom de chaque catégorie dans le tableau $categorie_names
        $categorie_names[] = $categorie->name;
    }
}

// Imploser le tableau des noms des catégories en une chaîne
$categorie_names_str = implode(', ', $categorie_names);
?>
<div class="post-container">
    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($post_title); ?>">
    <div class="overlay">
        <div class="reference"><?php echo esc_html($post_title); ?></div>
        <div class="categorie"><?php echo esc_html($categorie_names_str); ?></div>
        <div class="eye-icon">
            <a href="<?php echo esc_url($post_url); ?>">
                <i class="fa fa-eye"></i>
            </a>
        </div>
        <div class="expand-icon">
            <a class="icon" href="#" data-reference="<?php echo esc_attr($reference); ?>" data-categorie="<?php echo esc_attr($categorie_names_str); ?>" data-thumbnail-url="<?php echo esc_url($thumbnail_url); ?>">
                <i class="fa fa-expand"></i>
            </a>
        </div>
    </div>
</div>