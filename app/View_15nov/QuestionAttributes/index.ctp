<div class="questionAttributes index">
	<h2><?php echo __('Question Attributes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('question_attribute_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attribute_id'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($questionAttributes as $questionAttribute): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($questionAttribute['QuestionAttribute'][''], array('controller' => 'question_attributes', 'action' => 'view', $questionAttribute['QuestionAttribute']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($questionAttribute['Question'][''], array('controller' => 'questions', 'action' => 'view', $questionAttribute['Question']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($questionAttribute['Attribute'][''], array('controller' => 'attributes', 'action' => 'view', $questionAttribute['Attribute']['id'])); ?>
		</td>
		<td><?php echo h($questionAttribute['QuestionAttribute']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($questionAttribute['QuestionAttribute']['updated_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $questionAttribute['QuestionAttribute']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $questionAttribute['QuestionAttribute']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $questionAttribute['QuestionAttribute']['id']), null, __('Are you sure you want to delete # %s?', $questionAttribute['QuestionAttribute']['id'])); ?>
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
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Question Attribute'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Question Attributes'), array('controller' => 'question_attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Attribute'), array('controller' => 'question_attributes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
