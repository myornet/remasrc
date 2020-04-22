<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>REGISTRO DE NOVEDADES</h2>
<div>
<?php if($user['Usuario']['perfil'] > 1 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('nueva_novedad/'.$beneficiario_id,'controles/note.png','AGREGAR NUEVA NOVEDAD');?>
</div>

<?php if(!empty($novedades)):?>

	<table>
	
		<tr>
			<th></th>
			<th></th>
			<th>FECHA</th>
			<th>USUARIO</th>
			<th>NOVEDAD</th>
			<th></th>
		</tr>
		<?php foreach($novedades as $novedad):?>
		
			<tr>
				<td><?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('borrar_novedad/'.$novedad['BeneficiarioNovedad']['id'],'controles/user-trash.png',null,null,"BORRAR LA NOVEDAD #" . $novedad['BeneficiarioNovedad']['id']."?");?></td>
				<td>#<?php echo $novedad['BeneficiarioNovedad']['id']?></td>
				<td><?php echo $novedad['BeneficiarioNovedad']['fecha']?></td>
				<td><?php echo $novedad['BeneficiarioNovedad']['usuario']?></td>
				<td><?php echo $novedad['BeneficiarioNovedad']['novedad']?></td>
				<td>
					<?php if(!empty($novedad['BeneficiarioNovedad']['adjunto']) && file_exists(WWW_ROOT . 'novedades' . DS .$novedad['BeneficiarioNovedad']['adjunto'])):?>
						<a href="<?php echo $this->base?>/novedades/<?php echo $novedad['BeneficiarioNovedad']['adjunto']?>" target="_blank"><?php echo $html->image('controles/attach3.png',array("border"=>"0",'alt'=>'Ver Adjunto'))?></a>
						
					<?php endif;?>
				</td>
			</tr>
		
		<?php endforeach;?>
	
	</table>

<?php endif;?>