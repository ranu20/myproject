<script>
	function validate_form (){		
		if ( $.trim ( $('#BrandBrandName').val()) == '') {
			alert('Please enter brand name.');
			$('#BrandBrandName').focus();
			return false;
		}
		return true;
	}
</script>
<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="brands form">
	
	<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?> </div>
	<?php echo $this->Form->create('Brand', array('onSubmit'=>'return validate_form()')); ?>
		
	<div style="display:none;">
		<input type="hidden" name="_method" value="POST"/>
		<?php echo $this->Form->input('brand_id'); ?>
	</div>
	
	<div class='module_title'>
		<fieldset>
			<legend>Edit Brand</legend>				
			<div class="float" style='width:75%; height:75px'>
				<?php echo $this->Form->input('brand_name', array('label'=>false)); ?>				
			</div>
			<div style='clear:both'> </div>				
			<div class="submit float">
				<input type="submit" value="Submit" id='btn_submit' name='btn_submit'/>
			</div>				
		</fieldset>
	</div>
		
	<?php echo $this->Form->end(); ?>
</div>



