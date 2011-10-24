<!DOCTYPE html>
<html lang="ja">
  <head>
	<?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js');
		echo $this->Html->script('bootstrap-dropdown');
		echo $this->Html->script('bootstrap-alerts');
		echo $scripts_for_layout;
	?>
    <!-- Le styles -->
    <style type="text/css">
      body {
        padding-top: 50px;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

	<script type="text/javascript">
	$(function(){
		$(".alert-message").alert();
		$(".alert-message").alert('close');
	});
	</script>
</head>

<body>
    <div class="topbar" data-dropdown="dropdown" >
      <div class="topbar-inner">
        <div class="container-fluid">
          <?php echo $this->Html->link('Your Site Name', '/',array('class'=>'brand')); ?>
		  <?php echo $this->element('gnavi');?>
          <div class="pull-right">
			  <?php echo $this->Element('user_menu');?>
		  </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
		<?php
		echo $this->Html->getCrumbList(array('id'=>'breadcrumb'));
		?>
		  <?php echo $this->Session->flash(); ?>
		  <?php echo $content_for_layout; ?>
    </div>
	<footer class="footer">
	  <p>&copy; Company 2011</p>
	</footer>
	<?php echo $this->element('sql_dump'); ?>
  </body>
</html>
