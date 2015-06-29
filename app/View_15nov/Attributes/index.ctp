<?php
	$start = $this->Custom->serilizeIndex(7);
?>
<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="attributes index">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?>&nbsp; </div>
	
	<div class='module_title'>
		<?php echo __('Attributes'); ?>
		<span class='black_box' style='height:20px; line-height:14px' >			
			<?php echo $this->Html->link(__('Add new'), array('action' => 'add')); ?>
		</span>
	</div>

	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><div style='margin-bottom:4px'><?php echo $this->Paginator->sort('attribute_id'); ?></div></th>
		<th><div style='margin-bottom:4px'><?php echo $this->Paginator->sort('attribute_name'); ?></div></th>
		<th><div style='margin-bottom:4px'><?php echo $this->Paginator->sort('weight'); ?></div></th>
		<th><div style='margin-bottom:4px'><?php echo $this->Paginator->sort('updated_date'); ?></div></th>
		<th class='headings'><div style='margin-bottom:4px'><?php echo 'Actions' ?></div></th>
	</tr>


	<?php 
		
		foreach ($attributes as $attribute): ?>
	<tr>

		<td> <span class='td_span'> <?php echo $start;//echo $attribute['Attribute']['attribute_id']; ?></span>		</td>
		<td title="<?php echo $attribute['Attribute']['attribute_name']?>"> 
			<span class='td_span'> 
			<?php
				echo substr( $attribute['Attribute']['attribute_name'], 0,30); 
				if( strlen($attribute['Attribute']['attribute_name'] ) > 30 ) 
					echo " . . . " ?> </span>
		</td>
		<td> <span class='td_span'> <?php echo h($attribute['Attribute']['weight']); ?></span></td>
		<td> <span class='td_span'> <?php echo h($attribute['Attribute']['updated_date']); ?></span></td>
		<td class='actions_index'>
			<span class='black_box'>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attribute['Attribute']['attribute_id'])); ?>
			</span>
			<span class='black_box'>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attribute['Attribute']['attribute_id']), null, __('Are you sure, you want to delete this attribute.', $attribute['Attribute']['attribute_id'])); ?>
			</span>
		</td>
	</tr>
	<?php $start++;  endforeach; 
	?>
	</table>	
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	
</div>
