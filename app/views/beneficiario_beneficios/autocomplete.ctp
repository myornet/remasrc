<?//php debug($productos)?>
<ul>
	<?php foreach($productos as $producto):?>
		<li id="<?php echo $producto['GlobalDato']['id']?>"><?php echo $producto['GlobalDato']['concepto_1']?></li>
	<?php endforeach;?>
</ul>