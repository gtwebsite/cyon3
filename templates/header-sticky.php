<header class="banner banner-default banner-sticky hidden-md-down">
	<div class="primary-nav">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			<nav class="float-xs-right simple-nav">
	      <?php
	      if (has_nav_menu('primary_navigation')) :
	        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
	      endif;
	      ?>
	    </nav>
		</div>
	</div>
</header>
