<?php
/**
 * Template part for blog page content
 */

	$item_data = array(
		'sidebar_position' => '',
		'sidebar_sticky' => '',
		'blog_style' => 'default',
		'blog_post_per_page' => '',
		'blog_categories' => '',
		'blog_post_types' => '',
		'blog_pagination' => ''
	);
	$item_data = ppn_get_post_data($item_data, 'page', get_the_ID());
	//$sidebar_position = ppn_check_array_value(array('', 'left', 'right'), $item_data['sidebar_position'], '');
	//$sidebar_stiky = $item_data['sidebar_sticky'] ? 1 : 0;
	$panel_classes = array('panel', 'row');
	$center_classes = 'panel-center';
	//$sidebar_classes = '';
?>

<div class="block-content">
	<div class="container">
		<div class="<?php echo esc_attr(implode(' ', $panel_classes)); ?>">
			<div class="<?php echo esc_attr($center_classes); ?>">
				<?php ppn_blog(array('blog_style' => $item_data['blog_style'], 'blog_post_per_page' => $item_data['blog_post_per_page'], 'blog_categories' => $item_data['blog_categories'], 'blog_post_types' => $item_data['blog_post_types'], 'blog_pagination' => $item_data['blog_pagination'])); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry-content">
						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:','ppn') . '</span>',
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
