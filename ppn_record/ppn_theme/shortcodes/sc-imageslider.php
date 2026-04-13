<?php 
function sc_ppn_image_slider($atts){
	$args=shortcode_atts(array('name' => '','images' => '', 'interval' => '' , 'img_size' => ''),$atts);
	$name=$args['name'];
	$name.='-gs-';
	$img_ids=explode(",",$args['images']);
	$interval=$args['interval'];
	$box_width=600;
	$slides=count($img_ids);
	$output='<div id="'.$name.'cont" class="gs-container"><div class="gs-scene"><div class="gs-box" >';
	for($i=0;$i<$slides;$i++){
		$output.='<div id="'.$name.'slide-'.$i.'" class="gs-face image-overlay" style="background-image:url('.esc_attr("'".wp_get_attachment_image_url($img_ids[$i],"full")."'").'); width:100%;"><img ';
		$output.='src="'.wp_get_attachment_image_url($img_ids[$i],"full").'"></div>';
	}
	$output.='</div></div><ol class="gs-control">';
	for($i=0;$i<$slides;$i++){
		$output.='<li><a ';
		if($i===0):
			$output.='class="active"';
		endif;
		$output.='aria-controls="'.$name.'slide-'.$i.'">'.esc_html($i+1).'</a></li>';
	}
	$output.='</ol></div>';
	return $output;
}
add_shortcode('sc_imgslider','sc_ppn_image_slider');
?>
