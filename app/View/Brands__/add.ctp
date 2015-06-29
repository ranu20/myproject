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

				<div style='float:left;'>
					<div class="float brand_img_preview_container">					
						<div id='no_image' style='margin:1px 1px 2px 1px'>	
							<?php echo $this->Html->image("product_image.png", array('width'=>113, 'height'=>114))?> 	
						</div>
						<div id='brand_img_preview_box'> <img src='#' id='brand_img_preview' alt=''> 		</div>
					</div>
					<input type="file" id="product_image" name="data[Brand][brand_image]" style="font-size: 50px; height:120px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; left: -120px" onchange='imagePreview(this)' />
				</div>
				
				<div style='clear:both'> </div>

				
				
				<div class="submit float">
					<input  type="submit" value="Submit" id='btn_submit' name='btn_submit'/>
				</div>
				
			</fieldset>
		</div>
	</form>
</div>




