 <script>	
		
		function validate_form ()
		{
			if ( $.trim ( $('#AttributeAttributeName').val()) == '') {
				alert('Please enter attribute name.');
				$('#AttributeAttributeName').focus();
				return false;
			}

			if ( $.trim ( $('#AttributeWeight').val()) == '') {
				alert('Please enter weight.');
				$('#AttributeWeight').focus();
				return false;
			}

			var weight = $.trim ( $('#AttributeWeight').val() );

			if ( !$.isNumeric( weight ) ){
				alert('Please enter weight in numeric digits like 10.');
				$('#AttributeWeight').focus();				
				return false;
			}
			return true;
		}
	
 </script>
 
 <div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="attributes form">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?>&nbsp; </div>
	<?php echo $this->Form->create('Attribute', array('onSubmit'=>'return validate_form()')); ?>	
	
	<div style="display:none;">
		<input type="hidden" value="PUT" name="_method">
	</div>
	
	<div class='module_title'>

		<fieldset>
			<legend>Edit Attribute</legend>

			<div style='height:125px'>
				<div class='form_field_title' style='height:45px; line-height:40px'>
					<?php echo __('Attribute Name'); ?></h2>	
				</div>
				<div class="float" style='width:75%;'>
					<?php echo $this->Form->input('attribute_name', array('label'=>false)); ?>
				</div>
				<div style='clear:both'> </div>
			</div>
			
			<div style='height:125px'>
				<div class='form_field_title' style='height:45px; line-height:40px'>
					<?php echo __('Weight'); ?></h2>	
				</div>
			
				<div class="float" style='width:75%;'>
					<?php echo $this->Form->input('weight', array('label'=>false)); ?>
				</div>
				<div style='clear:both'> </div>
			</div>			
			
			<div class="submit float">
				<?php echo $this->Form->end(__('Submit'), array('onclick'=>'return validate_form()')); ?>
			</div>

		</fieldset>
	</div>
</div>