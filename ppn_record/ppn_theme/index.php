<?php get_header(); ?>

<div id="main-content" class="main-content">

<?php echo ppn_page_title(); /*LOC:functions.php*/ ?>

	<div class="block-content">
		<div class="container">
			<div class="<?php /*echo esc_attr(implode(' ', $panel_classes));*/ /*TODO:update panel classes*/ ?>">
				<div class="<?php /*echo esc_attr($center_classes);*/ /*TODO:update center classes*/ ?>">
				<?php
					if(have_posts()):
						if(!is_singular()):
							wp_enqueue_style('ppn-blog'); echo '<div class="blog blog-style-default">';
						endif;
						
						while(have_posts()): 
							the_post();
							get_template_part('content','blog-item');
						endwhile;
						
						if(!is_singular()): 
							/*ppn_pagination(); TODO:change pagination to function*/ echo '</div>';
						endif;
					else:
						get_template_part('content','none');
					endif;
				?>
				</div>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php get_footer();?>
