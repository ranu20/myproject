<script>
	function validate_form ()
	{
		if ( $.trim ( $('#CategoryCategoryName').val() ) == '' ) {
			alert('Please enter category name.');
			$('#CategoryCategoryNamee').focus();
			return false;
		}		
		return true;
	}
</script>

<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="category form">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash();?> &nbsp;</div>

	<?php echo $this->Form->create('Category',  array('onSubmit'=>'return validate_form()') ); ?>
	<?php echo $this->Form->input('category_id'); ?>
		<div class='module_title'>
			<fieldset>
				<legend><?php echo __('Edit Category'); ?></legend>
				<div style='float:left; width: 75%; vertical-align:middle;' >				
					<div class="float" style='width:100%; height:75px'>
						<?php echo $this->Form->input('category_name', array('label'=>false)); ?>
					</div>
				</div>
				
				<div style='clear:both'> </div>
				
				<div class="submit float">
					<?php echo $this->Form->end(__('Submit')); ?>
				</div>
			</fieldset>
	</div>
</div>

