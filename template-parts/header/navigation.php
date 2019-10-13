<?php
/**
 * The template part for header
 *
 * @package VW One Page 
 * @subpackage vw_one_page
 * @since VW One Page 1.0
 */
?>

<button class="toggleMenu toggle" role="tab"><?php esc_html_e('Menu','vw-one-page'); ?></button>
<div id="header" class="menubar">
	<nav class="nav" role="navigation">
		<?php wp_nav_menu( array('theme_location'  => 'primary') ); ?>
	</nav>
</div>