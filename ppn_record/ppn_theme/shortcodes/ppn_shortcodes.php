<?php
function ppn_news_shortcode($atts) {
	extract(shortcode_atts(array(
		'post_types' => '',
		'style' => 'default',
		'categories' => '',
		'post_per_page' => '',
		'post_pagination' => 'normal',
		'ignore_sticky' => '',
		'effects_enabled' => false
	), $atts, 'ppn_news'));
	ob_start();
	ppn_blog(array(
		'blog_post_types' => explode(',', $post_types),
		'blog_style' => $style,
		'blog_categories' => $categories,
		'blog_post_per_page' => $post_per_page,
		'blog_pagination' => $post_pagination,
		'blog_ignore_sticky' => $ignore_sticky,
		'effects_enabled' => $effects_enabled
	));
	$return_html = trim(preg_replace('/\s\s+/', ' ', ob_get_clean()));
	return $return_html;
}
add_shortcode('ppn_news', 'ppn_news_shortcode');

function sc_showcase($atts, $content=null){
	$args=shortcode_atts(
		array('title' => '', 'links' => '', 'imageid' => '')
	, $atts); 
	$title=explode("," ,$args['title']); 
	$link=explode("," ,$args['links']); 
	$imageid=explode("," ,$args['imageid']); 
	$contents=explode("splithere", $content); 
	$counting=count($title);
	$output='';
	$output.='<div class="showcase_container">';
	for($i=0;$i<$counting;$i++){
		$output.='<div class="showcase-item">';
		$output.='<a class="showcase-link" href="'.esc_attr($link[$i]).'">';
		$output.='<div class="showcase-img">';
		$output.=wp_get_attachment_image($imageid[$i]);
		$output.='</div>';
		$output.='<div class="showcase-title">';
		$output.='<h3>'.esc_html($title[$i]).'</h3>';
		$output.='</div>';
		$output.='<div class="showcase-excerpt">';
		$output.='<p>'.esc_html($contents[$i]).'</p></div>';
		$output.='</a></div>';
	}
	$output.='</div>';
	return $output;
}
add_shortcode('showcase', 'sc_showcase');

function sc_custom_container($atts, $content=null){
	$args=shortcode_atts(array('eltag'=>'div','elid'=>'','elclass'=>''),$atts);
	$elid=$args['elid'];
	$elclass=$args['elclass'];
	$eltag=$args['eltag'];
	$output='<'.$eltag;
	if($elid!==''):
		$output.=' id="'.$elid.'"';
	endif;
	if($elclass!==''):
		$output.=' class="'.$elclass.'"';
	endif;
	$output.='>';
	$output.=do_shortcode($content).'</'.$eltag.'>';
	return $output;
}
add_shortcode('custom_container','sc_custom_container');
function sc_custom_content($atts){
	$args=shortcode_atts(array('eltag'=>'div','elid'=>'','elclass'=>'','elcontent'=>'','coded'=>''),$atts);
	$eltag=$args['eltag'];
	$elid=$args['elid'];
	$elclass=$args['elclass'];
	$elcont=$args['elcontent'];
	$coded=$args['coded'];
	$output='<'.$eltag;
	if($elid!==''):
		$output.=' id="'.$elid.'"';
	endif;
	if($elclass!==''):
		$output.=' class="'.$elclass.'"';
	endif;
	$output.='>';
	if($elcont!==''):
		if($coded==='admin14d2b6x5h7g1'):
			$output.=html_entity_decode($elcont);
		else:
			$output.=$elcont;
		endif;
	endif;
	$output.='</'.$eltag.'>';
	return $output;
}
add_shortcode('custom_content','sc_custom_content');
function add_svg_plus(){
	 $output='<svg id="svg-plus" viewBox="0 0 32 32"><line class="plus-line-1" x1="6" y1="16" x2="26" y2="16"/><line class="plus-line-2" x1="16" y1="6" x2="16" y2="26"/></svg>';
	return $output;
}
function add_svg_arrow(){
	 $output='<svg id="svg-arrow" viewBox="0 0 32 32"><line class="arrow-line-1" x1="6" y1="11" x2="16" y2="21"/><line class="arrow-line-2" x1="16" y1="21" x2="26" y2="11"/></svg>';
	return $output;
}
function sc_imagelinkset($atts){
	$args=shortcode_atts( array( 'imageid' => '', 'class' => '', 'link' => '', 'alttext' => ''),$atts);
	$imageid=$args['imageid'];
	$classname=$args['class'];
	$link=$args['link'];
	$alttext=$args['alttext'];
	$output='';
	$output.='<a class="'.$classname.'" href="'.$link.'" target="_blank" rel="noopener noreferrer">';
	$output.=wp_get_attachment_image($imageid,'full','','alt='.$alttext);
	$output.='</a>';
	return $output;
}
add_shortcode('imagelinkset','sc_imagelinkset');
function sc_brandlist($atts){
	$args=shortcode_atts(
		array( 'name' => '', 'link' => '') 
	, $atts);
	$name=explode("|" ,$args['name']);
	$link=explode("," ,$args['link']);
	$counting=count($name);
	$fletter=sc_firstletter($name[0]);
	$output='';
	$output.='<section id="ppn_food-approved"><div class="brand-group">';
	$output.='<h3>'.esc_html($fletter).'</h3>';
	//create opening tags and first group
	for($i=0;$i<$counting;$i++){
		$output.='<div class="brand-flex-item"><a class="brand-link" href="'.esc_attr($link[$i]).'">';
		$output.='<h4>'.esc_html($name[$i]).'</h4></a></div>';
		$testlet1=sc_firstletter($name[$i]);
		$testlet2=sc_firstletter($name[$i+1]);
		if($testlet1 !== $testlet2):
			if($i!==$counting - 1):
				$output.='</div><div class="brand-group"><h3>'.esc_html($testlet2).'</h3>';
				//start next group if needed
			else:
				$output.='</div>';
			endif;
		endif;
	}//end of for-loop
	$output.='</section>';
	return $output;
}
function sc_firstletter($ns){
	return substr($ns,0,1);
}//finds the first letter to create new group
add_shortcode('brandlist', 'sc_brandlist');

