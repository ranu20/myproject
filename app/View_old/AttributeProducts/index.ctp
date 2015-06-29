<div class="attributeProducts index">
	<h2><?php echo __('Attribute Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('attribute_product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('attribute_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th><?php echo $this->Paginator->sort('updated_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attributeProducts as $attributeProduct): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($attributeProduct['AttributeProduct'][''], array('controller' => 'attribute_products', 'action' => 'view', $attributeProduct['AttributeProduct']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attributeProduct['Attribute'][''], array('controller' => 'attributes', 'action' => 'view', $attributeProduct['Attribute']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($attributeProduct['Product'][''], array('controller' => 'products', 'action' => 'view', $attributeProduct['Product']['id'])); ?>
		</td>
		<td><?php echo h($attributeProduct['AttributeProduct']['deleted']); ?>&nbsp;</td>
		<td><?php echo h($attributeProduct['AttributeProduct']['updated_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $attributeProduct['AttributeProduct']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $attributeProduct['AttributeProduct']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $attributeProduct['AttributeProduct']['id']), null, __('Are you sure you want to delete # %s?', $attributeProduct['AttributeProduct']['id'])); ?>
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
	<?php echo $this->element('left_navigation'); ?>
</div>
