<?php	
	$categories_string = implode(',', $quest_cats_names);
	$attributes_string = implode(',', $quest_attrs_names);
?>
<style>
	#category_id {width:100%; height:30px; line-height:30px}
</style>

 <script>
	
	// variables to show the checked/unchecked content of custom dropdown/selectbox
	var categories_string	= '<?php echo $categories_string?>';
	var attribute_string	= '<?php echo $attributes_string?>';
	var category_array  	= categories_string.split(',');
	var attribute_array 	= attribute_string.split(',');
	
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
	
		$('#disabled_text, #disabled_text_container, #special_dropdown').click(function(){
			//$('#special_dropdown_target').toggle();			
		});
		
		
		$('#txt_category').val( category_array.join());
		$('#txt_attribute').val( attribute_array.join());		
		
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


	<div class="question form">
		<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?> </div>
		<?php echo $this->Form->create('Question', array('onSubmit'=>'return validate_form()')); ?>	
		<?php echo $this->Form->input('question_id'); ?>	
		
		<div class='module_title'>
			<fieldset>
				<legend>Edit Question</legend>
				<div style='float:left; width: 100%; height:40px'>					
					<div class="float" style='width:75%;'>
						<?php echo $this->Form->input('question_name', array('label'=>false) ); ?>
					</div>
				</div>

				<div style='clear:both'> </div>
				
				<div style='float:left; width: 100%;'>
					<div class='form_field_title' style='height:50px; line-height:50px'>
						<?php echo __('Question Type'); ?>
					</div>					
					<div class="float" style='width:76%;'>
						<div style='clear:both'> </div>
						
						<div id='special_dropdown_qt_target' style='height:70px; width:636px; border:1px solid #ccc; position:relative; top:-4px; overflow-y:scroll'>							
							<div> 
								<div style='float:left; width:20px' class='spc_dd'>
									<input type='radio' name='data[Question][question_type]' value='s' <?php if ($this->request->data['Question']['question_type'] == 's'  ) echo "checked"?>> 
								</div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> 	<span style='color:black; font-size:15px; font-weight:lighter'>Single select</span>		</div>
								<div style='clear:both'> </div>
								<div style='float:left; width:20px' class='spc_dd'>		
									<input type='radio' name='data[Question][question_type]' value='m' <?php if ($this->request->data['Question']['question_type'] == 'm' ) echo "checked"?>> 	
								</div> 
								<div style='float:left; margin:0px 0px 0px 20px; line-height:20px'> 	<span style='color:black; font-size:15px; font-weight:lighter'>Multi select</span>		</div>
								<div style='clear:both'> </div>
							</div>							
						</div>
					</div>
				</div>
				<div style='clear:both'> </div>
				
				<div style='float:left; width: 100%; height:175px'>

					<div class='form_field_title' style='height:50px; line-height:50px'>
						<?php echo __('Category'); ?></h2>	
					</div>
					
					<div class="float" style='width:76%; height:100px'>	
						<?php //echo $this->Form->input('category_id',array('type'=>'select','options'=>$categories, 'label'=>false,'id'=>'category_id', 'multiple'=>'true')); ?>
						<div style='float:left; width: 95%;'>
							<input type='text' id='txt_category' disabled >
						</div>					
						<div style='float:left' id='special_dropdown_category'>							
							<?php echo $this->Html->image('drop_down.png');?>
						</div>
						
						<div style='clear:both'> </div>
						
						<div id='special_dropdown_category_target' style='height:110px; width:636px; border:1px solid #ccc; overflow-y:scroll;position:relative; top:-4px''>
							<?php foreach ( $categories as $key => $category ) {?>						
								
									<div style='float:left; width:20px' class='spc_dd'>
									<input id='DataQuestionCategory' class='clsCategory'  name='DataQuestionCategory[]' type='checkbox' value='<?php echo $key;?>'  CategoryIdHiddenValue='<?php echo $category ?>'  <?php if ( @in_array($key, $quest_cats )) echo "checked=checked" ?>  > 
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

				<div style='clear:both; height:50px'> </div>
					
				<div style='float:left; width: 100%; height:200px'>
					
					<div class='form_field_title' style='height:50px;line-height:50px'>
						<?php echo __('Attributes'); ?>
					</div>
					
					<div class="float" style='width:76%; margin-left:10px'>
						<div style='float:left; width: 95%;'>
							<input id='txt_attribute' type='text' disabled >
						</div>					
						<div style='float:left' id='special_dropdown'>
							<?php echo $this->Html->image('drop_down.png');?>
						</div>
						
						<div style='clear:both'> </div>
						
						<div id='special_dropdown_target' style='height:110px; border:1px solid #ccc; overflow-y:scroll; width:636px;position:relative; top:-4px''>
							<?php foreach ( $attributes as $key => $attribute ) {  ?>						
								<div> 
									<div style='float:left; width:20px' class='spc_dd'>
										<input id='DataProductAttributeId' name='DataProductAttributeId[]' type='checkbox'  value='<?php echo $key;?>' class='clsAttr' attributeHiddenValue='<?php echo $attribute?>' <?php if ( @in_array($key, $quest_attrs )) echo "checked=checked" ?> >	
									</div> 
									<div style='float:left; margin:0px 0px 0px 20px; line-height:30px'> 
										<span style='color:black; font-size:15px; font-weight:lighter' title="<?php echo $attribute ?>">
										<?php	echo substr ($attribute, 0, 30);
											if (strlen ($attribute > 30))
												echo " . . . ";?>
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