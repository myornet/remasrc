<?php 
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
		echo $javascript->link('prototype_1_6_1');		
		echo $javascript->link('funciones');
	?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
	<script defer src="https://use.fontawesome.com/releases/v5.10.1/js/all.js"></script>
	<script type="text/javascript">
		Event.observe(window, 'load', function() {$('mensaje_error_js').hide();});
	</script>		
</head>
<body>
	<div id="container">
		<!-- Nombre del sistema -->
		<div class="notification is-marginless">
			<?php echo $this->renderElement('maquetado/head')?>	
		</div>

		<!-- Mensajes de alerta -->
		<?php echo $this->renderElement('maquetado/mensajes') ?>
		<!-- <div id="mensaje_error_js" class="notification is-marginless is-danger"></div> -->
		
		<!-- Navegación principal -->
		<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
			<div class="navbar-brand">
				<a class="navbar-item" href="/personas">
				<?php echo $html->image('logos/logo-32x32.png')?>
				</a>

				<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
				<span aria-hidden="true"></span>
				</a>
			</div>

			<div id="navbarBasicExample" class="navbar-menu">
				<div class="navbar-start">
					<?php echo $this->renderElement('maquetado/menu_principal')?>
				</div>

				<div class="navbar-end">
					<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
						Usuario
						</a>

						<div class="navbar-dropdown is-right">
							<?php echo $this->renderElement('maquetado/user')?>
						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Contenido de la aplicación -->
		<div class="main container">
			<div class="content">
			<?php echo $content_for_layout ?>
			</div>
		</div>
		
		<!-- Footer -->
		<footer class="footer">
			<?php echo $this->renderElement('maquetado/footer')?><?php echo $this->renderElement('maquetado/install')?>
		</footer>
	</div>

</body>
</html>
