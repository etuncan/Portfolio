<?php
require get_template_directory() . '/inc/content.php';
require get_template_directory() . '/inc/post-types/init.php';
require get_template_directory() . '/shortcodes/ppn_shortcodes.php';
require get_template_directory() . '/shortcodes/sc-faq.php';
require get_template_directory() . '/shortcodes/sc-accordion.php';
require get_template_directory() . '/shortcodes/sc-imageslider.php';
require get_template_directory() . '/plugins/plugins.php';

if(!function_exists('ppn_setup')) :
	function ppn_setup() {
		load_theme_textdomain('ppn', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('woocommerce');
		add_theme_support('title-tag');
		set_post_thumbnail_size(672, 372, true);
		add_image_size('ppn-post-thumb', 256, 256, true);
		register_nav_menus(array(
			'primary' => __('Top primary menu', 'ppn'),
			'footer'  => __('Footer menu', 'ppn'),
		));
	}
endif;
add_action('after_setup_theme', 'ppn_setup');

function ppn_enqueue_style() {
    wp_enqueue_style( 'ppn-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'ppn_enqueue_style' );

function ppn_scripts() {
	wp_enqueue_style('ppn-header', get_template_directory_uri() . '/css/header.css');
	wp_register_style('ppn-blog', get_template_directory_uri() . '/css/blog.css');
	
	/* Lazy Loading */
	//wp_enqueue_script('ppn-lazy-loading', get_template_directory_uri() . '/js/jquery.lazyLoading.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'ppn_scripts');

/*THUMBNAIL*/
function ppn_post_thumbnail($size = 'ppn-post-thumb', $dummy = true, $class=''){
	if(has_post_thumbnail()):
		the_post_thumbnail($size, array('class' => $class));
	elseif($dummy):
		echo '<span class="sc-dummy '.$class.'"></span>';
	endif;
}

if(!function_exists('ppn_get_option')) {
	function ppn_get_option($name, $default = false, $ml_full = false) {
		$options = get_option('ppn_theme_options');
		if(!isset($options['logo'])){
			$options['logo']='www.pugpartners.com/wp-content/uploads/2016/03/pug-partners-logo-default.png';
			update_option('ppn_theme_options',$options);
		}
		if(isset($options[$name])) {
			$ml_options = array('home_content', 'footer_html', 'contacts_address', 'contacts_phone', 'contacts_fax', 'contacts_email', 'contacts_website');
			if(in_array($name, $ml_options) && is_array($options[$name]) && !$ml_full) {
				if(defined('ICL_LANGUAGE_CODE')) {
					global $sitepress;
					if(isset($options[$name][ICL_LANGUAGE_CODE])) {
						$options[$name] = $options[$name][ICL_LANGUAGE_CODE];
					} elseif($sitepress->get_default_language() && isset($options[$name][$sitepress->get_default_language()])) {
						$options[$name] = $options[$name][$sitepress->get_default_language()];
					} else {
						$options[$name] = '';
					}
				}else {
					$options[$name] = reset($options[$name]);
				}
			}
			return apply_filters('ppn_option_'.$name, $options[$name]);
		}
		return apply_filters('ppn_option_'.$name, $default);
	}
}

function ppn_check_array_value($array = array(), $value = '', $default = '') {
	if(in_array($value, $array)) {
		return $value;
	}
	return $default;
}

/*PAGE TITLE*/

function ppn_title($sep = '&raquo;', $display = true, $seplocation = '') {
	global $wpdb, $wp_locale;
	$title = '';
	$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

	// If there is a post
	if(is_single() || is_page()) {
		$title = single_post_title('', false);
	}
	// If there's a category or tag
	if(is_category() || is_tag()) {
		$title = single_term_title('', false);
	}
	// If there's a taxonomy
	if(is_tax()) {
		$term = get_queried_object();
		if($term) {
			$tax = get_taxonomy($term->taxonomy);
			$title = single_term_title('', false);
		}
	}
	// If it's a 404 page
	if(is_404()) {
		$title = __('Page not found', 'ppn');
	}
	$prefix = '';
	if(!empty($title))
		$prefix = " $sep ";

 	// Determines position of the separator and direction of the breadcrumb
	if('right' == $seplocation) { // sep on right, so reverse the order
		$title_array = explode($t_sep, $title);
		$title_array = array_reverse($title_array);
		$title = implode(" $sep ", $title_array) . $prefix;
	} else {
		$title_array = explode($t_sep, $title);
		$title = $prefix . implode(" $sep ", $title_array);
	}

	/**
	 * Filter the text of the page title.
	 * @param string $title       Page title.
	 * @param string $sep         Title separator.
	 * @param string $seplocation Location of the separator (left or right).
	 */
	$title = apply_filters('ppn_title', $title, $sep, $seplocation);

	// Send it out
	if($display):
		echo $title;
	else:
		return $title;
	endif;
}

function ppn_page_title() {
	$output = '';
	$title_class = '';
	$css_style = '';
	$css_style_title = '';
	$title_style = 1;
	if(is_singular()){
		global $post;
		$post_id = $post->ID;
		$page_data = ppn_get_sanitize_page_title_data($post_id);
		$title_style = $page_data['title_style'];
		
		if($page_data['title_background_image']) {
			$css_style .= 'background-image: url('.$page_data['title_background_image'].');';
			$title_class = 'has-bg-image';
		}
		if($page_data['title_background_color']) {
			$css_style .= 'background-color: '.$page_data['title_background_color'].';';
		}
		
		if($page_data['title_text_color']) {
			$css_style_title = 'color: '.$page_data['title_text_color'].';';
		}
	}

	if(is_tax() || is_category() || is_tag()) {
		$term = get_queried_object();
		$excerpt = $term->description;
	}

	$output .= '<div class="page-title-text"><'.($title_style == '2' ? 'h2' : 'h1').' style="'.$css_style_title.'">'.ppn_title('', false).'</'.($title_style == '2' ? 'h2' : 'h1').'></div>';
	
	if($title_style && get_the_title($post_id)!=="Home") {
		return '<div id="page-title" class="page-title-block page-title-style-'.$title_style.' '.$title_class.'" style="'.$css_style.'"><div class="container">'.$output.'</div></div>';
	}
	return false;
}

function get_shortcode_scripts(){
	global $post;
	if(has_shortcode($post->post_content,'sc_faq')){
		wp_enqueue_script('sc_faq_script', get_template_directory_uri() . '/js/faq.js');
	}
	if(has_shortcode($post->post_content,'sc_accord')){
		wp_enqueue_script('sc_accordion_script', get_template_directory_uri() . '/js/accordion.js');
	}
	if(has_shortcode($post->post_content,'sc_imgslider')){
		wp_enqueue_script('sc_imageslider_script', get_template_directory_uri() . '/js/imageslider.js');
	}	
	if(has_block('blockstudio/imgslider-block',$post)){
		wp_enqueue_script('sc_imageslider_script', get_template_directory_uri() . '/js/imageslider.js');
	}
	if(has_shortcode($post->post_content,'sc_imgslider')){
		wp_enqueue_script('sc_imageslider_script', get_template_directory_uri() . '/js/imageslider.js');
	}
	if(has_shortcode($post->post_content,'ppn_tabs')){
		wp_enqueue_script('ppn_tabs_script', get_template_directory_uri() . '/js/tabs.js');
	}	
	wp_register_script('ppn-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array('jquery'), '', true);
	wp_register_script('ppn-isotope', get_template_directory_uri() . '/js/isotope.min.js', array('jquery'), '', true);
	wp_register_script('ppn-blog', get_template_directory_uri() . '/js/ppn-blog.js');
	wp_enqueue_script('header_script', get_template_directory_uri() . '/js/header.js', array(),'1.2');
}
add_action('wp_enqueue_scripts', 'get_shortcode_scripts');

function category_template_redirect(){
    if(is_category('adopted-pugs')) {
        $url = site_url('/adopted-pugs');
        wp_safe_redirect($url,301);
        exit;
    }
	elseif(is_category('available-pugs')) {
        $url = site_url('/pugs-available-for-adoption');
        wp_safe_redirect($url,301);
        exit;
    }
}
add_action('template_redirect', 'category_template_redirect');
?>
