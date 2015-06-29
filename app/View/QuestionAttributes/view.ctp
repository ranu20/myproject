<div class="questionAttributes view">
<h2><?php echo __('Question Attribute'); ?></h2>
	<dl>
		<dt><?php echo __('Question Attribute'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionAttribute['QuestionAttribute'][''], array('controller' => 'question_attributes', 'action' => 'view', $questionAttribute['QuestionAttribute']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Question'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionAttribute['Question'][''], array('controller' => 'questions', 'action' => 'view', $questionAttribute['Question']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribute'); ?></dt>
		<dd>
			<?php echo $this->Html->link($questionAttribute['Attribute'][''], array('controller' => 'attributes', 'action' => 'view', $questionAttribute['Attribute']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($questionAttribute['QuestionAttribute']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated Date'); ?></dt>
		<dd>
			<?php echo h($questionAttribute['QuestionAttribute']['updated_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Question Attribute'), array('action' => 'edit', $questionAttribute['QuestionAttribute']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Question Attribute'), array('action' => 'delete', $questionAttribute['QuestionAttribute']['id']), null, __('Are you sure you want to delete # %s?', $questionAttribute['QuestionAttribute']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Attributes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Attribute'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Question Attributes'), array('controller' => 'question_attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Attribute'), array('controller' => 'question_attributes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Question Attributes'); ?></h3>
	<?php if (!empty($questionAttribute['QuestionAttribute'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Question Attribute Id'); ?></th>
		<th><?php echo __('Question Id'); ?></th>
		<th><?php echo __('Attribute Id'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Updated Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($questionAttribute['QuestionAttribute'] as $questionAttribute): ?>
		<tr>
			<td><?php echo $questionAttribute['question_attribute_id']; ?></td>
			<td><?php echo $questionAttribute['question_id']; ?></td>
			<td><?php echo $questionAttribute['attribute_id']; ?></td>
			<td><?php echo $questionAttribute['deleted']; ?></td>
			<td><?php echo $questionAttribute['updated_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'question_attributes', 'action' => 'view', $questionAttribute['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'question_attributes', 'action' => 'edit', $questionAttribute['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'question_attributes', 'action' => 'delete', $questionAttribute['id']), null, __('Are you sure you want to delete # %s?', $questionAttribute['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Question Attribute'), array('controller' => 'question_attributes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
