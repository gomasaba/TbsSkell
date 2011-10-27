<?php echo $this->Form->create(array('class'=>'form-stacked'));?>

	<?php
		//メールアドレス
		echo $this->Html->tag('div',
			$this->Form->label('email','メールアドレス') .
			$this->Form->input('email',array(
				'label'=>false,
				'class'=>'span5',
				'error'=>false,
			)) .
			$this->Form->error('email',null,array('wrap'=>'span','class'=>'help-inline')),
			array('class'=> ($this->Form->tagIsInvalid()) ? 'input clearfix error' : 'clearfix')
		);
		//パスワード
		echo $this->Html->tag('div',
			$this->Form->label('password','パスワード') .
			$this->Form->input('password',array(
				'label'=>false,
				'class'=>'span5',
				'error'=>false,
			)) .
			$this->Form->error('password',null,array('wrap'=>'span','class'=>'help-inline')),
			array('class'=> ($this->Form->tagIsInvalid()) ? 'input clearfix error' : 'clearfix')
		);

	?>
	<p class="submit">
		<?php echo $this->Form->submit('ログイン',array('class'=>'button-primary'));?>
	</p>
<?php echo $this->Form->end();?>
