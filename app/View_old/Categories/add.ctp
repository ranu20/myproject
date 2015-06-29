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

<div class="brands form">
<div style='color:red; height:20px'> <?php echo $this->Session->flash();?> &nbsp;</div>
	<?php echo $this->Form->create('Category',  array('onSubmit'=>'return validate_form()') ); ?>
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		<div class='module_title'>
			<fieldset>
				<legend>Add New Category</legend>
				<div class="float" style='width:75%; height:75px; line-height:42px'>
					<input name="data[Category][category_name]" maxlength="200" type="text" id="CategoryCategoryName"/>
				</div>		

				<div style='clear:both'> </div>

				<div class="submit float">
					<input  type="submit" value="Submit" id ='btn_submit'/>
				</div>	
				
			</fieldset>
		</div>
	</form>
</div>




