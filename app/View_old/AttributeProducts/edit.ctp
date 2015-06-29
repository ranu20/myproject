<div class="attributeProducts form">
<?php echo $this->Form->create('AttributeProduct'); ?>
	<fieldset>
		<legend><?php echo __('Edit Attribute Product'); ?></legend>
	<?php
		echo $this->Form->input('attribute_product_id');
		echo $this->Form->input('attribute_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('deleted');
		echo $this->Form->input('updated_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<?php echo $this->element('left_navigation'); ?>
</div>
