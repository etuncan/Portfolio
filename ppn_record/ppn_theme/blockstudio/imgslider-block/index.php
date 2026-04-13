<div class="gs-container">
	<div class="gs-scene">
		<div class="gs-box">
		<?php 
			$image_counter=-1;
			foreach ($a['image'] as $file){
				$image_counter++;
		?>
				<div id="<?php echo $a['name'].'-slide-'.$image_counter; ?>" class="gs-face image-overlay" style="background-image:url('<?php echo wp_get_attachment_image_url($file['ID'],'med');?>');width:100%;">
          <img src="<?php echo wp_get_attachment_image_url($file['ID'],'med');?>">
				</div>
		<?php	
			}
		?>
		</div>
	</div>
	<ol class="gs-control">
		<?php
			for($i=0;$i<=$image_counter;$i++){
		?>		<li>
		<?php	if($i===0){
		?>			<a class="active" aria-controls="<?php echo $a['name'].'-slide-'.$i; ?>"><?php echo ($i+1); ?></a> 
		<?php	}
				else{
		?>			<a aria-controls="<?php echo $a['name'].'-slide-'.$i; ?>"><?php echo ($i+1); ?></a>	
		<?php	}
		?>		</li>
		<?php
			}
		?>
	</ol>
</div>
<?php
wp_enqueue_style('block-style', get_template_directory_uri() . '/style.css');
