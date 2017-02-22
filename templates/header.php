<header class="banner banner-default hidden-md-down">
	<?php if ( is_active_sidebar( 'sidebar-header' ) ) : ?>
	<div class="secondary-nav">
		<div class="container">
			<?php dynamic_sidebar('sidebar-header'); ?>
		</div>
	</div>
	<?php endif; ?>
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
<header class="banner banner-mobile-default hidden-lg-up">
	<div class="container">
		<nav class="navbar navbar-toggleable-md">
			<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			<button class="navbar-toggler navbar-toggler-right menu-button" type="button">
				<span class="sr-only">Main Navigation</span>
				<i class="fa fa-bars"></i>
			</button>
			<?php
			if (has_nav_menu('primary_navigation')) :
				wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'flexnav list-unstyled']);
			endif;
			?>
		</nav>
	</div>
</header>
