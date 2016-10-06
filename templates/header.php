<header class="banner banner-sticky hidden-md-down">
	<nav class="navbar navbar-full">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
      <div class="pull-xs-right">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
      </div>
		</div>
	</nav>
</header>
<header class="banner banner-main">
	<nav class="navbar navbar-full">
		<div class="container">
			<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			<button class="navbar-toggler hidden-md-up pull-xs-right" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="mainnav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-navicon"></i></button>
      <div class="collapse navbar-toggleable-sm pull-md-right" id="mainnav">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav']);
        endif;
        ?>
      </div>
		</div>
	</nav>
</header>
