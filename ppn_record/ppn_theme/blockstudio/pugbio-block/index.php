<?php 
	$shared_name_value=""; if(get_the_title()){$shared_name_value=get_the_title();}else{$shared_name_value="&#91;Pug Name&#93;";}remove_filter('the_content', 'wpautop');
?>
<section><RichText attribute="content" tag="div" multiline="p" placeholder="Enter Content Here..." /><p>Are you interested in adopting <?php echo $shared_name_value; ?>? Review our adoption procedures and learn the next steps <a href="https://www.pugpartners.com/adoption-procedures">here</a>.</p><p><strong><?php echo $shared_name_value; ?>’s minimum adoption donation is $<?php echo $a['donation'];?></strong>.</p></section>
