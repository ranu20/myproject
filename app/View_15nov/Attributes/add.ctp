 <script>
	$(document).ready(function(){
		
		$('#btn_submit').click(function(){
			
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

		});
	});
 </script>
 
 <div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="attributes form">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?>&nbsp; </div>
	<!-- <form action="/petgurudev/attributes/add" id="AttributesAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8"> -->
	<?php echo $this->Form->create('Attribute'); ?>	
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		<div class='module_title'>
			<fieldset>
				<legend>Add New Attribute</legend>
				<div style='color:red'> <?php echo $this->Session->flash(); ?> </div>
				
				<div style='height:125px'>
					<div class='form_field_title' style='height:45px; line-height:40px'>
						<?php echo __('Attribute Name'); ?>
					</div>
					<div class="float" style='width:75%;'>
						<input name="data[Attribute][attribute_name]" maxlength="200" type="text" id="AttributeAttributeName" class='attributes_input'/>
					</div>
					<div style='clear:both'> </div>
				</div>

				<div style='height:125px'>
					<div class='form_field_title' style='height:45px; line-height:40px'>
						<?php echo __('Weight'); ?></h2>	
					</div>
				
					<div class="float" style='width:75%;'>
						<input name="data[Attribute][weight]" maxlength="200" type="text" id="AttributeWeight"/>
					</div>
					<div style='clear:both'> </div>
				</div>

				<div class="submit float">
					<input  type="submit" value="Submit" id='btn_submit' name='btn_submit' />
				</div>

			</fieldset>
		</div>

		
	</form>
</div>