<?php use Roots\Sage\Titles; ?>

<header class="page-header">
	<div class="container">
  	<h1><?= Titles\title(); ?></h1>
		<?php if( is_single() ) { get_template_part('templates/entry-meta'); } ?>
  </div>
</header>
