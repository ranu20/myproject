<div class="questionTypes index">
	<h2><?php echo __('Question Types'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('question_type_id'); ?></th>
			<th><?php echo $this->Paginator->sort('question_type'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($questionTypes as $questionType): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($questionType['QuestionType'][''], array('controller' => 'question_types', 'action' => 'view', $questionType['QuestionType']['id'])); ?>
		</td>
		<td><?php echo h($questionType['QuestionType']['question_type']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $questionType['QuestionType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $questionType['QuestionType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $questionType['QuestionType']['id']), null, __('Are you sure you want to delete # %s?', $questionType['QuestionType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Question Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Question Types'), array('controller' => 'question_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Type'), array('controller' => 'question_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
