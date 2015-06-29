 <script>
	$(document).ready(function(){
		
		$('#btn_submit').click(function(){
			
			if ( $.trim ( $('#AttributeAttributeName').val()) == '') {
				alert('Please enter a value for attribute Name.');
				$('#AttributeAttributeName').focus();
				return false;
			}

			if ( $.trim ( $('#AttributeWeightage ').val() ) == '') {
				alert('Please enter a value for Weightage.');
				$('#AttributeWeightage').focus();
				return false;
			}

			var weightage = $.trim ( $('#AttributeWeightage').val() );

			if ( !$.isNumeric( weightage ) ){
				alert('Only numeric values are allowed');
				return false;
			}

		});
	});
 </script>

<div class="attributes form">
<form action="/petgurustage/questions/addattribute" id="AttributesAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		<div class='module_title'>
			<fieldset>
				<legend>Add Attribute</legend>

				<div class='form_field_title' style='padding-top: 15px'>
					<?php echo __('Attribute Name'); ?></h2>	
				</div>
				<div class="float" style='width:100%; height:100px'>
					<input name="data[Attribute][attribute_name]" maxlength="200" type="text" id="AttributeAttributeName"/>
				</div>
				<div style='clear:both'> </div>
				<div class='form_field_title' style='padding-top: 15px'>
					<?php echo __('Weightage'); ?></h2>	
				</div>
				
				<div class="float" style='width:100%; height:100px'>
					<input name="data[Attribute][weightage]" maxlength="200" type="text" id="AttributeWeightage"/>
				</div>
			</fieldset>
		</div>
		<div class="submit float">
			<input  type="submit" value="Submit" id='btn_submit'/>
		</div>
	</form>
</div>