<header class="banner banner-default banner-sticky hidden-md-down">
	<div class="primary-nav">
		<div class="container">
			<nav class="navbar navbar-toggleable-md">
				<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				<div class="collapse navbar-collapse">
		      <?php
		      if (has_nav_menu('primary_navigation')) :
		        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'navbar-nav ml-auto']);
		      endif;
		      ?>
				</div>
			</nav>
		</div>
	</div>
</header>
