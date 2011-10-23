<div class="<?php echo $pluralVar;?> form">
<table>
<?php echo "<?php echo \$this->Form->create('{$modelClass}');?>\n";?>
<?php
echo "\t<?php\n";
foreach ($fields as $field) {
	if (strpos($action, 'add') !== false && $field == $primaryKey) {
		continue;
	} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
		echo "
			echo \$this->Html->tableCells(array(
			array(
				array(\$this->Html->tag('div','{$field}',array('class'=>'head')),
				array(
					\$this->Form->input('{$field}',array(
						'label'=>false,
						'class'=>'span7',
						'error'=>false,
					),array('escape'=>false)) .
					\$this->Form->error('{$field}',null,array('wrap'=>'div','class'=>'error')),
					array('class'=>'clearfix')
				),
			),
		));			
		";
	}
}
if (!empty($associations['hasAndBelongsToMany'])) {
	foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
		echo "
			echo \$this->Html->tableCells(array(
			array(
				array(\$this->Html->tag('div','{$assocName}',array('class'=>'head')),
				array(
					\$this->Form->input('{$assocName}',array(
						'label'=>false,
						'class'=>'span7',
						'error'=>false,
					),array('escape'=>false)) .
					\$this->Form->error('{$assocName}',null,array('wrap'=>'div','class'=>'error')),
					array('class'=>'clearfix')
				),
			),
		));			
		";
	}
}
echo "\t?>\n";
?>
	
<?php
	echo "<?php echo \$this->Form->end(__('Submit'));?>\n";
?>
</table>
	
	
</div>
