
<script>
	
	$(document).ready(function(){
		$('#brand_img_preview_box').hide();
		$('#special_dropdown_target').show();
		
		$( ".spc_dd, #disabled_text_" ).hover(
			function() {
				$( '#disabled_text' ).parent().css({'border':'1px solid #C7E2F1', 'border-top':'1px solid #7BABCD'});	
			}, function() {				
				$( '#disabled_text').parent().css({'border':'none' });
			}
		);		
		
	});		
	
	function validate_form ()
	{	
		if ( $.trim ( $('#ProductProductName').val()) == '') {
			alert('Please enter product name.');
			$('#ProductProductName').focus();
			return false;
		}

		if ( $.trim ( $('#BrandBrandId').val()) == '') {
			alert('Please select a brand.');
			$('#BrandBrandId').focus();
			return false;
		}

		if( $('#special_dropdown_target').find('input[type=checkbox]:checked').length == 0 )
		{
			alert('Please select atleast one attribute');
			return false;
		}		
		return true;		
	}
	
	
	function imagePreview(input)
	{
		var fileName = document.getElementById('product_image');		
		fileName = fileName.value;			
		ext = fileName.substring( fileName.lastIndexOf('.') + 1).toLowerCase();			
		var allowed=['gif','jpeg','jpg','png'];		
		
		if( allowed.lastIndexOf( ext ) == '-1' ){
			alert("Please upload only images.");
			fileName.value='';
			return false;
		}
		
		if (input.files && input.files[0]) {
			
			if( $.browser.msie || $.browser.safari){
				
				fileName = fileName.substring(12);
				$("#no_image").css({'height':'115px','width':'115px','font-size':'12px'});
				$("#no_image").html( fileName );
				$("#new_image").hide();
			}
			else{
				$('#no_image').hide();
				$('#brand_img_preview_box').show();		
				
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#brand_img_preview').attr('src', e.target.result);
					$('#brand_img_preview').css({display: 'block',height:'115px',width:'115px'});
				}
				reader.readAsDataURL( input.files[0] );
			}
		}

	}
	
</script>

<style>
	#BrandBrandId option{border-right:1px solid #000000;}
</style>

<div class="dashboard actions" style='min-height:670px'>	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="products form" style='height:670px'>
	
	<div style='color:red; height:20px'> <?php echo $this->Session->flash();?> &nbsp;</div>
	
	<?php echo $this->Form->create('Product', array('type'=>'file', 'onSubmit'=>'return validate_form()')); ?>

		<div class='module_title'>
			<fieldset>
				<legend> <?php echo __('Add New Product'); ?>	 </legend>
				
				<div class="float" style='width:67%'>
					<div class='form_field_title' style='margin-left:0px; height:40px'>
						<?php echo __('Product Name'); ?>	
					</div>
					<?php	echo $this->Form->input('product_name',  array('label'=>false, 'height'=>'50px')); ?>
				</div>				
				
				<div style='float:left;'>
					<div class="float brand_img_preview_container">					
						<div id='no_image' style='margin:1px 1px 2px 1px'>	<?php echo $this->Html->image("product_image.png", array('width'=>113, 'height'=>114))?> 	</div>
						<div id='brand_img_preview_box'>					<img src='#' id='brand_img_preview' alt=''> 		</div>
					</div>
					<input type="file" id="product_image" name="data[Product][product_image]" style="font-size: 50px; height:120px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; left: -120px" onchange='imagePreview(this)' />
				</div>

				<div style='clear:both'> </div>
				
				<div class="float" style='width:100%; height:50px'>
					<div style='float:left; width: 66%;line-height:70px' >
						<div class='form_field_title' style='margin-left: 0px; float:left; width: 100px;line-height:15px'> 	<?php echo __('Chicken'); ?>	</div>

						<div style='float:left; width:20px; line-height:18px; height:20px'> <input type='checkbox' name='data[Product][chicken]'  id='DataProductChicken'>  </div>						
					</div>					
				</div>
				
				<div class="float" style='width:100%; height:100px'>
					<div style='float:left; width: 67%; vertical-align:middle;' >
						<div class='form_field_title' style='margin-left: 0px; height:30px'> <?php echo __('Select Brand'); ?>  </div>						
						<select name="data[Brand][brand_id]" id='BrandBrandId' style='width: 100%; height:40px; line-height:40px; font-size:16px; font-family:verdana'>
							<option value=''> <span class="spc_dd" style="color:black; font-size:15px; font-weight:lighter">  -- Please select -- </span> </option>
							<?php foreach ( $brands as $key=>$brand ) {  $brand_name = substr ( $brand['Brand']['brand_name'], 0, 55 ); if (strlen( $brand_name  ) >= 55 ) $brand_name .='...' ?>
								<option value='<?php echo $brand['Brand']['brand_id']?>'> <?php echo $brand_name; ?> </option>
							<?php } ?>						
						</select>
					</div>		
					
				</div>
					
				<div style='clear:both'> </div>
				
				<div class='form_field_title' style='line-height:30px; height:40px'>	<?php echo __('Select Attributes'); ?>	</div>	

				<div class="float" style='width:67%' id='special_dropdown_container'>					
					<div style='float:left; width: 95%;' class='spc_dd'>			<input type='text' disabled  class='spc_dd' id='disabled_text'>			</div>
					<div style='float:left' id='special_dropdown' class='spc_dd'>	
						<!-- <img src='/petgurustage/img/drop_down.png' class='spc_dd'> -->
						<?php echo $this->Html->image("drop_down.png", array('class'=>'spc_dd'))?>								
					</div>
					<div style='clear:both'> </div>
					
					<div id='special_dropdown_target' style='height:170px; border:1px solid #ccc; overflow-y:scroll; width:99%;position:relative; top:-4px' class='spc_dd'>
						<?php foreach ( $attributes as $key=>$attribute ) {?>						
							<div class='spc_dd'> 
								<div style='float:left; width:20px; height:10px' class='spc_dd'>
									<input type='checkbox' name='DataProductAttributeId[]' value='<?php echo $attribute['Attribute']['attribute_id']?>' id='DataProductAttributeId' class='spc_dd'> 
								</div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:30px; ' class='spc_dd'> 
									<span style='color:black; font-size:15px; font-weight:lighter' class='spc_dd'> <?php echo $attribute['Attribute']['attribute_name']?> </span>
								</div>
								<div style='clear:both'> </div>
							</div>							
						<?php } ?>
					</div>					
				</div>

				<div style='clear:both'> </div>

				<div class="submit float" style='height:100px; line-height:100px'>	<input  type="submit" value="Submit" id='btn_submit'/>		</div>
			</fieldset>	
		</div>
	</form>
</div>