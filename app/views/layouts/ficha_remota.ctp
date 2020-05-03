<?
header ("Cache-Control: no-cache, must-revalidate");
ob_start();
?>
<?php echo $html->docType(); ?>

<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo Configure::read('APLICACION.app_soft') ." " . Configure::read('APLICACION.app_version')?></title>
	<?php
		echo $html->charset();
		echo $html->meta('icon');
		echo $html->css('remas');
	?>
</head>
<body>
	<div id="container">
		<div class="main">
		<?php Configure::write("debug",0)?>
		<?php echo $content_for_layout ?>
		</div>
		<div class="foot"><?php echo $this->renderElement('maquetado/footer')?></div>
	</div>
</body>