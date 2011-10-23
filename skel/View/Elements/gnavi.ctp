<ul class="nav">
	<li class="active">
		<?php echo $this->Html->link('Home','/');?>
	</li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle">Mene1</a>
		<?php
		echo $this->Html->nestedList(
						array(
						$this->Html->link('Chile1',array('controller'=>'pages','action'=>'home')),
						$this->Html->link('Chile2',array('controller'=>'pages','action'=>'home')),
						$this->Html->link('Chile3',array('controller'=>'pages','action'=>'home')),
						),
				array('class'=>'dropdown-menu')
			);
		?>
	</li>
	<li>
		<?php echo $this->Html->link('Mene2',array('controller'=>'pages','action'=>'home'));?>
	</li>

</ul>
