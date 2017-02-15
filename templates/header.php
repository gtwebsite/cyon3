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
			<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			<nav class="float-xs-right">
	      <?php
	      if (has_nav_menu('primary_navigation')) :
	        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
	      endif;
	      ?>
	    </nav>
		</div>
	</div>
</header>
<header class="banner banner-mobile-default hidden-lg-up">
	<div class="container">
		<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
		<button class="navbar-toggler float-xs-right" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="sr-only">Main Navigation</span>
			<i class="fa fa-bars"></i>
		</button>
	</div>
</header>
<nav class="collapse clearfix" id="mainNav">
	<div class="container">
		<?php
		if (has_nav_menu('primary_navigation')) :
			wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
		endif;
		?>
	</div>
</nav>
