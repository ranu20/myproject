<div class="questionAttributes form">
<?php echo $this->Form->create('QuestionAttribute'); ?>
	<fieldset>
		<legend><?php echo __('Add Question Attribute'); ?></legend>
	<?php		
		echo $this->Form->input('question_id');
		echo $this->Form->input('attribute_id');
		echo $this->Form->input('deleted');
		echo $this->Form->input('updated_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Question Attributes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Question Attributes'), array('controller' => 'question_attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question Attribute'), array('controller' => 'question_attributes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Question'), array('controller' => 'questions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
	</ul>
</div>
