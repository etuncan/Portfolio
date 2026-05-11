<?php
function ppn_get_post_data($default = array(), $post_data_name = '', $post_id = 0) {
	$post_data = get_post_meta($post_id, 'ppn_'.$post_data_name.'_data', true);

	if(!is_array($default)) {
		return array();
	}
	if(!is_array($post_data)) {
		return $default;
	}
	return array_merge($default, $post_data);
}

function ppn_get_sanitize_page_title_data($post_id = 0, $item_data = array()) {
	$page_data = array(
		'title_style' => '1',
		'title_background_image' => '',
		'title_background_color' => '',
		'title_text_color' => '',
		'title_excerpt' => '',
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = ppn_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['title_style'] = ppn_check_array_value(array('', '1', '2'), $page_data['title_style'], '1');
	$page_data['title_background_image'] = esc_url($page_data['title_background_image']);
	$page_data['title_background_color'] = sanitize_text_field($page_data['title_background_color']);
	$page_data['title_text_color'] = sanitize_text_field($page_data['title_text_color']);
	$page_data['title_excerpt'] = implode("\n", array_map('sanitize_text_field', explode("\n", $page_data['title_excerpt'])));
	return $page_data;
}

function ppn_get_sanitize_page_blog_data($post_id = 0, $item_data = array()) {
	$page_data = array(
			'blog_style' => '',
			'blog_post_per_page' => '',
			'blog_categories' => '',
			'blog_post_types' => '',
			'blog_pagination' => ''
	);
	if(is_array($item_data) && !empty($item_data)) {
		$page_data = array_merge($page_data, $item_data);
	} elseif($post_id != 0) {
		$page_data = ppn_get_post_data($page_data, 'page', $post_id);
	}
	$page_data['blog_style'] = ppn_check_array_value(array('default','3x', '4x', '100%','pug_carousel'), $page_data['blog_style'], 'default');
	$page_data['blog_post_per_page'] = intval($page_data['blog_post_per_page']) > 0 ? intval($page_data['blog_post_per_page']) : 5;
	$page_data['blog_categories'] = is_array($page_data['blog_categories']) ? $page_data['blog_categories'] : array();
	$page_data['blog_post_types'] = is_array($page_data['blog_post_types']) ? $page_data['blog_post_types'] : array();
	$blog_pagination = array('normal', 'more', 'disable');
	$page_data['blog_pagination'] = ppn_check_array_value($blog_pagination, $page_data['blog_pagination'], 'normal');
	return $page_data;
}

$POST_TYPE_OPTIONS = array('default' => __('Default', 'ppn'), 'youtube' => __('YouTube Video', 'ppn'), 'vimeo' => __('Vimeo Video', 'ppn'), 'self_video' => __('Self-Hosted Video', 'ppn'));

function ppn_get_sanitize_post_data($post_id = 0, $item_data = array()) {
	global $POST_TYPE_OPTIONS;

	$post_item_data = array(
		'media_type' => '',
		'link' => '',
		'show_featured_image' => ''
	);
	if(is_array($item_data) && !empty($item_data)) {
		$post_item_data = array_merge($item_data);
	} elseif($post_id != 0) {
		$post_item_data = ppn_get_post_data($post_item_data, 'post_general_item', $post_id);
	}

	$post_type_options = array_keys($POST_TYPE_OPTIONS);
	$post_item_data['media_type'] = ppn_check_array_value($post_type_options, $post_item_data['media_type'], 'default');
	if(!in_array($post_item_data['media_type'], array('youtube', 'vimeo'))) {
		$post_item_data['link'] = esc_url($post_item_data['link']);
	}
	$post_item_data['show_featured_image'] = $post_item_data['show_featured_image'] ? 1 : 0;

	return $post_item_data;
}
