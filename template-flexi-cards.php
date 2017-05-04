<?php
/**
 * Template Name: Flexi Cards Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
	  <?php get_template_part('templates/page', 'header'); ?>

		<!-- Default f-cards -->
		<div class="f-row">
			<div class="f-card f-card-fill col-sm-6 col-lg-4">
				<div class="f-card-header">
					<img src="https://placehold.it/660x400" alt="" class="f-card-image" />
				</div>
				<div class="f-card-main">
					<h4 class="f-card-title">Card Title</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
					<p><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
				<div class="f-card-footer">
					<a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-secondary">Button</a>
				</div>
			</div>
			<div class="f-card col-sm-6 col-lg-4">
				<div class="f-card-header">
					<img src="https://placehold.it/660x400" alt="" class="f-card-image" />
				</div>
				<div class="f-card-main">
					<h4 class="f-card-title">Card Title</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<p><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
				<div class="f-card-footer f-card-action">
					<a href="#" class="btn btn-primary btn-block">Button</a>
				</div>
			</div>
			<div class="f-card f-card-fill col-sm-6 col-lg-4">
				<div class="f-card-header">
					<img src="https://placehold.it/660x400" alt="" class="f-card-image" />
				</div>
				<div class="f-card-main">
					<h4 class="f-card-title">Card Title</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<p><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
				<div class="f-card-footer f-card-action row no-gutters">
					<div class="col-6">
						<a href="#" class="btn btn-success btn-block">Button</a>
					</div>
					<div class="col-6">
						<a href="#" class="btn btn-danger btn-block">Button</a>
					</div>
				</div>
			</div>
		</div>

  </article>
<?php endwhile; ?>
