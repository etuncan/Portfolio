<?php get_header(); ?>

<div id="main-content" class="main-content">

<?php echo ppn_page_title(); //Loc:functions.php?>

	<div class="block-content">
		<div class="container">
			<div class="<?php //echo esc_attr(implode(' ', $panel_classes)); ?>">
				<div class="<?php //echo esc_attr($center_classes); ?>">
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
							/*ppn_pagination();*/ echo '</div>';
						endif;
					//TODO:Add else option
					endif;
				?>
				</div>
			</div>
		</div><!-- .container -->
	</div><!-- .block-content -->
</div><!-- #main-content -->

<?php
get_footer();
