	<div style='font-size:25px; font-weight: bolder; margin: 0 0 20px 5px; font-family:'helvetica';'>
		<?php echo __('Navigation'); ?>
	</div>
	<ul>
		<li class='<?php if ($this->params['controller'] == 'attributes') echo "active"; ?>'><?php  echo $this->Html->link(__('Attributes'), array('controller' => 'attributes', 'action' => 'index')); ?> </li>
		
		<li class='<?php if ($this->params['controller'] == 'brands') echo "active";?>'><?php echo $this->Html->link(__('Brands'), array('controller' => 'brands', 'action' => 'index')); ?> </li>
		
		<li class='<?php if ($this->params['controller'] == 'categories') echo "active"; ?>'><?php echo $this->Html->link(__('Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		
		<li class='<?php if ($this->params['controller'] == 'products') echo "active"; ?>'><?php echo $this->Html->link(__('Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		
		<li class='<?php if ($this->params['controller'] == 'questions') echo "active"; ?>'><?php echo $this->Html->link(__('Questions'), array('controller' => 'questions', 'action' => 'index')); ?> </li>

		<li class='<?php if ($this->params['controller'] == 'questions') echo "active"; ?>'><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>		
		
	</ul>