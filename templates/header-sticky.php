<header class="banner banner-default banner-sticky d-none d-lg-block">
	<div class="primary-nav">
		<div class="container">
			<nav class="navbar navbar-expand-lg">
				<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				<div class="collapse navbar-collapse">
		      <?php
		      if (has_nav_menu('primary_navigation')) :
		        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav ml-auto', 'walker' => new WP_Bootstrap_Navwalker()]);
		      endif;
		      ?>
				</div>
			</nav>
		</div>
	</div>
</header>
