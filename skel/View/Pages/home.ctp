<div class="hero-unit">
<iframe src="http://cakephp.org/bake-banner" width="830" height="160" style="overflow:hidden; border:none;">
	<p>For updates and important announcements, visit http://cakefest.org</p>
</iframe>
<h2>Sweet, "Test" got Baked by CakePHP!</h2>

<?php
App::uses('Debugger', 'Utility');
if (Configure::read() > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<p>
<?php 
	if (version_compare(PHP_VERSION, '5.2.6', '>=')):
		echo '<div class="alert-message success">';
			echo __d('cake_dev', 'Your version of PHP is 5.2.6 or higher.');
		echo '</div>';
	else:
		echo '<div class="alert-message error">';
			echo __d('cake_dev', 'Your version of PHP is too low. You need PHP 5.2.6 or higher to use CakePHP.');
		echo '</div>';
	endif;
?>
</p>
<p>
<?php
	if (is_writable(TMP)):
		echo '<div class="alert-message success">';
			echo __d('cake_dev', 'Your tmp directory is writable.');
		echo '</div>';
	else:
		echo '<div class="alert-message warning">';
			echo __d('cake_dev', 'Your tmp directory is NOT writable.');
		echo '</div>';
	endif;
?>
</p>
<p>
<?php
	$settings = Cache::settings();
	if (!empty($settings)):
		echo '<div class="alert-message success">';
				echo __d('cake_dev', 'The %s is being used for caching. To change the config edit APP/Config/core.php ', '<em>'. $settings['engine'] . 'Engine</em>');
		echo '</div>';
	else:
		echo '<div class="alert-message">';
			echo __d('cake_dev', 'Your cache is NOT working. Please check the settings in APP/Config/core.php');
		echo '</div>';
	endif;
?>
</p>
<p>
<?php
	$filePresent = null;
	if (file_exists(APP . 'Config' . DS . 'database.php')):
		echo '<div class="alert-message success">';
			echo __d('cake_dev', 'Your database configuration file is present.');
			$filePresent = true;
		echo '</div>';
	else:
		echo '<div class="alert-message">';
			echo __d('cake_dev', 'Your database configuration file is NOT present.');
			echo '<br/>';
			echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
		echo '</div>';
	endif;
?>
</p>
<?php
if (isset($filePresent)):
	App::uses('ConnectionManager', 'Model');
	try {
		$connected = ConnectionManager::getDataSource('default');
	} catch (Exception $e) {
		$connected = false;
	}
?>
<p>
	<?php
		if ($connected && $connected->isConnected()):
			echo '<div class="alert-message success">';
	 			echo __d('cake_dev', 'Cake is able to connect to the database.');
			echo '</div>';
		else:
			echo '<div class="alert-message">';
				echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
			echo '</div>';
		endif;
	?>
</p>
<?php endif;?>
<?php
	App::uses('Validation', 'Utility');
	if (!Validation::alphaNumeric('cakephp')) {
		echo '<p><div class="alert-message">';
		__d('cake_dev', 'PCRE has not been compiled with Unicode support.');
		echo '<br/>';
		__d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
		echo '</div></p>';
	}
?>
<h3><?php echo __d('cake_dev', 'Editing this Page') ?></h3>
<div class="alert-message block-message info">
<?php
	echo __d('cake_dev', 'To change the content of this page, edit: %s
		To change its layout, edit: %s
		You can also add some CSS styles for your pages at: %s',
		APP . 'View' . DS . 'Pages' . DS . 'home.ctp.<br />',  APP . 'View' . DS . 'Layouts' . DS . 'default.ctp.<br />', APP . 'webroot' . DS . 'css');
?>
</div>
</div>
