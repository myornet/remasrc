<?php if(!empty($beneficiarios)):?>

<ul>
	<?php foreach($beneficiarios as $beneficiario):?>
	
		<?php 
			$str = "";
			$str .= "BENEF. #" . $beneficiario['Beneficiario']['id'];
			$str .= " | TITULAR: " .$util->globalDato($beneficiario['Persona']['tipo_documento']);
			$str .= " " . $beneficiario['Persona']['documento'];
			$str .= " - <strong>" . $beneficiario['Persona']['apellido']."</strong>, ".$beneficiario['Persona']['nombre'];
			
		
		?>
	
		<li id="<?php echo $beneficiario['Beneficiario']['id']?>"><?php echo $str?></li>
	<?php endforeach;?>
</ul>
<?php endif;?>