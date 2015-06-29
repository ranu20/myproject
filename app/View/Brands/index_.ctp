<?php
	$start = $this->Custom->serilizeIndex(7);
?>

<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="brands index">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?> </div>
	
	<div class='module_title'>
		<?php echo __('Brands'); ?>
		<span class='black_box' style='height:20px; line-height:14px'>			
			<?php echo $this->Html->link(__('Add new'), array('action' => 'add')); ?>
		</span>
	</div>	
	
	<table cellpadding="0" cellspacing="0" width='100%'>
	<tr>
		<th> <div style='margin-bottom:4px'> <?php echo $this->Paginator->sort('brand_id'); ?> </div></th>
		<th> <div style='margin-bottom:4px'><?php echo $this->Paginator->sort('brand_name'); ?></div></th>			
		<th> <div style='margin-bottom:4px'><?php echo $this->Paginator->sort('updated_date'); ?> </div> </th>		
		<th class='headings'> <div style='margin-bottom:4px'><?php echo ('Actions'); ?> </div></th>
	</tr>	
	<?php foreach ($brands as $brand): ?>
	
	<tr>
		<td> <span class='td_span'>   <?php echo $start; //echo $brand['Brand']['brand_id']; ?> </span></td>
		<td title="<?php echo $brand['Brand']['brand_name']?>"> 
			<div class='td_span'>  <?php echo substr ( $brand['Brand']['brand_name'], 0, 35); if (strlen($brand['Brand']['brand_name']) >= 35) echo " . . . . ."?>&nbsp;</div>
		</td>
		<td> <div class='td_span'>  <?php echo h($brand['Brand']['updated_date']); ?>&nbsp; </div></td>	

		<td class="actions_index">			
			<span class='black_box'>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $brand['Brand']['brand_id'])); ?>
			</span>
			<span class='black_box'>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $brand['Brand']['brand_id']), null, __('Are you sure, you want to delete this brand.', $brand['Brand']['brand_id'])); ?>
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
