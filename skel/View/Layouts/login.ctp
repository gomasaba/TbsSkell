<!DOCTYPE html>
<html lang="ja">
  <head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->meta('icon');
		echo $this->Html->css('login');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js');
		echo $this->Html->script('bootstrap-alerts');
		echo $scripts_for_layout;
	?>
	<script type="text/javascript">
	$(function(){
		$(".alert-message").alert();
		$(".alert-message").alert('close');
	});
	</script>
</head>
<body class="login">
<div id="login">
	<h1>ログイン</h1>
	<?php echo $this->Session->flash(); ?>
	<?php echo $content_for_layout; ?>


</div>
<!-- p id="backtoblog"><a href="/">&larr; へ戻る</a></p -->
	<?php echo $this->element('sql_dump'); ?>

</body>
</html>