<div class="sidebar">
	<div class="well">
	<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
<?php echo " <?php echo \$this->Html->nestedList(array(\n"?>
<?php if (strpos($action, 'add') === false): ?>
	<?php echo "\$this->Form->postLink(__('Delete'), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')),array('class'=>'btn danger'), __('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))),\n";?>
<?php endif;?>	
<?php echo "\$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index'),array('class'=>'btn')),\n"?>
<?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "\t\t\$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'),array('class'=>'btn')),\n";
				echo "\t\t\$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'),array('class'=>'btn')),\n";
				$done[] = $details['controller'];
			}
		}
	}
?>
<?php echo "),array('class'=>'btns'));\n?>"?>
	
	</div>
</div>
<div class="content">
	
	<div class="<?php echo $pluralVar;?> form">

	<div class="page-header">
		<h3><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h3>
	</div>
	
	<?php echo "<?php echo \$this->Form->create('{$modelClass}');?>\n";?>
	<table>
	<?php
	echo "\t<?php\n";
	foreach ($fields as $field) {
		if (strpos($action, 'add') !== false && $field == $primaryKey) {
			continue;
		} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
			echo "
				echo \$this->Html->tableCells(array(
				array(
					array('{$field}',array('class'=>'head')),
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
					array('{$assocName}',array('class'=>'head')),
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
	</table>

	<?php echo "<?php echo \$this->Form->submit('送信',array('class'=>'btn primary','div'=>false));?>" ?>

	<?php
		echo "<?php echo \$this->Form->end();?>\n";
	?>

	</div>
</div>
