<?php 
/*
 * Template for displaying pages
 */
?>
<?php get_header();?>

<div id="main-content" class="main-content">

<?php echo ppn_page_title(); ?>

<?php
	while (have_posts()) : the_post();
		get_template_part('content','page');
	endwhile;
?>

</div><!-- #main-content -->

<?php get_footer();
