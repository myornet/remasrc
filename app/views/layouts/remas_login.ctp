<?php 
//header ("Cache-Control: no-cache, must-revalidate");
//ob_start();
?>
<?php echo $html->docType(); ?>

<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo Configure::read('APLICACION.app_soft') ." " . Configure::read('APLICACION.app_version')?></title>
	<?php
		echo $html->meta('icon');
		echo $html->css('remas');
		echo $javascript->link('prototype_1_6_1');
	?>	
</head>
<body>
	<div id="login-container">
		<div id="login-header">
			<div class="remas">RE.M.A.S.</div>
			<div class="remas2">Registro Municipal de Autogesti&oacute;n Social</div>
		</div>
		<div id="login-form">
			<?php echo $content_for_layout ?>
			<?
				if ($session->check('Message.auth') && !$session->flash('auth')):
					echo "<div class='notices_error'>";
			 		$session->flash('auth'); 
			 		echo "</div>";
				endif;
			 ?>				
		</div>
		<div id="login-foot"><?php echo $this->renderElement('maquetado/footer')?><?php echo $this->renderElement('maquetado/install')?></div>
	</div>
	
</body>
</html>
