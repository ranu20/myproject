<?php
	$start = $this->Custom->serilizeIndex(7);
?>

<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="products index">
	<div style='color:red; height:20px'> <?php echo $this->Session->flash();?> &nbsp;</div>
	
	<div class='module_title'>
		<?php echo __('Products'); ?>
		<span class='black_box' style='height:20px; line-height:14px'>
			<?php echo $this->Html->link(__('Add new'), array('action' => 'add')); ?>
		</span>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th width='75px'><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th width='265px'><?php echo $this->Paginator->sort('product_name'); ?></th>			
			<th width='75px'> <?php echo $this->Paginator->sort('brand'); ?></th>
			<th width='50px'> <div style='margin-bottom:4px'><?php echo $this->Paginator->sort('product_image'); ?> </div></th>
			<th width='95px'><?php echo $this->Paginator->sort('updated'); ?></th>			
			<th class='headings'> Actions</th>
	</tr>
	<?php foreach ($products as $product): ?>
	<tr>
		<td> <span class='td_span'><?php echo $start; //echo $product['Product']['product_id']; ?> </span>
		</td>
		<td title="<?php echo $product['Product']['product_name'] ?>"> 
			<div class='td_span'> <?php echo substr ($product['Product']['product_name'], 0, 40); 
				if (strlen( $product['Product']['product_name'] ) >=40)
					echo ". . . . .";				
			?> </div>
		</td>
		<td>  <div class='td_span'>
			<?php echo substr ($product['Brand']['brand_name'], 0, 15); 
				if (strlen( $product['Brand']['brand_name'] ) >=15)
					echo ". . . . .";				
			?>	</</span>	
		<td> <div class='td_span'>
			<?php	if (isset( $product['Product']['product_image_url']) && is_file (  IMAGES.'products/'. $product['Product']['product_image_url'] )) 
						echo $this->Html->image( 'products/' . $product['Product']['product_image_url'], array('width'=>40, 'height'=>40));
					else
						echo ($this->Html->image( 'no_image.png',array('border'=>0,'width'=>'40','height'=>'40'))) ;
			?>  
			</div>
		</td>

		<td><?php echo h($product['Product']['updated_date']); ?>&nbsp;</td>
		
		<td>
			<span class='black_box'>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['product_id'])); ?>
			</span>
			<span class='black_box'>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['product_id']), null, __('Are you sure, you want to delete this product.', $product['Product']['product_id'])); ?>
			</span>
		</td>
	</tr>
<?php $start++; endforeach; ?>
	</table>

	<div class="paging">
		<?php			
			echo $this->Paginator->first('< ' . __('First'), array(), null);
			echo $this->Paginator->prev('< ' . __('Previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('Next') . ' >', array(), null, array('class' => 'next disabled'));
			echo $this->Paginator->last(__('Last') . ' >', array(), null, array('class' => 'last disabled'));
		?>
	</div>
	
</div>

