<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<?php if(ppn_get_option('favicon')) : ?>
		<link rel="shortcut icon" href="<?php echo ppn_get_option('favicon'); ?>" />
	<?php endif; ?>
	
	<?php wp_head(); ?>
</head>

<?php
	$body_classes = array();
	if(is_home()) {
		$effects_disabled = ppn_get_option('home_effects_disabled', false);
	} else {
		global $post;
		if(is_object($post)) {
			$ppn_page_data = get_post_meta($post->ID, 'ppn_page_data', true);
		}
	}
?>

<body <?php body_class($body_classes); ?>>

<div id="page" class="layout-<?php echo esc_attr(ppn_get_option('page_layout_style', 'fullwidth')); ?>">

	<?php if(!ppn_get_option('disable_scroll_top_button')) : ?>
		<a href="#" id="scroll-top-button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" height="20px" width="20px"><polyline points="16 8 8 8 8 16" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"/></svg></a>
	<?php endif; ?>

	<header id="site-header" class="site-header" role="banner">
		<div class="container">
			<div class="header-main">
				<div class="site-title">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php if(ppn_get_option('logo')): ?>
								<span class="logo"><img src="<?php echo esc_url(ppn_get_option('logo')); ?>" class="default" alt=""></span>
							<?php endif; ?>
						</a>
				</div>
				<?php if(has_nav_menu('primary')) : ?>
				<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
					<button id="primary-menu-button" class="menu-toggle dl-trigger" data-open="no">
						<svg viewBox="0 0 40 40">
							<line class="top-line" x1="6" y1="10" x2="34" y2="10"/>
							<line class="middle-line" x1="6" y1="20" x2="34" y2="20"/>
							<line class="middle-line" x1="6" y1="20" x2="34" y2="20"/>
							<line class="bottom-line" x1="6" y1="30" x2="34" y2="30"/>
						</svg>
					</button>
					<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu dl-menu styled no-responsive', 'container' => false)); ?>
				</nav>
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #site-header -->

	<div id="main" class="site-main">
