<?php
/*　default
	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
 *
 */
?>

<div class="pagination">
	<ul>
<?php
	echo $this->Paginator->prev('< ' . __('previous'),
					array('tag'=>'li'),
					'<a href="#">Prev</a>',
					array('tag'=>'li','class'=>'prev disabled','escape'=>false));
	$option = array(
		'tag'=>'li',
		'separator'=>null
	);
	echo $this->Paginator->numbers($option);
	echo $this->Paginator->next(__('next') . ' >',
					array('tag'=>'li'),
					'<a href="#">next</a>',
					array('tag'=>'li','class'=>'next disabled','escape'=>false));
?>
	</ul>
</div>