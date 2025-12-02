<?php
wp_enqueue_style('style.css');

/*THUMBNAIL*/
function ppn_post_thumbnail($size = 'ppn-post-thumb', $dummy = true, $class=''){
	if(has_post_thumbnail()):
		the_post_thumbnail($size, array('class' => $class));
	elseif($dummy):
		echo '<span class="sc-dummy '.$class.'"></span>';
	endif;
}