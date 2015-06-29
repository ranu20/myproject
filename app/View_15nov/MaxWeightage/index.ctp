<?php
	pr( $max_weightages );//exit;
?>
<div class="roles index">
	<h2><?php echo __('Roles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('maximum_weightage'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($max_weightages as $max_weightage): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($max_weightage['MaxWeightage']['id'], array('controller' => 'roles', 'action' => 'view', $max_weightage['MaxWeightage']['id'])); ?>
		</td>
		<td><?php echo h($max_weightage['MaxWeightage']['maximum_weightage']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $max_weightage['MaxWeightage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $max_weightage['MaxWeightage']['id'])); ?>
			<?php /*echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $max_weightage['MaxWeightage']['id']), null, __('Are you sure you want to delete # %s?', $max_weightages['MaxWeightage']['id']));*/ ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<?php echo $this->element('left_navigation')?>
</div>
