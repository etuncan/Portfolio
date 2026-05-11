<?php
	/*
	 * Template for post items 
	 */
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
		$classes[] = 'default-background';
	}

	$link = '';
	if(!$link) {
		$link = get_permalink();
	}

	if(!has_post_thumbnail()):
		$classes[] = 'no-image';
	endif;

	if($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%'):
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
			<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr($post_item_data['media_type']); ?>">
				<?php ppn_post_thumbnail('large', false, 'img-responsive'); ?>
			</a>
			<div class="description">
				<?php 
					the_title('<div class="title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></div>');
				?>
				<?php if($categories): ?>
					<div class="tags">
						<?php foreach ($categories as $key => $category):?>
							<?php if($key): ?><span class="sep">|</span><?php endif;?>
								<a href="<?php echo get_category_link( $category->term_id );
								?>" title="<?php echo esc_attr( sprintf( __( "See all %s", "ppn" ), $category->name ));
								?>" class="cat-link <?php 
										if($category->cat_name=='Available Pugs'){
											echo esc_attr("cat-style-1");
										}
										elseif($category->cat_name=='Medical Hold'||$category->cat_name==='Pending Adoption'){
											echo esc_attr("cat-style-2");
										}
										elseif($category->cat_name=='Adopted Pugs'){
											echo esc_attr("cat-style-3");
										}
								?>">
									<?php echo $category->cat_name; ?>
								</a>
						<?php endforeach;?>
					</div>
				<?php endif;?>
				<div class="summary">
					<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
						<?php echo $post_data['title_excerpt']; ?>
					<?php else: ?>
						<?php echo preg_replace('%&#x[a-fA-F0-9]+;%','',apply_filters('the_excerpt', get_the_excerpt()));?>
					<?php endif; ?>
				</div>
				<div class="info">
					<span class="date"><?php echo get_the_date(); ?></span>
					<span><a href="<?php echo get_permalink(); ?>"><?php //_e('Read more', 'ppn'); ?></a></span>
				</div>
			</div>
		</article>
<?php 
	elseif($blog_style == 'special'): 
?>
		<article id="post-<?php the_ID(); ?>" class="new_pug-cont1">
			<a href="<?php echo esc_url($link); ?>" class="new_pug-img-link">
				<?php ppn_post_thumbnail('med', false, 'img-responsive'); ?>
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
					<span class="date"><?php echo get_the_date(); ?></span>
				</div>	
				<div class="new_pug-btn-cont">
					<?php foreach ($categories as $key => $category):?>
						<?php if($key): ?><span class="sep">|</span>
						<?php endif;
						if($category->cat_name==='Available Pugs'):?>
							<a class="new_pug-btn" 
							   href="<?php echo esc_url(get_permalink(25)); ?>" 
							   title="<?php echo esc_attr(sprintf( __( "See all %s", "ppn" ),
								$category->name));?>"
							>
							<?php echo $category->cat_name;?>
						</a>
					<?php else:?>
						<a class="new_pug-btn" 
						   href="<?php echo get_category_link( $category->term_id );?>" 
						   title="<?php echo esc_attr(sprintf( __( "See all %s", "ppn" ), $category->name));?>"
						>
							<?php echo $category->cat_name;?>
						</a>
					<?php endif;
				endforeach?>
				</div>	
			</div>
		</article><!--custom add-->
<?php
	else:
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
			<div class="item-post-container">
				<div class="item-post">
					<div class="post-image">
						<a href="<?php echo esc_url($link); ?>" class="<?php echo esc_attr($post_item_data['media_type']); ?>">
							<?php ppn_post_thumbnail('ppn-blog-default', true, 'img-responsive'); ?>
						</a>
					</div>
					<div class="post-text">
						<header class="entry-header">
							<?php the_title('<div class="entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></div>');?>
							<div class="entry-meta">
								<?php if($categories):?>
									<span class="tag-links">
										<?php foreach ($categories as $key => $category):
											if($key):?>
												<span class="sep">|</span>
											<?php endif;?>
											<a href="<?php echo get_category_link( $category->term_id );?>"
											   class="cat-link <?php if($category->cat_name=='Available Pugs'){
																echo esc_attr("cat-style-1");
															}
													  		elseif($category->cat_name=='Medical Hold'||$category->cat_name==='Pending Adoption'){
																echo esc_attr("cat-style-2");
															}
													  		elseif($category->cat_name=='Adopted Pugs'){
																echo esc_attr("cat-style-3");
															}?>">
											<?php echo $category->cat_name;?>
										</a>
										<?php endforeach; ?>
									</span><!-- .tag-links -->
								<?php endif ?>
							</div><!-- .entry-meta -->
						</header>
						<div class="entry-content"><p>
							<?php if ( !empty( $post_data['title_excerpt'] ) ): ?>
								<?php echo $post_data['title_excerpt']; ?>
							<?php else: ?>
								<?php echo preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
							<?php endif; ?></p>
						</div><!-- .entry-content -->
						<div class="entry-info">
							<span class="entry-date"><?php echo get_the_date(); ?></span>
							<span class="read-more-link">
								<a href="<?php echo get_permalink(); ?>"> <?php _e('Read more', 'ppn'); ?></a>
							</span>
						</div><!-- .entry-info -->
					</div><!-- .post-text -->
				</div><!-- .item-post -->
			</div><!-- .item-post-container -->
		</article><!-- #post-<?php the_ID(); ?> -->
<?php endif;?>
