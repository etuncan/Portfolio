<?php 
/*function ppn_content_block($params = array()) {
	$content_block_query = new WP_Query('page_id=' . $params['page']);
	if($content_block_query->have_posts()):
		while ($content_block_query->have_posts()):
			$content_block_query->the_post();
			get_template_part('content', 'page-content-block');
		endwhile;
	endif;
	wp_reset_postdata();
}*/

function ppn_blog($params = array()) {
	$params = array_merge(array(
		'blog_style' => 'default',
		'blog_post_per_page' => '',
		'blog_categories' => '',
		'blog_post_types' => '',
		'blog_pagination' => '',
		'blog_ignore_sticky' => 0,
		'is_ajax' => false,
		'paged' => -1,
		'effects_enabled' => false
	), $params);

	$params['blog_pagination'] = ppn_check_array_value(array('normal', 'more', 'disable'), $params['blog_pagination'], 'normal');

	$paged = get_query_var('paged') ? intval(get_query_var('paged')) : (get_query_var('page') ? intval(get_query_var('page')) : 1);

	if ($params['blog_pagination'] == 'disable'):
		$paged = 1;
	endif;
	
	if ($params['paged'] != -1):
		$paged = $params['paged'];
	endif;
	
	$params['blog_style'] = ppn_check_array_value(array('default', 'timeline', '3x', '4x', '100%', 'grid_carousel', 'styled_list1', 'styled_list2', 'special'), $params['blog_style'], 'default');
	
	$params['blog_post_per_page'] = intval($params['blog_post_per_page']) > 0 ? intval($params['blog_post_per_page']) : 5;
	// statement(integer of param is > 0) true:integer of param  false:5   
	
	if(!is_array($params['blog_categories']) && $params['blog_categories']):
		$params['blog_categories'] = explode(',', $params['blog_categories']);
	endif;
	//if var is not array and exists make into array 

	$params['blog_post_types'] = is_array($params['blog_post_types']) ? $params['blog_post_types'] : array('post');

	$args = array(
		'post_type' => $params['blog_post_types'],
		'posts_per_page' => $params['blog_post_per_page'],
		'post_status' => 'publish',
		'ignore_sticky_posts' => $params['blog_ignore_sticky'],
		'paged' => $paged
	);
	
	if(!empty($params['blog_categories']) && !in_array('--all--', $params['blog_categories'])):
		$args['tax_query'] = array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $params['blog_categories']
			),
			array(
				'taxonomy' => 'scalia_news_sets',
				'field' => 'slug',
				'terms' => $params['blog_categories']
			),
		);
	endif;

	$posts = new WP_Query($args);
	//start new query

	if($params['blog_pagination'] == 'more'):
		if($posts->max_num_pages > $paged):
			$next_page = $paged + 1;
		else:
			$next_page = 0;
		endif;
	endif;
	//if param is 'more' and the number of posts in set > than current page number

	$blog_style = $params['blog_style'];

	wp_enqueue_style('ppn-blog');

	if($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%') {
		wp_enqueue_script('ppn-imagesloaded');
		wp_enqueue_script('ppn-isotope');
	}
	wp_enqueue_script('ppn-blog');

	$localize = array_merge(
		array('data' => $params),
		array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('blog_ajax-nonce')
		)
	);
	wp_localize_script('ppn-blog', 'blog_ajax', $localize);

	if($posts->have_posts()) {

		if($params['is_ajax']):
			echo '<div data-page="' . $paged . '" data-next-page="' . $next_page . '">'; 
		else:
			if ($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%'):
				echo '<div class="preloader"></div>';
				echo '<div class="blog blog-style-'.str_replace('%', '', $blog_style).($blog_style == 'styled_list1' || $blog_style == 'styled_list2' ? ' blog-style-timeline ' : '').' clearfix '.($blog_style == '3x' || $blog_style == '4x' || $blog_style == '100%' ? 'blog-style-masonry ' : '').($blog_style == '100%' ? 'fullwidth-block' : '').'">';
			elseif($blog_style == 'default'):
				echo '<div class="blog blog-style-default">';
			endif;
		endif;

		while($posts->have_posts()):
			$posts->the_post();
			include(locate_template('content-blog-item.php'));
		endwhile;
		
		echo '</div>';
		
		if($params['blog_pagination'] == 'normal' && !$params['is_ajax']):
			//ppn_pagination($posts);
		endif;
		
		if($params['blog_pagination'] == 'more' && !$params['is_ajax'] && $posts->max_num_pages > $paged): ?>
				<div class="blog-load-more">
					<button class="load-more-button">
						<?php _e('Load More', 'ppn'); ?>
					</button>
				</div>
		<?php 
		endif;
	}
	wp_reset_postdata();
}
function load_more_ajax_handler() {
    check_ajax_referer('blog_ajax-nonce', 'nonce');
    $paged = $_POST['paged'];
    $posts_per_page = $_POST['posts_per_page'];
	$category = get_the_category();
    $args = array(
		'post_type' => 'post',
		'category_name' => 'adopted-pugs',
		'posts_per_page' => $posts_per_page,
		'post_status' => 'publish',
		'paged' => $paged
    );
	
    $ajaxposts = new WP_Query($args);
    $response = '';

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            ob_start();
            	include(locate_template('content-blog-item.php'));
            $response .= ob_get_clean();
        endwhile;
    } else {
        $response = ''; // No more posts
    }
    echo $response;
    
    exit;
}
add_action('wp_ajax_load_more_posts', 'load_more_ajax_handler');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_ajax_handler');