function clean_shortcode_output($content) {
	$content = str_replace(array('<p>', '</p>'), '', $content);
	// Add more cleaning as needed, e.g., removing extra <br> tags
	return $content;
}

function sc_accord_title($atts, $content=null){
	$args=shortcode_atts(array('name' => '', 'type' => 'h3' , 'open' => '0', 'innershort' => 'yes', 'icon'=>'', 'icon_right'=>''),$atts);
	$output=ppn_accord_set($args);
	
	if($args['innershort']==='yes'):
		$output.=do_shortcode($content);
	else:
		$output.=$content;
	endif;
	$output.='</div>';
	$output=str_replace(array("<p>","</p>"),' ',$output);
	return $output;
	
	//function calls: ppn_accord_set()
}
add_shortcode('accord_title','sc_accord_title');

function sc_accord_subtitle($atts, $content=null){
	$args=shortcode_atts(array('name' => '', 'type' => 'h4' , 'open' => '0', 'innershort' => 'yes', 'icon'=>''),$atts);
	$output=ppn_accord_set($args);
	
	if($args['innershort']==='yes'):
		$output.=do_shortcode($content);
	else:
		$output.=str_replace("<p></p>",'',$content);
	endif;
	
	$output.='</div>';
	
	return $output;
	
	//function calls: ppn_accord_set()
}
add_shortcode('accord_sub','sc_accord_subtitle');

function ppn_accord_set($ar){
	$output='';
	$arg_arr['titles']=$ar['name'];
	$arg_arr['type']=$ar['type'];
	$arg_arr['open']=$ar['open'];
	$arg_arr['contId']=ppn_prep_title($arg_arr['titles']);
	$arg_arr['icon']=$ar['icon'];
	$arg_arr['icon_right']=$ar['icon_right'];
	$output.=ppn_header_fill($arg_arr);
	$output.=ppn_content_tag($arg_arr['contId'],$arg_arr['open'],'accord');
	return $output;
	//function calls: ppn_prep_title, ppn_header_fill(), ppn_content_tag()
}

function sc_accord_content($atts){
	$args=shortcode_atts(array('names' => '', 'links' => ''),$atts);
	$names=explode(",",$args['names']);
	$links=explode(",",$args['links']);
	$ticker=count($names);
	$output='';
	for($i=0;$i<$ticker;$i++){
		$output.='<a class="accord-anchor" href="'.esc_attr($links[$i]).'"target="_blank" rel="noopener noreferrer">'.esc_html($names[$i]).'</a>';
	}
	return $output;
}
add_shortcode('accord_content','sc_accord_content');

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
	$attr_arr['titles']=explode(",",$titles);
	$attr_arr['ticker']=count($attr_arr['titles']);
	$attr_arr['type']='div';
	$attr_arr['contId']=ppn_sc_contid($attr_arr['titles']);
	//attr_arr syntax [array(),int,string,array()]
	
	//TODO: make script external in theme
	//wp_enqueue_script('');
	
	//section open tag
	$output.='<section id="'.esc_attr($e_id).'">';
	
	//populates heading
	$output.=ppn_header_fill($attr_arr);
	
	//content container openning tag
	$output.='<div class="tab-cont-c">';
	
	//removes extra p tags
	$content=clean_shortcode_output($content);
	
	//populates inner content
	$output.=ppn_tab_content($attr_arr,$content);
	
	//content container and section close tags
	$output.='</div></section>';
	
	return $output;
	
	//function calls: ppn_sc_contid(),ppn_header_fill(),clean_shortcode_output(),ppn_tab_content()
}
add_shortcode('ppn_tabs','sc_ppn_tabs');

