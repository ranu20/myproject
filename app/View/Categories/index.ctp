<?php
	$start = $this->Custom->serilizeIndex(7);
?>

<script>
	function validate_form (){		
		if ( $.trim ( $('#CategoryCategoryName').val()) == '') {
			alert('Please enter category name.');
			$('#CategoryCategoryName').focus();
			return false;
		}		
	}

</script>
<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="brands index">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash();?> &nbsp;</div>

	<div class='module_title'>
		<?php echo __('Categories'); ?>
		<span class='black_box' style='height:20px; line-height:14px'>
			<?php echo $this->Html->link(__('Add new'), array('action' => 'add')); ?>
		</span>
	</div>
	
	<table cellpadding="0" cellspacing="0" width='100%'>
	
	<tr>			
		<th> <div style='margin-bottom:4px'><?php echo $this->Paginator->sort('category_id'); ?> </div></th>
		<th width='350px'> <div style='margin-bottom:4px'><?php echo $this->Paginator->sort('category_name'); ?></div></th>			
		<th> <div style='margin-bottom:4px'><?php echo $this->Paginator->sort('updated_date'); ?></div></th>
		<th class='headings'> <div style='margin-bottom:4px'><?php echo ('Actions'); ?></div></th>
	</tr>

	<?php
	foreach ($categories as $Category): ?>	
	<tr>		
		<td>
			<span class='td_span'> <?php  echo $start; //echo $Category['Category']['category_id']; ?> </span>
		</td>
		<td> <span class='td_span'> <?php 
			echo substr ($Category['Category']['category_name'] , 0, 50);
			if ( strlen($Category['Category']['category_name']) > 50)
				echo ". . . . .";
		?>&nbsp; </span></td>		
		<td> <span class='td_span'> <?php echo h($Category['Category']['updated_date']); ?>&nbsp; </span></td>

		<td class="actions_index">			
			<span class='black_box'>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $Category['Category']['category_id'])); ?>
			</span>
			<span class='black_box'>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Category['Category']['category_id']), null, __('Are you sure, you want to delete this category.', $Category['Category']['category_id'])); ?>
			</span>
		</td>
	</tr>
<?php $start++; endforeach; ?>
	</table>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	
</div>
