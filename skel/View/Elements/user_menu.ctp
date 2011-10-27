<ul class="nav secondary-nav">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle">
		<span style="padding-right: 10px;">logined user </span><?php //echo AuthComponent::user('name');?>
		</a>
		<?php
		echo $this->Html->nestedList(
						array(
						$this->Html->link('ログアウト',array('controller'=>'users','action'=>'logout')),
						),
				array('class'=>'dropdown-menu')
			);
		?>
	</li>
</ul>
