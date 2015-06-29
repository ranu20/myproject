 <script>
	
		
		function validate_form ()
		{			

			if ( $.trim ( $('#AttributeAttributeName').val()) == '') {
				alert('Please enter a value for attribute Name.');
				$('#AttributeAttributeName').focus();
				return false;
			}

			if ( $.trim ( $('#AttributeWeightage').val()) == '') {
				alert('Please enter a value for Weightage.');
				$('#AttributeAttributeName').focus();
				return false;
			}

			var weightage = $.trim ( $('#AttributeWeightage').val() );

			if ( !$.isNumeric( weightage ) ){
				alert('Only numeric values are allowed');
				return false;
			}
			return true;
			
		}		
	
 </script>

<div class="attributes form">
	<?php echo $this->Form->create('Attribute', array('onSubmit'=>'return validate_form()')); ?>	
	
	<div style="display:none;">
		<input type="hidden" value="PUT" name="_method">
	</div>
	
	<div class='module_title'>
		<fieldset>
			<legend> <?php echo $action ?> Attribute</legend>
			<div style='float:left; width: 100%; vertical-align:middle;' >
				<div class='form_field_title' style='padding-top: 15px'>
					<?php echo __('Attribute Name'); ?>
				</div>
				<div class="float" style='width:100%; height:100px'>
					<?php echo $this->Form->input('attribute_name', array('label'=>false)); ?>
				</div>
			</div>

			<div style='float:left; width: 100%; vertical-align:middle;' >
				<div class='form_field_title' style='padding-top: 15px'>
					<?php echo __('Weightage'); ?>
				</div>
				<div class="float" style='width:100%; height:100px'>
					<?php echo $this->Form->input('weightage', array('label'=>false)); ?>
				</div>
			</div>			
		</fieldset>
		
		<div class="submit float">
			<?php echo $this->Form->end(__('Submit'), array('onclick'=>'return validate_form()')); ?>
		</div>
	</div>
</div>