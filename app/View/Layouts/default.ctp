<?php
	$cakeDescription = __d('cake_dev', 'Pet Guru');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php	
		//echo $this->Html->meta('icon');		
		echo $this->Html->css('petguru_style_new');				
		echo $this->fetch('script');
		echo $this->Html->script('jquery');
		echo $this->fetch('meta');
		echo $this->fetch('css');		
		echo $this->Html->css('browse/jquery.fileupload-ui');
	?>
	<style>		
		
		
	</style>
	<script>
		$(document).ready( function(){
			jQuery('img').each(function(){
				jQuery(this).attr('src',jQuery(this).attr('src')+ '?' + (new Date()).getTime());
			});   
		});
	</script>
</head>
<body>	
	
	<div id='container'>		
		<div id="logo"> <div class="headertext"> <?php echo $this->Html->image('logo.png')?>  </div></div>
		
		<div style='width:100%' id='color_strip'>
			<div style='background-color:#1BB097; float:left;line-height:4px; min-height: 4px; width: 33%'>	</div>
			<div style='background-color:#484F5F; float:left;line-height:4px; min-height: 4px; width: 34%'>	</div>
			<div style='background-color:#C017A4; float:left;line-height:4px; min-height: 4px; width: 33%'> </div>			
		</div>		
		<div id="main">
			<div id="content">
				<?php echo $this->fetch('content'); ?>
			</div>
			
		</div>
		
	</div>
	
	<div>		<?php echo $this->element('sql_dump'); ?>	</div>
</body>

</html>

