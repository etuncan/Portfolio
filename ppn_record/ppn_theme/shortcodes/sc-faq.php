<?php
function sc_ppn_faq($atts, $content=null){
	extract(shortcode_atts(array('title' => 'placeholder', 'type' => 'h3' , 'start_state' => 'open', 'icon'=>'', 'icon_position'=>'left'),$atts,'sc_faq'));
	$contId=ppn_prep_title($title);	
	$output='<'.$type.'>';
	$output.='<button class="faq-trig" type="button" data-open-status="'.esc_attr($start_state).'" aria-controls="'.esc_attr($contId).'-content">';
	
	if($icon_position==='left'):	
		$output.='<span class="faq-icon">';
		
		if($icon==='arrow'):
			$output.=add_svg_arrow();
		else:
			$output.=add_svg_plus();
		endif;
		
		$output.='</span><span class="faq-title">'.esc_html($title).'</span>';
	
	elseif($icon_position==='right'):
		$output.='<span class="faq-title">'.esc_html($title).'</span><span class="faq-icon">';		
		
		if($icon==='arrow'):
			$output.=add_svg_arrow();
		else:
			$output.=add_svg_plus();
		endif;
		
		$output.='</span>';
	endif;
	
	$output.='</button></'.$type.'>';
	$output.='<div id="'.$contId.'-content" class="faq-content';
	
	if($start_state==='open'):
		$output.='">';
	else:
		$output.=' content-hide">';
	endif;
	$output.=$content;
	$output.='</div>';
	return $output;
	
	//function calls: add_svg_arrow(),add_svg_plus(),ppn_prep_title()
}
add_shortcode('sc_faq','sc_ppn_faq');
