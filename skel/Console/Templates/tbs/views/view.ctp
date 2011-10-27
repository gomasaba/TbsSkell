<div class="sidebar">
	<div class="well">
<?php
echo " <?php echo \$this->Html->nestedList(
	array(
		\$this->Html->link(__('Edit " . $singularHumanName ."'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn')),
		\$this->Form->postLink(__('Delete " . $singularHumanName . "'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'btn danger'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])),
		\$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index'),array('class'=>'btn')),
		\$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'),array('class'=>'btn'))
),array('class'=>'btns')); ?>"
?>
<?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
				echo "<?php echo \$this->Html->nestedList(
				array(
					\$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'),array('class'=>'btn')),
					\$this->Html->link(__('New " .  Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'),array('class'=>'btn'))
				),array('class'=>'btns')
				); ?>";
				$done[] = $details['controller'];
			}
		}
	}
?>

	</div>

</div>


<div class="content">
	
<div class="page-header">
<h2><?php echo "<?php  echo __('{$singularHumanName}');?>";?></h2>
</div>

<table>
<?php
echo "<?php echo \$this->Html->tableHeaders(array(__('HEAD'),__('CONTENTS'))); ?>\n";
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "<?php
					echo \$this->Html->tableCells(array(
						array(
							array(__('" . Inflector::humanize(Inflector::underscore($alias)) . "'),array('class'=>'head')),
							\$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])),
						),
					));?>
				";
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "<?php
			echo \$this->Html->tableCells(array(
				array(
					array(__('" . Inflector::humanize($field) . "'),array('class'=>'head')),
					h(\${$singularVar}['{$modelClass}']['{$field}']),
				),
			));?>
		";
	}
}
?>
</table>
<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div class="page-header">
		<h3><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "');?>";?></h3>
	</div>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
	
	<?php
			foreach ($details['fields'] as $field) {
				echo "<?php
					echo \$this->Html->tableCells(array(
						array(
							array(__('" . Inflector::humanize($field) . "'),array('class'=>'head')),
							\${$singularVar}['{$alias}']['{$field}'],
						),
					));?>
				";
			}
	?>
	<?php echo "<?php endif; ?>\n";?>
		<div class="actions">
			<ul>
				<li><?php echo "<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n";?>
			</ul>
		</div>
	<?php
	endforeach;
endif;
?>

	
<?php
if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
$i = 0;
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
	?>
<div class="page-header">
	<h3><?php echo "<?php echo __('Related " . $otherPluralHumanName . "');?>";?></h3>
</div>
	
<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
<div class="related">
	<table>
<?php echo "<?php echo \$this->Html->tableHeaders(array(\n";
		foreach ($details['fields'] as $field) {
			echo "'".Inflector::humanize($field)."',\n";
		}
		echo "\t\t\t\t__('Actions')\n";
		echo "));?>\n";
		echo "\t<?php foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}){\n";
		echo "\t\techo \$this->Html->tableCells(array(\n";
			foreach ($details['fields'] as $field) {
				echo "\t\t\t\${$otherSingularVar}['{$field}'],\n";
			}
			echo "\t\t\t\$this->Html->nestedList(array(\n";
			echo "\t\t\t\t\$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']),array('class'=>'btn')),\n";
			echo "\t\t\t\t\$this->Html->link(__('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}']),array('class'=>'btn')),\n";
			echo "\t\t\t\t\$this->Form->postLink(__('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']),array('class'=>'btn'), __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}']))\n";
			echo "\t\t\t)),\n";
		echo "\t\t),array('class'=>'btns'));\n\t} ?>\n";
?>
	</table>
</div>
<?php echo "<?php endif; ?>\n";?>
<?php endforeach;?>
	</div>	
	
	
	
</div>
