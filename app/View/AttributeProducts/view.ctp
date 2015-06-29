<div class="attributeProducts view">
<h2><?php echo __('Attribute Product'); ?></h2>
	<dl>
		<dt><?php echo __('Attribute Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attributeProduct['AttributeProduct'][''], array('controller' => 'attribute_products', 'action' => 'view', $attributeProduct['AttributeProduct']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribute'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attributeProduct['Attribute'][''], array('controller' => 'attributes', 'action' => 'view', $attributeProduct['Attribute']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($attributeProduct['Product'][''], array('controller' => 'products', 'action' => 'view', $attributeProduct['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($attributeProduct['AttributeProduct']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated Date'); ?></dt>
		<dd>
			<?php echo h($attributeProduct['AttributeProduct']['updated_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Attribute Product'), array('action' => 'edit', $attributeProduct['AttributeProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Attribute Product'), array('action' => 'delete', $attributeProduct['AttributeProduct']['id']), null, __('Are you sure you want to delete # %s?', $attributeProduct['AttributeProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Attribute Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attribute Products'), array('controller' => 'attribute_products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute Product'), array('controller' => 'attribute_products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attribute'), array('controller' => 'attributes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Attribute Products'); ?></h3>
	<?php if (!empty($attributeProduct['AttributeProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Attribute Product Id'); ?></th>
		<th><?php echo __('Attribute Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th><?php echo __('Updated Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($attributeProduct['AttributeProduct'] as $attributeProduct): ?>
		<tr>
			<td><?php echo $attributeProduct['attribute_product_id']; ?></td>
			<td><?php echo $attributeProduct['attribute_id']; ?></td>
			<td><?php echo $attributeProduct['product_id']; ?></td>
			<td><?php echo $attributeProduct['deleted']; ?></td>
			<td><?php echo $attributeProduct['updated_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attribute_products', 'action' => 'view', $attributeProduct['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attribute_products', 'action' => 'edit', $attributeProduct['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attribute_products', 'action' => 'delete', $attributeProduct['id']), null, __('Are you sure you want to delete # %s?', $attributeProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->element('left_navigation'); ?>
	</div>
</div>
