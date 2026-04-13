<?php
function sc_accordion($atts, $content=null){
	extract(shortcode_atts(array('type1' => 'h3','type2' => 'h4'),$atts,'sc_accord'));
	$list=$content;

	$pattern=['/'. preg_quote('<ul title="','/') . '(.*?)' . preg_quote('"','/') . '/',
	'/'.preg_quote('<li title="','/').'(.*?)'.preg_quote('"','/').'/',
	'/'.'('.preg_quote('<','/').'.*?)'.preg_quote('</li>','/').'/',
	'/'.preg_quote('</','/').'.*?'.preg_quote('>','/').'/',
	'/'.preg_quote('<','/').'.*?'.preg_quote('>','/').'/',
	'/'.preg_quote('<a','/').'.*?'.preg_quote('</li>','/').'/'];
	$list=preg_replace('/'.'\s+'.preg_quote('<','/').'/',"<",$list,-1,$count);
	$i=0;
	$output=accord_matcher($list,$pattern,$i);
	for($i=0;$i<70;$i++){
		$output.=accord_matcher($list,$pattern,$i);
	}
	$output=preg_replace('/'.preg_quote('"','/').'(closed)'.preg_quote('"','/').'/',"open",$output,2);
	$output=preg_replace('/'.'content-hide'.'/',"",$output,2);
	return $output;
}
add_shortcode('sc_accord','sc_accordion');	
function make_accord_button($a,$b){
	$s='<h'.$a.'>';
	$s.='<button class="accord-trig" type="button" data-open-status="closed" aria-controls="'.$b.'-content">';
	$s.='<span class="accord-icon">'.add_svg_plus().'</span>';
	$s.='<span class="accord-title">'.$b.'</span></button></h'.$a.'>';
	return $s;
}
function make_accord_content_container($b){
	return '<div id="'.$b.'-content" class="accord-content content-hide">';
}
function accord_matcher(&$list,$p,&$i){	
	if(isset($list[1])){
		if($list[1]==='/'){
			$list=preg_replace($p[3],"",$list,1);
			$n='</div>';
			return $n;
		}
		elseif($list[1]==='u'){
			preg_match($p[0],$list,$matches);
			$n=make_accord_button('3',$matches[1]);
			$n.=make_accord_content_container($matches[1]);
			$list=preg_replace($p[4],"",$list,1);
			return $n;
		}
		elseif($list[1]==='l'){
			preg_match($p[1],$list,$matches);
			$n=make_accord_button('4',$matches[1]);
			$n.=make_accord_content_container($matches[1]);
			$list=preg_replace($p[4],"",$list,1);
			return $n;		
		}	
		elseif($list[1]==='a'){
			preg_match($p[2],$list,$matches);
			$n=$matches[1];
			$n.='</div>';
			$list=preg_replace($p[5],"",$list,1);
			return $n;					
		}
		else{
			$i=70;
			return;
		}
	}
	else{
		$i=70;
		return;
	}
}
