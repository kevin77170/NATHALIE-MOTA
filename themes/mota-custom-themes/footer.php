<footer id="footer">
	<nav class="menu-footer">
        <?php 
            // Affichage du menu footer déclaré dans functions.php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class' => 'footer',
            )); 
            
            // ajout du template modal-contact 
            get_template_part('./assets/template-part/modal-contact'); 
                 
            // ajout du template lightbox 
            get_template_part('/assets/template-part/lightbox'); 
        ?>
            <p>TOUS DROITS RÉSERVÉS</p>
    </nav>
</footer>
</body>
</html>