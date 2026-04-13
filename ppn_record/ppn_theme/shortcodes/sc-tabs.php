<?php
function sc_ppn_tabs($atts,$content=null){
	$output=$titles=$e_class=$e_id='';
	extract(
		shortcode_atts(
			array(
				'titles'=>'',
				'e_id'=>'',
				'e_class'=>''
			),
			$atts
		)
	);
	//populate data array
	$title_arr=explode(",",$titles);
	$ticker=count($title_arr);
	$contIds=ppn_sc_contid($title_arr);
	$cont_inner=explode("<section>",$content);
	
	//TODO: make script external in theme
	//wp_enqueue_script('');
	
	//section open tag
	$output.='<section id="'.esc_attr($e_id).'">';
	
	//populates heading
	$output.='<div class="tab-header">';
	for($i=0;$i<$ticker;$i++){
		$output.='<button class="tab-trig" type="button" data-open-status="'; 
		if($i===0):
			$output.='open';
		else:
			$output.='closed'; 
		endif;
		
		$output.='" aria-controls="'.esc_html($contIds[$i]).'-content"><span class="tab-title">'.esc_html($title_arr[$i]).'</span></button>';
	}
	
	//content container openning tag
	$output.='<div class="tab-content-cont">';
		
	//populates inner content
	for($i=1;$i<count($cont_inner);$i++){
		$output.='<section id="'.$contIds[$i].'-content" class="tab-content';
		if($i>1):
			$output.=' content-hide">';
		else:
			$output.='">';
		endif;
		
		$output.=$cont_inner[$i];
	}	
	//content container and section close tags
	$output.='</div></section>';
	
	return $output;
	
	//function calls: none
}
add_shortcode('ppn_tabs','sc_ppn_tabs');
function ppn_sc_contid($t){
	$output=[];
	foreach($t as $value){
		$output[]=ppn_prep_title($value);
	}
	unset($value);
	return $output;
}
