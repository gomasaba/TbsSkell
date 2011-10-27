<div class="sidebar">
	<div class="well">
	<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
<?php
echo " <?php echo \$this->Html->nestedList(
	array(
		\$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'),array('class'=>'btn')),"
?>
<?php
$done = array();
foreach ($associations as $type => $data) {
	foreach ($data as $alias => $details) {
		if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
			echo "\$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'),array('class'=>'btn')),\n";
			echo "\$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'),array('class'=>'btn')),\n";
			$done[] = $details['controller'];
		}
	}
}
?>
<?php echo "),array('class'=>'btns')); ?>"?>
	</div>
</div>

<div class="content">
<div class="<?php echo $pluralVar;?> index">
	<div class="page-header">
	<h2><?php echo "<?php echo __('{$pluralHumanName}');?>";?></h2>
	</div>

	<?php echo "<?php echo \$this->Element('paginate');?>";?>
	
	<table class="zebra-striped">
	<?php
	echo "<?php  echo \$this->Html->tableHeaders(array(\n";
	?>
	<?php
	foreach ($fields as $key=>$field){
		echo "\t\t\t\t\$this->Paginator->sort('{$field}'),\n";
	}?>
	<?php echo "\t\t\t\t__('Actions')\n";?>
	<?php
	echo ")); ?>";
	?>
	
	<?php
	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	?>
	<?php
		echo "<?php \n\t\techo \$this->Html->tableCells(array(\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])),\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "h(\${$singularVar}['{$modelClass}']['{$field}']),\n";
			}
		}
		echo "\t\t\t\t\$this->Html->nestedList(array(\n";
		echo "\t\t\t\t\$this->Html->link(__('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn')),\n";
		echo "\t\t\t\t\$this->Html->link(__('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn')),\n";
		echo "\t\t\t\t\$this->Form->postLink(__('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])),\n";
		echo "\t\t),array('class'=>'btns'))";
		echo "));\n?>\n";
	?>
	<?php
	echo "<?php endforeach; ?>\n";
	?>
	</table>

	<?php echo "<?php echo \$this->Element('paginate');?>";?>
</div>
</div>
