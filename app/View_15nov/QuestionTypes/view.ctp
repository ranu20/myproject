<div class="questionTypes view">
<h2><?php echo __('Question Type'); ?></h2>
	<dl>
		<dt><?php echo __('Question Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionType['QuestionType'][''], array('controller' => 'question_types', 'action' => 'view', $questionType['QuestionType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question Type'); ?></dt>
		<dd>
			<?php echo h($questionType['QuestionType']['question_type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question Type'), array('action' => 'edit', $questionType['QuestionType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question Type'), array('action' => 'delete', $questionType['QuestionType']['id']), null, __('Are you sure you want to delete # %s?', $questionType['QuestionType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Types'), array('controller' => 'question_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Type'), array('controller' => 'question_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Question Types'); ?></h3>
	<?php if (!empty($questionType['QuestionType'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Question Type Id'); ?></th>
		<th><?php echo __('Question Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($questionType['QuestionType'] as $questionType): ?>
		<tr>
			<td><?php echo $questionType['question_type_id']; ?></td>
			<td><?php echo $questionType['question_type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'question_types', 'action' => 'view', $questionType['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'question_types', 'action' => 'edit', $questionType['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'question_types', 'action' => 'delete', $questionType['id']), null, __('Are you sure you want to delete # %s?', $questionType['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question Type'), array('controller' => 'question_types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Questions'); ?></h3>
	<?php if (!empty($questionType['Question'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Question Name'); ?></th>
		<th><?php echo __('Question Type Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Updated Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($questionType['Question'] as $question): ?>
		<tr>
			<td><?php echo $question['question_id']; ?></td>
			<td><?php echo $question['question_name']; ?></td>
			<td><?php echo $question['question_type_id']; ?></td>
			<td><?php echo $question['category_id']; ?></td>
			<td><?php echo $question['deleted']; ?></td>
			<td><?php echo $question['updated_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'questions', 'action' => 'view', $question['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'questions', 'action' => 'edit', $question['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'questions', 'action' => 'delete', $question['id']), null, __('Are you sure you want to delete # %s?', $question['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
