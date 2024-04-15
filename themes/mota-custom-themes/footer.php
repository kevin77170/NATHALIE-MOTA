<footer id="footer">
	<nav class="menu-footer">
        <?php 
        // Affichage du menu footer déclaré dans functions.php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class' => 'footer',
            )); 
        ?>
    </nav>
</footer>
</body>
</html>