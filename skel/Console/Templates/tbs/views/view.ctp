<div class="sidebar">
	<div class="well">
<?php
echo " <?php echo \$this->Html->nestedList(
	array(
		\$this->Html->link(__('Edit " . $singularHumanName ."'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'btn')),
		\$this->Form->postLink(__('Delete " . $singularHumanName . "'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'btn danger'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])),
		\$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index'),array('class'=>'btn')),
		\$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'),array('class'=>'btn'))
)); ?>"
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
				)
				); ?>";
				$done[] = $details['controller'];
			}
		}
	}
?>

<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
	<div class="related">
		<h3><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "');?>";?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
		<dl>
	<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "');?></dt>\n";
				echo "\t\t<dd>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}'];?>\n&nbsp;</dd>\n";
			}
	?>
		</dl>
	<?php echo "<?php endif; ?>\n";?>
		<div class="actions">
			<ul>
				<li><?php echo "<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n";?>
			</ul>
		</div>
	</div>
	<?php
	endforeach;
endif;
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
<div class="related">
	<h3><?php echo "<?php echo __('Related " . $otherPluralHumanName . "');?>";?></h3>
	<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])):?>\n";?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
<?php
			foreach ($details['fields'] as $field) {
				echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
			}
?>
		<th class="actions"><?php echo "<?php echo __('Actions');?>";?></th>
	</tr>
<?php
echo "\t<?php
		\$i = 0;
		foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
		echo "\t\t<tr>\n";
			foreach ($details['fields'] as $field) {
				echo "\t\t\t<td><?php echo \${$otherSingularVar}['{$field}'];?></td>\n";
			}

			echo "\t\t\t<td class=\"actions\">\n";
			echo "\t\t\t\t<?php echo \$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t<?php echo \$this->Html->link(__('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), null, __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
			echo "\t\t\t</td>\n";
		echo "\t\t</tr>\n";

echo "\t<?php endforeach; ?>\n";
?>
	</table>
<?php echo "<?php endif; ?>\n\n";?>
	<div class="actions">
		<ul>
			<li><?php echo "<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'));?>";?> </li>
		</ul>
	</div>
</div>
<?php endforeach;?>
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

</div>