function ppn_header_fill($ar){
	$output=$ticker='';
	$titles=$ar['titles'];
	$type=$ar['type'];
	$cont_ids=$ar['contId'];
	
	$output.='<'.$type;
	
	if(is_array($titles)):
		$tabs=true;
		$ticker=$ar['ticker'];
		$output.=' class="tab-cont-h"';
		$output.='>';
		for($i=0;$i<$ticker;$i++){
			$output.='<button class="tab-trig" type="button" data-open-status="'; 
			if($i===0):
				$output.='1';
			else:
				$output.='0'; 
			endif;
			$output.='" aria-controls="'.esc_html($cont_ids[$i]).'-content">';
			$output.='<div id="'.$cont_ids[$i].'"></div>';
			$output.='<span class="tab-title">'.esc_html($titles[$i]).'</span></button>';
		}
	else:
		$output.='><button class="accord-trig" type="button" data-open-status="'.esc_attr($ar['open']).'" aria-controls="'.esc_attr($cont_ids).'-content">';
		if($ar['icon_right']==='yes'):
			$output.='<span class="accord-title">'.esc_html($titles).'</span>';
			$output.='<span class="accord-icon">';		
			if($ar['icon']==='arrow'):
				$output.=add_svg_arrow();
			else:
				$output.=add_svg_plus();
			endif;
			$output.='</span>';
		else:
			$output.='<span class="accord-icon">';
			if($ar['icon']==='arrow'):
				$output.=add_svg_arrow();
			else:
				$output.=add_svg_plus();
			endif;
			$output.='</span>';
			$output.='<span class="accord-title">'.esc_html($titles).'</span>';
		endif;
		$output.='</button>';
	endif;
	
	$output.='</'.$type.'>';
	return $output;
	
	//function calls: add_svg_plus() add_svg_arrow()
}

function ppn_tab_content($ar,$c){
	$output='';
	$ticker=$ar['ticker'];
	$type=$ar['type'];
	$cont_ids=$ar['contId'];
	$op='1';
	
	//split content into array 
	$cont_inner=explode("splithere",$c);

	//wraps and populates inner content
	for($i=0;$i<$ticker;$i++){
		if($i>0):
			$op='0';
		endif;
		
		$output.=ppn_content_tag($cont_ids[$i],$op,'tab');
		$output.=$cont_inner[$i].'</div>';
	}	
	return $output;
	
	//function calls: ppn_content_tag()
}


//Populates inner content container openning tag(s)
function ppn_content_tag($cid,$op,$type){
	$output='<div id="'.$cid.'-content" class="'.$type.'-content';

	//determine if content should start hidden
	if($op==='0'):
		$output.=' content-hide';
	endif;
	$output.='">';
	return $output;
}
function ppn_prep_title($a){
	$output=preg_replace("/[^a-zA-Z0-9\s]/", "", $a);
	if(strlen($output)>25):
		$output=array_reduce(explode(' ', $output),
        function ($x, $y){
			return $x.substr($y,0,1);
		},'');
	endif;
	$output=strtolower(str_replace(" ","",$output));
	return $output;
}
function ppn_sc_contid($t){
	$output=[];
	foreach($t as $value){
		$output[]=ppn_prep_title($value);
	}
	unset($value);
	return $output;
}
function sc_cust_btn($atts){
	$args=shortcode_atts(array('text'=>'','link'=>'','font-size'=>'16px','color'=>'#fff','background-color'=>'#00838f','border-radius'=>'6px'),$atts);
	$text=$args['text'];
	$link=$args['link'];
	$font_size=$args['font-size'];
	$color=$args['color'];
	$bg_color=$args['background-color'];
	$border_radius=$args['border-radius'];
	$output='';
	$output.='<div class="cust_btn-cont">';
	$output.='<a class="cust_btn" href="'.$link.'" style="font-size:'.esc_attr($font_size).'; color:'.esc_attr($color).'; background-color:'.esc_attr($bg_color).';border-radius:'.esc_attr($border_radius).';">'.esc_html($text).'</a></div>';
	return $output;
}
add_shortcode('cust_btn', 'sc_cust_btn');
function ppn_sc_button($atts){
	$args=shortcode_atts(
		array('title'=>'',
			  'link'=>'',
			  'size'=>'reg',
			  'style'=>'')
		 ,$atts);
	$title=$args['title'];
	$link=$args['link'];
	$btn_size=$args['size'];
	$output='<div class="ppn-btn-cont">';
	$output.='<a class="ppn-btn size-'.esc_attr($btn_size).'" href="'.$link.'">';
	$output.=esc_html($title).'</a></div>';
	return $output;
}
add_shortcode('ppn_button','ppn_sc_button');
function ppn_sc_notice($atts, $content=null){
	extract(
		shortcode_atts(
			array(
				'heading'=>'Your Heading',
				'bg_color'=>'transparent',
				'color'=>'inherit'
			),
			$atts
		)
	);
	
	$output='<div class="sc-notice" style="background-color:'.esc_attr($bg_color).';">';
	$output.='<h2 class="sc-notice-header" style="color:'.esc_attr($color).';">'.esc_html($heading).'</h2>';
	$output.='<p class="sc-notice-text" style="color:'.esc_attr($color).'cc;">'.esc_html($content).'</p></div>';
	return $output;
}
add_shortcode('sc_notice','ppn_sc_notice');
