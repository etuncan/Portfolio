<?php
/**
 * Template part for post content
 */
//TODO:Remake Sidebar asset

	$item_data = array(
		'sidebar_position' => '',
		'blog_style' => 'default',
		'blog_post_per_page' => '',
		'blog_categories' => '',
		'blog_post_types' => '',
		'blog_pagination' => ''
	);
	$item_data = ppn_get_post_data($item_data, 'page', get_the_ID());
	//$sidebar_position = ppn_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	$panel_class='block-container';
	$center_class = 'wrapper-center';
	//$sidebar_classes = '';
?>

<div class="block-content">
	<div class="container">
		<div class="<?php echo esc_attr($panel_class); ?>">
			<div class="<?php echo esc_attr($center_class); ?>">
				<?php ppn_blog(array('blog_style' => $item_data['blog_style'], 'blog_post_per_page' => $item_data['blog_post_per_page'], 'blog_categories' => $item_data['blog_categories'], 'blog_post_types' => $item_data['blog_post_types'], 'blog_pagination' => $item_data['blog_pagination'])); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ppn' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
			</div>
		</div>
	</div>
</div>
