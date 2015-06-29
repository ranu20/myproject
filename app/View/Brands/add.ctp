<script>
	$(document).ready ( function (){
		
	});
	
	function validateForm ()
	{
		if ( $.trim ( $('#BrandBrandName').val()) == '') {
			alert('Please enter a value for brand name.');
			$('#BrandBrandName').focus();
			return false;
		}
		return true;
	}
	
	function imageDescription( input ){
		if( $.browser.msie || $.browser.safari || $.browser.chrome){
			// removing text c:\fakepath\
			$("#image_description").html( document.getElementById('product_image').value.substring(12) );
		}
		else{
			$("#image_description").html( document.getElementById('product_image').value);
		}
	}
		
</script>

<style>
	.hidden_browse{ font-size: 50px; height:120px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; left: -120px }
</style>



<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="brands form">
<div style='color:red; height:20px' align='center'> <?php echo $this->Session->flash(); ?> </div>
	<?php echo $this->Form->create('Brand', array('type'=>'file','onSubmit'=>'return validateForm()')); ?>		
		
		<div style="display:none;">
			<input type="hidden" name="_method" value="POST"/>
		</div>
		
		<div class='module_title'>
			<fieldset>
				<legend>Add Brand</legend>
				
				<div class="float" style='width:65%; height:75px'>
					<input name="data[Brand][brand_name]" maxlength="200" type="text" id="BrandBrandName"/>
				</div>

				<div style='float:left; width:260px'>
					<div class="float brand_img_preview_container">					
						<div id='no_image' style='margin:1px 1px 2px 1px'>	
							<?php echo $this->Html->image("product_image.png", array('width'=>113, 'height'=>114))?> 	
						</div>						
					</div>
					
					<input type="file" id="product_image" name="data[Brand][brand_image]" class="hidden_browse" onchange='imageDescription(this)' />
					<div id='image_description' style=' float:left; width:15px; font-size:10px; color:#000; margin:2px 0px 0px 10px;'> &nbsp; </div>
				</div>			
				
				<div style='clear:both'> </div>
				
				<div class="submit float">
					<input  type="submit" value="Submit" id='btn_submit' name='btn_submit'/>
				</div>
				
			</fieldset>
		</div>
	</form>
</div>




