<nav class="pagination is-small is-right" role="navigation" aria-label="pagination">
	<div class="pagination-ellipsis">
	<?php $paginator->options(array('url' => $this->passedArgs));?>
	<?php
		echo $paginator->counter(array(
		'format' => __('Hoja %page% de %pages%', true)
		));
	?>
	</div>
	
	<?php echo $paginator->prev(__('anterior', true), array('class'=>'pagination-previous'), null, array('class'=>'pagination-previous','disabled'=>'disabled'));?>
	<?php echo $paginator->next(__('siguiente', true), array('class'=>'pagination-next'), null, array('class'=>'pagination-next','disabled'=>'disabled'));?>

	<ul class="pagination-list">
		<?php echo $paginator->numbers();?>
	</ul>
</nav>