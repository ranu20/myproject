<?php 
//debug ( $cats_prod);
?>

<style>
	#ProductBrandId {width:98% !important; height:40px !important; line-height:40px !important}
</style>

<script>
	
	function validate_form ()
	{	
		if ( $.trim ( $('#ProductProductName').val()) == '') {
			alert('Please enter product name.');
			$('#ProductProductName').focus();
			return false;
		}

		if ( $.trim ( $('#ProductBrandId').val()) == '') {
			alert('Please select a brand.');
			$('#ProductBrandId').focus();
			return false;
		}

		if($('#special_dropdown_target').find('input[type=checkbox]:checked').length == 0)
		{
			alert('Please select atleast one attribute.');
			return false;
		}
		
		return true;
	}

	$(document).ready(function(){
		$('#new_image').hide();
		$('#disabled_text').css({'z-index':'10000'});
		
		//$("#product_image").hide();		
		$('#disabled_text, #disabled_text_container, #special_dropdown').click(function(){
			$('#special_dropdown_target').show();			
		});
		
		$( ".spc_dd, #disabled_text" ).hover(
			function() {								
				$( '#disabled_text' ).parent().css({'border':'1px solid #C7E2F1', 'border-top':'1px solid #7BABCD'});					
				
			}, function() {				
				$( '#disabled_text').parent().css({'border':'none' });
			}
		);	
		
		$('.dashboard').css({'min-height':'900px'});		
	});


	
	function imagePreview(input) {
		
		/*
		var fileName = document.getElementById('product_image');
			
		fileName = fileName.value;
		
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		ext =ext.toLowerCase();		

		if(ext == "gif"  || ext == "jpeg" || ext == "jpg"  ||  ext == "png"){
			
		}
		else{
			alert("Please upload only images.");
			fileName.value='';				
			return false;
		}

		if (input.files && input.files[0]) {

			if( $.browser.msie || $.browser.safari){
				fileName = fileName.substring(12);
				$("#cur_image").css({'border':'2px solid #ccc','height':'115px','width':'11px','font-size':'12px'});
				$("#cur_image").html(fileName);
				$("#new_image").hide();
			}
			else{
				$("#new_image").show();

				var reader = new FileReader();
				reader.onload = function (e) {
					$('#product_img_preview').attr('src', e.target.result);
					$('#product_img_preview').css({display: 'block',height:'110px',width:'110px'});
					$('#cur_image').hide();
				}
				reader.readAsDataURL(input.files[0]);
				$("#new_image").css({'height':'115px','width':'115px','font-size':'12px'});
			}			
		}
		*/
		if( $.browser.msie || $.browser.safari || $.browser.chrome){
			// removing text c:\fakepath\
			$("#image_description").html( document.getElementById('product_image').value.substring(12) );
		}
		else{
			$("#image_description").html( document.getElementById('product_image').value);
		}
		//$('#cur_image > img').attr('src','/petgurustage/img/no_preview.png');
		var no_preview_image = "<?php echo IMG_URL .'no_preview.png'?>";
		
		$('#cur_image > img').attr('src',no_preview_image );

	}	
	
</script>
<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="products form">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash();?> &nbsp;</div>

