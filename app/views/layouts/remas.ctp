<?php 
header ("Cache-Control: no-cache, must-revalidate");
ob_start();
?>
<?php echo $html->docType(); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo Configure::read('APLICACION.app_soft') ." " . Configure::read('APLICACION.app_version')?></title>
	<?php
		echo $html->charset();
		echo $html->meta('icon');
		echo $html->css('remas');
		echo $javascript->link('prototype_1_6_1');		
		echo $javascript->link('funciones');
	?>
	<script type="text/javascript">
		Event.observe(window, 'load', function() {$('mensaje_error_js').hide();});
	</script>		
</head>
<body>
	<div id="container">
		<div class="top"><?php echo $this->renderElement('maquetado/head')?></div>
		<div class="datosUser"><?php echo $this->renderElement('maquetado/user')?></div>
		<div class="menu-container"><?php echo $this->renderElement('maquetado/menu_principal')?></div>
                <div><?php echo $this->renderElement('maquetado/mensajes') ?></div>
		<div class="main">
			<?php echo $content_for_layout ?>
			<div id="mensaje_error_js" class="notices_error"></div>
		</div>
		
		<div class="foot"><?php echo $this->renderElement('maquetado/footer')?><?php echo $this->renderElement('maquetado/install')?></div>
	</div>

</body>
</html>
