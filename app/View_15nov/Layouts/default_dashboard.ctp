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
		echo $this->Html->script('jquery');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
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
			<div style='background-color:#1BB097; float:left;width: 25%; line-height:4px; min-height: 4px; width: 33%'>	</div>
			<div style='background-color:#484F5F; float:left;width: 25%; line-height:4px; min-height: 4px; width: 34%'>	</div>
			<div style='background-color:#C017A4; float:left;width: 25%; line-height:4px; min-height: 4px; width: 33%'> </div>			
		</div>
		
		<div id='left_panel'> &nbsp;	</div>
		
		<div id='centeral_panel' style='float:left'>		
			<div id="main">			
				
				<!--<div id="header">
					<div id="headadmin"></div>
				</div>-->
				
				<div id="content">				
					<!--<div id="topHead"></div>
					<div id="backtodesh"><span></span></div>-->
					<div>
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>			
			</div>
		</div>
		
		
		<div id='right_panel'> &nbsp;</div>
	</div>
	
	<!-- <div>		<?php //echo $this->element('sql_dump'); ?>	</div> -->
</body>

</html>
