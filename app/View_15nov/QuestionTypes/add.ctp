<div class="questionTypes form">
<?php echo $this->Form->create('QuestionType'); ?>
	<fieldset>
		<legend><?php echo __('Add Question Type'); ?></legend>
	<?php
		echo $this->Form->input('question_type_id');
		echo $this->Form->input('question_type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Question Types'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Question Types'), array('controller' => 'question_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Type'), array('controller' => 'question_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
	</ul>
</div>
