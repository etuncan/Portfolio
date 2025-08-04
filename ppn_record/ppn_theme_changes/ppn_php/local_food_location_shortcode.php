<?php
function sc_custom_container($atts, $content=null){
	$args=shortcode_atts(array('elid'=>'','elclass'=>''),$atts);
	$elid=$args['elid'];
	$elclass=$args['elclass'];
	$output='<div ';
	if($elid!==''):
		$output.='id="'.$elid.'"';
	endif;
	if($elclass!==''):
		$output.='class="'.$elclass.'"';
	endif;
	$output.='>';
	echo $output;
	echo do_shortcode($content).'</div>';
}
add_shortcode('custom_cont','sc_custom_container');
function sc_localfood_location($atts, $content=null){
	$args=shortcode_atts(array('name' => '', 'type' => '' , 'open' => '0'),$atts);
	$name=$args['name'];
	$type=$args['type'];
	$open=$args['open'];
	$output=localfood_outline($name,$type,$open);
	echo $output;
	echo do_shortcode($content).'</div>';
}
add_shortcode('lf_location','sc_localfood_location');
function sc_localfood_location2($atts, $content=null){
	$args=shortcode_atts(array('name' => '', 'type' => '' , 'open' => '0'),$atts);
	$name=$args['name'];
	$type=$args['type'];
	$open=$args['open'];
	$output=localfood_outline($name,$type,$open);
	echo $output;
	echo do_shortcode($content).'</div>';
}
add_shortcode('lf_location2','sc_localfood_location2');
function sc_localfood_store($atts){
	$args=shortcode_atts(array('names' => '', 'links' => ''),$atts);
	$names=explode(",",$args['names']);
	$links=explode(",",$args['links']);
	$ticker=count($names);
	$output='';
		for($i=0;$i<$ticker;$i++){
			$output.='<a class="accord-anchor" href="'."$links[$i]".'"target="_blank" rel="noopener noreferrer">'."$names[$i]".'</a>';
		}
	return $output;
}
add_shortcode('lf_store','sc_localfood_store');
function localfood_outline($a,$b,$c){
	$output='';
	$contentid=strtolower(str_replace(" ","",$a));
	$contentid.='-content';
	$output.="<$b>";
	$output.= '<button class="accord-trig" type="button" value="'. $c . '"aria-controls="'.$contentid.'">';		
	$output.='<span class="accord-icon">'. add_svg_plus() .'</span>';
	$output.='<span class="accord-title">' .$a. '</span></button>';
	$output.= "</$b>";
	$output.='<div id="'.$contentid.'"class="accord-content';
	if($c==='0'):
		$output.=' accord-hide';
	endif;
	$output.='">';
	return $output;
}
function add_svg_plus(){
	 $output='<svg id="svg-plus" viewBox="0 0 32 32"><line class="plus-line-1" x1="6" y1="16" x2="26" y2="16"/><line class="plus-line-2" x1="16" y1="6" x2="16" y2="26"/></svg>';
	return $output;
}