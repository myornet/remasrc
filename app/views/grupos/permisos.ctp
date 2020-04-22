
<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE PERMISOS - <?php echo $grupo['Grupo']['nombre']?></h2>
<?php echo $frm->create(null,array('action' => 'permisos/'.$grupo['Grupo']['id']));?>
<?//php debug($menuNav)?>
<table>
	<tr>
		<th>#</th>
		<th colspan="3">OPCION DE MENU</th>
		
	</tr>
	<?php foreach($menuNav as $idx => $menu):?>
		<tr class="rowsel">
			<td><strong><?php echo $idx?></strong></td>
			<td colspan="2"><strong><?php echo $menu['label']?></strong></td>
			<td><input type="checkbox" name="data[Permiso][<?php echo $idx?>]" value="<?php echo $menu['url']?>" <?php echo(in_array($idx,$permisosAsignados) ? "checked = 'checked' ":"")?>/></td>
		</tr>
		<?php foreach($menu['menu'] as $sm => $smenu):?>
			
			<tr>
				<td></td>
				<td colspan="2"><strong><?php echo $sm." - ".$smenu['label']?></strong></td>
				<td><input type="checkbox" name="data[Permiso][<?php echo $sm?>]" value="<?php echo $smenu['url']?>" <?php echo(in_array($sm,$permisosAsignados) ? "checked = 'checked' ":"")?>/></td>
			</tr>
			
			<?php if(isset($smenu['metodos_controller'])):?>
			
				<?php foreach($smenu['metodos_controller'] as $key => $controller):?>
					<tr>
						<td></td>
						<td></td>
						<td><?php echo $controller[1]?></td>
						<td style="text-align: center;"><input type="checkbox" name="data[Permiso][<?php echo $key?>]" value="<?php echo '/'.$smenu['controller'].'/'.$controller[0]?>"  <?php echo(in_array($key,$permisosAsignados) ? "checked = 'checked' ":"")?>/></td>
					</tr>			
				<?//php debug($controller)?>
				
				<?php endforeach;?>
			<?php endif;?>
		<?php endforeach;?>

	<?php endforeach;?>
</table>
<?php echo $frm->hidden('grupo_id',array('value' => $grupo['Grupo']['id']))?>
<?php echo $frm->btnGuardarCancelar(array('URL' => '/grupos'))?>

