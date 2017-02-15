<footer class="content-info">
	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
	<div class="buckets">
	  <div class="container">
	  	<aside class="widgets matchHeight">
	    	<?php dynamic_sidebar('sidebar-footer'); ?>
	    </aside>
	  </div>
	</div>
	<?php endif; ?>
	<div class="footer">
		<div class="container">
			<div class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. <?php _e('All rights reserved.', 'cyon'); ?></div>
			<?php
			if (has_nav_menu('footer_navigation')) :
				wp_nav_menu(['theme_location' => 'footer_navigation','menu_class'=>'list-inline']);
			endif;
			?>
		</div>
	</div>
</footer>
