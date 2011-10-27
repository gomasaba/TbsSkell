<ul class="nav">
	<li class="active">
		<?php echo $this->Html->link('Home','/');?>
	</li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle">menu1</a>
		<?php
		echo $this->Html->nestedList(
						array(
						$this->Html->link('child1',array('controller'=>'pages','action'=>'home')),
						$this->Html->link('child2',array('controller'=>'pages','action'=>'home')),
						$this->Html->link('child3',array('controller'=>'pages','action'=>'home')),
						),
				array('class'=>'dropdown-menu')
			);
		?>
	</li>
	<li>
		<?php echo $this->Html->link('menu2',array('controller'=>'pages','action'=>'home'));?>
	</li>

</ul>
