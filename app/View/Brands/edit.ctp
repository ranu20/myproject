<script>
	function validateForm (){		
		if ( $.trim ( $('#BrandBrandName').val()) == '') {
			alert('Please enter brand name.');
			$('#BrandBrandName').focus();
			return false;
		}
		return true;
	}
	
	function imageDescription( input ){
		if( $.browser.msie || $.browser.safari || $.browser.chrome){
			// removing text c:\fakepath\
			$("#image_description").html( document.getElementById('brand_image').value.substring(12) );
		}
		else{
			$("#image_description").html( document.getElementById('brand_image').value);
		}
	}
	
	$(document).ready ( function (){
		
		//$( "#flashMessage" ).fadeOut(5000);
			
		
	});
</script>

<style>
.hidden_browse{ font-size: 50px; height:120px; width: 120px; opacity: 0; filter:alpha(opacity: 0);  position: relative; top: -122px;; left:-5px; }
</style>
<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="brands form">
	
	<div style='color:red; height:20px' align='center'> <?php echo $this->Session->flash(); ?> </div>
	<?php echo $this->Form->create('Brand', array('type'=>'file','onSubmit'=>'return validateForm()')); ?>
		
	<div style="display:none;">
		<input type="hidden" name="_method" value="POST"/>
		<?php echo $this->Form->input('brand_id'); ?>
	</div>
	
	<div class='module_title'>
		<fieldset>
			<legend>Edit Brand</legend>				
			
			<div class="float" style='width:65%; height:75px'>
				<?php echo $this->Form->input('brand_name', array('label'=>false)); ?>				
			</div>			
			
			<div class="float" style='width:115px; margin-left:15px'>
				<div id='cur_image' style='border:2px solid #ccc; height:115px; width:115px'>
					<?php
						if ( !empty ( $this->data['Brand']['image_url']) && is_file (  IMAGES . "brands/". $this->data['Brand']['image_url']) )
							echo ($this->Html->image( "brands/" .$this->data['Brand']['image_url'],array('border'=>0,'width'=>'115','height'=>'115'))) ;
						else
							echo ($this->Html->image( 'product_image.png',array('border'=>0,'width'=>'115','height'=>'115'))) ;
					?>
					<input type="file" id="brand_image" name="data[Brand][brand_image]" class="hidden_browse" onchange='imageDescription(this)' />					
				</div>
				
				<div id='image_description' style='margin:2px 0px 0px 0px; font-size:10px; color:#000;'> </div>
			</div>
			
			<div style='clear:both'> </div>

			<div class="submit float">
				<input type="submit" value="Submit" id='btn_submit' name='btn_submit'/>
			</div>				
		</fieldset>
	</div>
		
	<?php echo $this->Form->end(); ?>
</div>



