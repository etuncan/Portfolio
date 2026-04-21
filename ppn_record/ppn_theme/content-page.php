<?php
/*
 * Template part for content on home page
 */

$page_data = array('title' => ppn_get_sanitize_page_title_data(get_the_ID()));
	
if(get_post_type() == 'page') {
	$page_data['blog'] = ppn_get_sanitize_page_blog_data(get_the_ID());
}

$container_1='block-container';
$container_2='block-wrapper';
?>

<div class="<?php echo esc_attr($container_1); ?>" style="<?php if(get_the_title(get_the_ID())==='Home'){echo esc_attr('padding-top:0;');}?>">
	<div class="<?php echo esc_attr($container_2); ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content post-content">
				<?php
					$post_data = array();
					if(function_exists('ppn_get_sanitize_post_data')) {
						$post_data = ppn_get_sanitize_post_data(get_the_ID());
					}
					$category_name_special= get_the_category();
						if(!empty($category_name_special) && ($category_name_special[0]->name)=='Available Pugs'){
							echo '<div class="info-alert"><div class="info-alert-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"/></svg></div><p class="info-alert-text"> None of our adoptions are on a first come, first serve basis. We match our dogs with the family that suits them best. Please read our <a style="color: #fd3;" href="https://pugpartners.com/adoption-procedures">Adoption Procedures</a> before continuing.</p></div>';
						}
					if((get_post_type() == 'post' || get_post_type() == 'scalia_news') && !empty($post_data['show_featured_image']) && has_post_thumbnail()) {
						echo '<div class="blog-post-image centered">';
						scalia_post_thumbnail('scalia-gallery-fullwidth', false, 'img-responsive');
						echo '</div>';
					}
				?>
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

				<div class="block-divider"></div>
			<?php //if (get_post_type() == 'post') { ppn_related_posts(); } ?>
		</article><!-- #post-## -->

	</div>
