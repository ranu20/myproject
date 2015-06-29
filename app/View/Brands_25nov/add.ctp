<script>
	$(document).ready ( function (){
		$('#btn_submit').click(function(){			
			if ( $.trim ( $('#BrandBrandName').val()) == '') {
				alert('Please enter brand name.');
				$('#BrandBrandName').focus();
				return false;
			}	
		});
		
		$( "#flashMessage" ).fadeOut(5000);
		
	});
	
	function validate_form (){		
		if ( $.trim ( $('#BrandBrandName').val()) == '') {
			alert('Please enter a value for brand name.');
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
	<?php echo $this->Form->create('Brand', array('type'=>'file','onSubmit'=>'return validate_form()')); ?>		
		
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		
		<div class='module_title'>
			<fieldset>
				<legend>Add Brand</legend>
				
				<div class="float" style='width:65%; height:75px'>
					<input name="data[Brand][brand_name]" maxlength="200" type="text" id="BrandBrandName"/>
				</div>
				
				<div style='clear:both'> </div>

				
				
				<div class="submit float">
					<input  type="submit" value="Submit" id='btn_submit' name='btn_submit'/>
				</div>
				
			</fieldset>
		</div>
	</form>
</div>




