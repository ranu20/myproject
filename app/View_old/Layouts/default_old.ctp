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
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery');
	?>
	<style>		
	
	
		
	</style>
</head>
<body>	
	<div>
		<div id="logo">
			<div class="headertext"> <?php echo $this->Html->image('logo.png')?>  </div>
		</div>
		
		<div style='width:100%'>
			<div class='header_botom_green'>	</div>
			<div class='header_botom_red'>		</div>
			<div class='header_botom_black'>	</div>			
		</div>
		
		<div id='left_panel'> &nbsp;	</div>
		
		<div class="dashboard actions">	
			<?php echo $this->element('left_navigation')?>
		</div>
		
		<div id='centeral_panel' style='float:left; width:77%'>
			<div id="main">				
				
				<div id="content">					
					<div>
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>			
			</div>
		</div>
		
		<div id='right_panel'> &nbsp;</div>
		
	</div>
	
	<!--<div>		<?php echo $this->element('sql_dump'); ?>	</div>-->
</body>

</html>