<?php echo $this->Form->create('Product', array('type'=>'file','onSubmit'=>'return validate_form()')); ?>	
	
	<div class='module_title' style='margin-top:45px'>
		<fieldset>
			<div style='height:50px' >
				<legend><?php echo __('Edit Product'); ?></legend>
				<?php 	echo $this->Form->input('product_id'); ?>
			</div>
			<div class="float" style='width:67%'>
				<div class='form_field_title' style='margin-left:0px; height:40px'>
					<?php echo __('Product Name'); ?>	
				</div>
				<?php	echo $this->Form->input('product_name',  array('label'=>false, 'height'=>'50px')); ?>
			</div>

			
			<div class="float" style='width:115px; margin-left:15px'>
				<div id='cur_image' style='border:2px solid #ccc; height:115px; width:115px'>
					<?php
						if ( $this->data['Product']['product_image_url'] && is_file (  IMAGES . "products/". $this->data['Product']['product_image_url']) )
							echo ($this->Html->image( "products/" .$this->data['Product']['product_image_url'],array('border'=>0,'width'=>'115','height'=>'115'))) ;
						else
							echo ($this->Html->image( 'product_image.png',array('border'=>0,'width'=>'115','height'=>'115'))) ;
					?>					
					<input type="file" id="product_image" name="data[Product][product_image]" style="font-size: 50px; height:120px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -122px;; left:-5px" onchange='imagePreview(this)' />
				</div>
				<div id='image_description' style='margin:2px 0px 0px 0px; font-size:12px; color:#000;'> </div>
				
			</div>

			<div style='clear:both'> </div>	

			<div class="float" style='width:100%; height:40px'>
				<div style='float:left; width: 66%;line-height:40px' >
					<div class='form_field_title' style='margin-left: 0px; float:left; width: 100px;line-height:15px'> <?php echo __('Chicken'); ?> </div>

					<div style='float:left; width:20px; line-height:18px; height:20px; margin-top:10px'> <?php echo $this->Form->input('chicken', array('label'=>false,'type'=>'checkbox')); ?> 	</div>						
					<div class='form_field_title' style='margin: 10px 0px 0px 100px; float:left; width: 100px;line-height:15px'> <?php echo __('Puppy'); ?> </div>
					<div style='float:left; width:20px; line-height:18px; height:20px; margin-top:10px'> <?php echo $this->Form->input('puppy', array('label'=>false,'type'=>'checkbox'));?></div>

				</div>

			</div>
			<div style='clear:both'> </div>			
			
			<div class="float" style='width:68%; Height:80px'>
				
				<div class='form_field_title' style='padding-top:5px;margin-left:0px'> <?php echo __('Select Brand'); ?> </div>
				
				<div style='height:40px; line-height:40px'> <?php echo $this->Form->input('brand_id', array('label'=>false) ) ; ?> </div>
				
			</div>
			
			<div style='clear:both; height:10px'>  </div>
			
			<div style='float:left; width: 100%; height:250px'>

					<div class='form_field_title' style='height:50px; line-height:50px'>
						<?php echo __('Category'); ?></h2>	
					</div>
					
					<div class="float" style='width:76%; height:100px'>	
						
						<div style='float:left; width: 540px;'>
							<input type='text' id='txt_category' disabled >
						</div>					
						<div style='float:left' id='special_dropdown_category'>							
							<?php echo $this->Html->image('drop_down.png');?>
						</div>
						
						<div style='clear:both'> </div>
						
						<div id='special_dropdown_category_target' style='height:110px; width:560px; border:1px solid #ccc; overflow-y:scroll;position:relative; top:-4px''>
							<?php foreach ( $categories as $key => $category ) {?>						
								
								<div style='float:left; width:20px' class='spc_dd'>
								<input id='DataProductCategory' class='clsCategory'  name='DataProductCategory[]' type='checkbox' value='<?php echo $key;?>'  CategoryIdHiddenValue='<?php echo $category ?>'  <?php if ( @in_array($key, $cats_prod )) echo "checked=checked" ?>  > 
								</div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:30px'> 
									<span style='color:black; font-size:15px; font-weight:lighter' title="<?php echo $category ?>">
									<?php	echo substr ($category, 0, 30);
										if (strlen ($category > 30))
											echo " . . . ";?>
									</span>
								</div>
								<div style='clear:both'> </div>
								
							<?php } ?>
						</div>
					</div>
				</div>
			<div style='clear:both'> </div>
			
			<div class='form_field_title' style='line-height:30px; height:40px'>	<?php echo __('Select Attributes'); ?>	</div>

			<div class="float" style='width:68%; margin-left:10px;' class='spc_dd'>
				<div style='float:left; width: 540px;' class='spc_dd'>			<input type='text' disabled  class='spc_dd' id='disabled_text'>				</div>
				<div style='float:left' id='special_dropdown' class='spc_dd'>						
					<?php echo $this->Html->image("drop_down.png", array('class'=>'spc_dd'))?>
				</div>
				
				<div style='clear:both'> </div>
				
				<div id='special_dropdown_target' style='height:110px; border:1px solid #ccc; overflow-y:scroll; width:560px; position:relative; top:-4px' class='spc_dd'>
					<?php foreach ( $attributes as $key => $attribute ) {  ?>						
						<div class='spc_dd'> 
							<div style='float:left; width:30px' class='spc_dd'>
								<input type='checkbox' name='DataProductAttributeId[]' value='<?php echo $key;?>' id='DataProductAttributeId' 
									<?php if ( @in_array($key, $prd_attr )) echo "checked=checked" ?> class='spc_dd' > 
							</div> 
							
							<div style='float:left; margin:0px 0px 0px 10px' class='spc_dd'> 
								<span style='color:black; font-size:15px; font-weight:lighter' class='spc_dd'> <?php echo $attribute ?> </span>
							</div>
							<div style='clear:both'> </div>
						</div>							
					<?php } ?>
				</div>					
			</div>

			<div style='clear:both'> </div>
	
			<div class="submit float" style='margin:0px 0px 0px 10px; height:50px; line-height:80px'>  <input  type="submit" value="Submit" id='btn_submit'/> </div>
		</fieldset>			
	</div>
</div>
