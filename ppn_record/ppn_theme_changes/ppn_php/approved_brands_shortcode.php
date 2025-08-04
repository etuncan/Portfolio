<?php
function sc_brandlist($atts){
	$args=shortcode_atts(
		array( 'name' => '', 'imageid' => '', 'link' => '') 
	, $atts);
	$name=explode("|" ,$args['name']);
	$imageid=explode("," ,$args['imageid']);
	$link=explode("," ,$args['link']);
	$imgpath=[];
	$counting=count($name);
	
	foreach($imageid as $value){
		$imgpath[]=wp_get_attachment_image_url($value,'full');
	}//get image url using id
	$fletter=sc_firstletter($name[0]);
?>
	<section id="ppn_food-approved">
		<div class="brand-group">
			<h3><?php esc_html_e($fletter);?></h3><?php
			//create opening tags and first group
			for($i=0;$i<$counting;$i++){
			?><div class="brand-flex-item">
				<a id="<?php esc_attr_e(get_the_title($imageid[$i])); ?>" class="brand-link" href="<?php esc_attr_e($link[$i]); ?>">	<h4><?php esc_html_e($name[$i]);?></h4>
				</a>
			</div><?php
			
			$testlet1=sc_firstletter($name[$i]);
			$testlet2=sc_firstletter($name[$i+1]);
			if($testlet1 !== $testlet2):
				if($i!==$counting - 1):
					?></div>
						<div class="brand-group"><h3><?php esc_html_e($testlet2);?></h3>
				<?php //start next group if needed
				else:?></div><?php
				endif;
			endif;
		}
	?></section><?php
}
function sc_firstletter($ns){
	return substr($ns,0,1);
}//finds the first letter to create new group
add_shortcode('brandlist', 'sc_brandlist');
?>
