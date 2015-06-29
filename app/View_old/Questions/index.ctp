<div class="dashboard actions">	
	<?php echo $this->element('left_navigation')?>
</div>

<div class="questions index">

	<div style='color:red; height:20px'> <?php echo $this->Session->flash(); ?> </div>
		
	<div class='module_title' style='margin: 40px 0 20px 10px;'>
		<?php echo __('Questions'); ?>
		<span class='black_box' > <a href="/petgurustage/questions/add" style='position:relative; top:-10px'>Add new</a> </span>
	</div>

	<table cellpadding="0" cellspacing="0">	
	<tr>			
			<th width='425px'>		<?php echo $this->Paginator->sort('question_name'); ?>		</th>
			<th width='185px'>		<?php echo $this->Paginator->sort('category_id'); ?>		</th>		
			<th class="headings">	<?php echo __('Actions'); ?>								</th>
	</tr>
	<?php foreach ($questions as $question): ?>
	<tr >
		<td title='<?php echo $question['Question']['question_name']?>' class='wrapped_td'> 
			<div class='td_span'>
				<?php 
					echo substr ( $question['Question']['question_name'], 0, 150 );
					if ( strlen( $question['Question']['question_name'] ) >= 150 ) 
						echo ". . . . .";
				?>
			</div>
		</td>		
		<td>
			<?php
				$cats_array = array();			
				foreach ( $question['Category'] as $key=>$row ){
					$cats_array[] = $row['category_name'];
				}
				$categories = implode (', ',$cats_array);				
				echo "<div class='td_span' title=$categories >". substr ($categories, 0, 20); 
				if ( strlen( $categories) >= 20 ) echo ". . . </div>";
					else "</div>";
			?>
		</td>
		<td>
			<span class='black_box'>	
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $question['Question']['question_id'])); ?>
			</span>			
			<span class='black_box'>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $question['Question']['question_id']), null, __('Are you sure, you want to delete this question.', $question['Question']['question_id'])); ?>
			</span>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	
	<div class="paging">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => ''));
			echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
	
</div>

