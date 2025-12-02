<?php

	$blog_style = isset($blog_style) ? $blog_style : 'default';

	$post_data = ppn_get_sanitize_page_title_data(get_the_ID());

	$post_item_data = ppn_get_sanitize_post_data(get_the_ID());

	if(empty($post_item_data)) {
		$post_item_data = array(
			'media_type' => 'default',
			'link' => '',
			'show_featured_image' => 0
		);
	}

	$categories = get_the_category();

	$classes = array();

	if($blog_style == 'default') {
		$classes[] = '';
		if(is_sticky() && !is_paged()) {
			$classes = array_merge($classes, array('bordered-box', 'shadow-box'));
		} else {
			$classes[] = 'default-background';
		}
	}

	$link = '';
	if(!$link) {
		$link = get_permalink();
	}

	if (!has_post_thumbnail())
		$classes[] = 'no-image';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr($post_item_data['media_type']); ?>">
			<?php ppn_post_thumbnail('large', false, 'img-responsive'); ?>
		</a>
		<div class="description">
			<?php the_title('<div class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>'); ?>
			<?php if($categories): ?>
				<div class="tags">
					<?php $special_category_one = get_the_category();?>
					<?php foreach ($categories as $key => $category): ?>
						<?php if($key): ?><span class="sep">|</span><?php endif; ?>
						<a href="<?php if(($special_category_one[0]->name) == 'Available Pugs'){echo get_permalink(25);}else{echo get_category_link( $category->term_id );} ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", "scalia" ), $category->name ) ); ?>"><?php echo $category->cat_name; ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif ?>
			<div class="summary">
				<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
					<?php echo $post_data['title_excerpt']; ?>
				<?php else: ?>
					<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
				<?php endif; ?>
			</div>
			<div class="info clearfix">
				<span class="date"><?php echo get_the_date(''); ?></span>
				<a href="<?php echo get_permalink(); ?>"><?php _e('Read more', 'scalia'); ?></a></span>
			</div>
		</div>
	</article>
<?php elseif($blog_style == 'special'): ?>
	<article id="post-<?php the_ID(); ?>" class="new_pug-cont1">
		<a href="<?php echo esc_url($link); ?>" class="new_pug-img-link">
			<?php scalia_post_thumbnail('med', false, 'img-responsive'); ?>
		</a>
		<div class="new_pug-desc">
			<?php the_title('<div class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>'); ?>
			<div class="new_pug-excerpt">
				<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
					<?php echo $post_data['title_excerpt']; ?>
				<?php else: ?>
					<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
				<?php endif; ?>
			</div>
			<div class="new_pug-date">
				<span class="date"><?php echo get_the_date(''); ?></span>
			</div>	
			<?php $special_category_one = get_the_category();?>
			<?php foreach ($categories as $key => $category): ?>
			<div class="new_pug-btn-cont">
				<a class="new_pug-btn" href="<?php echo esc_url(get_permalink(25)); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", "scalia" ), $category->name ) ); ?>"><?php echo $category->cat_name; ?></a>
			</div>	
			<?php endforeach; ?>
		</div>
	</article><!--custom add-->
<?php else : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<?php
			if(!is_single() && is_sticky() && $blog_style == 'default' && !is_paged()) {
				echo '<div class="sticky-label">'.__('Sticky', 'scalia').'</div>';
			}
		?>
		<div class="item-post-container">
			<div class="item-post clearfix">

				<?php
					if(!is_single() && is_sticky() && $blog_style == 'default' && !is_paged()) :
						the_title('<div class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>');
					endif;
				?>

				<div class="post-image">

					<?php
						$default_image = '<img src="' . get_template_directory_uri() .'/images/news-timeline-default.png" width="72" height="72" alt="" />';
						if ($blog_style == 'timeline' || $blog_style == 'styled_list1') {
							if (has_post_thumbnail()) {
								echo '<a href='.get_permalink().'>';
								scalia_post_thumbnail('scalia-post-thumb', false, '');
								echo '</a>';
							} else {
								echo $default_image;
							}
						} else if ($blog_style == 'styled_list2') {
							if (has_post_thumbnail()) {
								echo  '<a href='.get_permalink().'>';
								scalia_post_thumbnail('scalia-post-thumb', false, '');
								echo '</a>';
							} else {
								echo $default_image;
							}
						} else {
							?>
								<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr($post_item_data['media_type']); ?>"><?php scalia_post_thumbnail('scalia-blog-default', true, 'img-responsive'); ?></a>
							<?php
						}
					?>

					<?php
					if ($blog_style == 'timeline' || $blog_style == 'styled_list1' || $blog_style == 'styled_list2') {
						echo '<div class="post-date-wrapper"><div class="post-date">';
								scalia_posted_on();
								echo '<span class="post-time"><span>';
									the_time('H:i');
								echo '</span></span>';
						echo '</div></div>';
					}
					?>

				</div>
				<div class="post-text">
					<header class="entry-header">

						<?php
							/*if (is_single()) :
								the_title('<h4 class="entry-title">', '</h4>');
							else*/ if(!is_sticky() || $blog_style != 'default' || is_paged()) :
								the_title('<div class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>');
							endif;
						?>

						<div class="entry-meta">
							<?php if($categories): ?>
								<?php if ($blog_style != 'timeline' && $blog_style != 'styled_list1' && $blog_style != 'styled_list2'): ?><?php endif; ?><span class="tag-links">
									<?php foreach ($categories as $key => $category): ?>
										<?php if($key): ?><span class="sep">|</span><?php endif; ?>
										<a href="<?php echo get_category_link( $category->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s", "scalia" ), $category->name ) ); ?>"><?php echo $category->cat_name; ?></a>
									<?php endforeach; ?>
								</span>
							<?php endif ?>
						</div>
						<!-- .entry-meta -->
					</header>
					<!-- .entry-header -->

					<?php if (is_search()) : ?>
						<div class="entry-summary">
					<?php else: ?>
						<div class="entry-content">
					<?php endif; ?>
						<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
							<?php echo $post_data['title_excerpt']; ?>
						<?php else: ?>
							<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
						<?php endif; ?>
					</div>

					<div class="clearfix entry-info">
						<?php if ($blog_style == 'timeline' || $blog_style == 'styled_list1' || $blog_style == 'styled_list2'): ?>
							<div class="styled-blog-meta">
							<?php if(comments_open() && $comments_count = get_comments_number()): ?>
								<span class="comments"><?php echo $comments_count; ?></span>
							<?php endif; ?>
						<?php else: ?>
							<?php
								if ($blog_style != 'timeline' && $blog_style != 'styled_list1' && $blog_style != 'styled_list2') {
									if ('post' == get_post_type())
										scalia_posted_on();
								}
							?>
							<?php if(comments_open() && $comments_count = get_comments_number()): ?>
								<span class="comments-link"><?php comments_popup_link(__('Leave a comment', 'scalia'), __('1 Comment', 'scalia'), __('% Comments', 'scalia'), 'rounded-corners'); ?>	</span>
							<?php endif; ?>
						<?php endif; ?>
						<span class="read-more-link"><a href="<?php echo get_permalink(); ?>"> <?php _e('Read more', 'scalia'); ?></a></span>
						<?php if ($blog_style == 'timeline' || $blog_style == 'styled_list1' || $blog_style == 'styled_list2'): ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
<?php endif; ?>