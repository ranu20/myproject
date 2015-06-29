<style>
#CategoryId {width:100%; height:40px; line-height:40px} 

</style>

 <script>
	function validate_form ()
	{
		if ( $.trim ( $('#QuestionQuestionName').val()) == '') {
			alert('Please enter question.');
			$('#QuestionQuestionName').focus();
			return false;
		}		
				
		if($('#special_dropdown_category_target').find('input[type=checkbox]:checked').length == 0)
		{
			alert('Please select atleast one category');
			return false;
		}
		
		if($('#special_dropdown_target').find('input[type=checkbox]:checked').length == 0)
		{
			alert('Please select atleast one attribute');
			return false;
		}
		return true;
	}	

 </script>
 
 <div class="dashboard actions" style='min-height:750px'>	
	<?php echo $this->element('left_navigation')?>
</div>

	<div class="questions form">
		<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?> </div>
		<?php echo $this->Form->create('Question', array('onSubmit'=>'return validate_form()')); ?>	
		<?php echo $this->Form->input('question_id'); ?>	
		
		<div class='module_title'>
			<fieldset>
				<legend>Add New Questions</legend>
				<div style=''>
					<div class="float" style='width:75%;'>
						<input name="data[Question][question_name]" type="text" id="QuestionQuestionName"/>
					</div>
					<div style='clear:both'> </div>
				</div>
				
				<div style='float:left; width: 100%; height:160px'>
					<div class='form_field_title' style='height:50px; line-height:50px'>
						<?php echo __('Question Type'); ?></h2>	
					</div>					
					<div class="float" style='width:76%; height:100px'>
						<div style='float:left; width: 95%;'> <input type='text' disabled > </div>					
						<div style='float:left' id='special_dropdown_qt'> <img src='/petgurudev/img/drop_down.png'> </div>						
						<div style='clear:both'> </div>
						
						<div id='special_dropdown_qt_target' style='height:70px; width:636px; border:1px solid #ccc; overflow-y:scroll;position:relative; top:-4px'>							
							<div> 
								<div style='float:left; width:20px' class='spc_dd'><input type='radio' name='data[Question][question_type_id]' value='1' checked> </div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> 	<span style='color:black; font-size:15px; font-weight:lighter'>Single select</span>		</div>
								<div style='clear:both'> </div>
								<div style='float:left; width:20px' class='spc_dd'>		<input type='radio' name='data[Question][question_type_id]' value='2'> 	</div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> 	<span style='color:black; font-size:15px; font-weight:lighter'>Multi select</span>		</div>
								<div style='clear:both'> </div>
							</div>							
						</div>
					</div>
				</div>
				
				<div style='clear:both; height:20px'> </div>

				<div style='height:100px' >
					<div class='form_field_title' style='height:40px; line-height:40px'>
						<?php echo __('Category'); ?>
					</div>
					
					<div class="float" style='width:76%; height:100px'>	
						<div style='float:left; width: 95%;'> <input type='text' disabled > </div>					
						
						<div style='float:left' id='special_dropdown_category'> <img src='/petgurudev/img/drop_down.png'> </div>
						
						<div style='clear:both'> </div>
						
						<div id='special_dropdown_category_target' style='height:110px; border:1px solid #ccc; overflow-y:scroll;width:636px;position:relative; top:-4px'>
							<?php foreach ( $categories as $key => $category ) {?>						
								<div> 
									<div style='float:left; width:20px' class='spc_dd'>
										<input type='checkbox' name='CategoryId[]' value='<?php echo $key;?>' id='CategoryId'?>  
									</div> 
									<div style='float:left; margin:0px 0px 0px 20px; line-height:30px'> 
										<span style='color:black; font-size:15px; font-weight:lighter' title="<?php echo $category ?>">
										<?php	echo substr ( $category, 0, 30);
											if (strlen ( $category > 30 ))
												echo " . . . ";?>
										</span>
									</div>
									<div style='clear:both'> </div>
								</div>							
							<?php } ?>
						</div>
					</div>
				</div>
				
				<div style='clear:both; height:50px'> </div>
				
				<div style='height:200px'>
					<div class='form_field_title' style='height:50px; line-height:50px'>
						<?php echo __('Attribute'); ?></h2>	
					</div>				
					
					<div class="float" style='width:76%'>
							<div style='clear:both'> </div>
							<div style='float:left; width: 95%;' id='disabled_text_container'>
							<input type='text' disabled id='disabled_text_'>
						</div>
						<div style='float:left' id='special_dropdown'>
							<img src='/petgurudev/img/drop_down.png'>
						</div>
						
						<div id='special_dropdown_target' style='height:110px; border:1px solid #ccc; overflow-y:scroll; width:636px;position:relative; top:-4px'>
							<?php foreach ( $attributes as $key=>$attribute ) {?>						
								<div> 
									<div style='float:left; width:20px' class='spc_dd'>
										<input type='checkbox' name='AttributeId[]' value='<?php echo $key?>' id='AttributeId'> 
									</div> 
									<div style='float:left; margin:0px 0px 0px 20px; line-height:30px'> 
										<span  style='color:black; font-size:15px; font-weight:lighter' title="<?php echo $attribute?>"> 
											<?php 
												echo substr ( $attribute,0, 30 );
												if (strlen ( $attribute > 30 ))
													echo " . . . ";													
											?>
										</span>
									</div>
									<div style='clear:both'> </div>
								</div>							
							<?php } ?>
						</div>					
					</div>

					
				</div>
						
			</fieldset>
		
			<div class="submit float">
				<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>		
			
	</div>		
	</form>
</div>

