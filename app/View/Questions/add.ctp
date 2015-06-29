<style>
	#CategoryId {width:100%; height:30px; line-height:30px}
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
	
	$(document).ready(function(){
	
		var attribute_array = [];
		var category_array  = [];
		
		$('.clsCategory').click (function ()
		{
			toggleSelectboxContent($(this), $(this).attr('CategoryIdHiddenValue'), category_array, 'txt_category');
		});
		
		
		$('.clsAttr').click (function ()
		{
			toggleSelectboxContent($(this), $(this).attr('attributeHiddenValue'), attribute_array, 'txt_attribute');
		});
		
	});
	
	function toggleSelectboxContent( elem, hiddenvValue, sourceArray, targetElem ) {
		if ( elem.is (':checked'))
		{
			if ( $.inArray( hiddenvValue, sourceArray)){
				sourceArray.push( hiddenvValue );
			}
		}
		else{				
			sourceArray.splice( $.inArray( hiddenvValue, sourceArray), 1 );
		}
		
		if (sourceArray.length > 2){
			$('#'+ targetElem).val( sourceArray.length + ' Items selected' );	
		}else{
			$('#'+ targetElem).val( sourceArray.join() );	
		}
	}

 </script>
 
 <div class="dashboard actions" style='min-height:750px'>	
	<?php echo $this->element('left_navigation')?>
</div>

	<div class="questions form">
		<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?> </div>
		<?php echo $this->Form->create('Question', array('onSubmit'=>'return validate_form()')); ?>	
		<?php echo $this->Form->input('question_id'); ?>	
		
		<div class='module_title' style='margin-top:23px'>

				<div style='float:left; width: 75%;'>
					
					<div class='form_field_title' style='height:60px; line-height:50px'> Add New Questions </div>
					
					<div class="float" style='width:84.5%;'>
						<input name="data[Question][question_name]" type="text" id="QuestionQuestionName"/>
					</div>
					
					<div style='clear:both'> </div>
					
					<div style='float:left; width: 100%;'>
						<div class='form_field_title' style='height:60px; line-height:50px'> Question Type </div>
						
						<div class="float" style='width:76%;'>
							<div id='special_dropdown_qt_target' style='height:70px; width:636px; border:1px solid #ccc; overflow-y:scroll;position:relative; top:-4px'>
								
								<div style='float:left; width:20px' class='spc_dd'> 
									<input type='radio' name='data[Question][question_type]' value='s' checked> 
								</div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> 	
									<span style='color:black; font-size:15px; font-weight:lighter'>Single select</span>		
								</div>
								
								<div style='clear:both'> </div>
								
								<div style='float:left; width:20px' class='spc_dd'> <input type='radio' name='data[Question][question_type]' value='m'> 	 </div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> <span style='color:black; font-size:15px; font-weight:lighter'>Multi select</span>		
								</div>
								
								<div style='clear:both'> </div>
								
							</div>
						</div>
					</div>
					
					<div style='clear:both;'> </div>

					<div style='height:100px' style='width:100%;'>
						<div class='form_field_title' style='height:50px; line-height:40px'> Category  </div>
						
						<div class="float" style='width:86%; height:100px'>	
							<div>
								<div style='float:left; width: 95%;'> <input type='text' disabled id='txt_category'> </div>							
								<div style='float:left' id='special_dropdown_category'> <?php echo $this->Html->image('drop_down.png')?> </div>
							</div>
							
							<div style='clear:both'> </div>
							
							<div id='special_dropdown_category_target' style='height:100px; border:1px solid #ccc; overflow-y:scroll;width:638px;position:relative; top:-4px'>
								<?php foreach ( $categories as $key => $category ) {?>						
									<div> 
										<div style='float:left; width:20px' class='spc_dd'>
											<input id='CategoryId' name='CategoryId[]' class='clsCategory' type='checkbox' value='<?php echo $key;?>'  CategoryIdHiddenValue='<?php echo $category ?>' >  
										</div> 
										<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> 
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
						<div class='form_field_title' style='height:55px; line-height:50px'> Attribute </div>				
						
						<div class="float" style='width:86%'>
							
							<div style='float:left; width: 95%;' id='disabled_text_container'>
								<input type='text' disabled id='txt_attribute'>
							</div>
							<div style='float:left' id='special_dropdown'> 
								<?php echo $this->Html->image('drop_down.png')?>
							</div>
							
							<div id='special_dropdown_target' style='height:110px; border:1px solid #ccc; overflow-y:scroll; width:638px;position:relative; top:-4px'>
								<?php foreach ( $attributes as $key=>$attribute ) {?>						
									
										<div style='float:left; width:20px' class='spc_dd'>
											<input type='checkbox' name='AttributeId[]' value='<?php echo $key?>' id='AttributeId' class='clsAttr' attributeHiddenValue='<?php echo $attribute?>' > 
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
									
								<?php } ?>
							</div>					
						</div>
						
						<div style='clear:both; height:20px'> </div>
						
						<div class="submit float">
							<?php echo $this->Form->end(__('Submit')); ?>
						</div>

						
					</div>

			
				
		
			
	</div>		
	</form>
</div>

