<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<?php echo $controles->botonGenerico('ficha/'.$beneficiario['Beneficiario']['persona_id'].'/1','controles/printer.png','IMPRIMIR FICHA',array('target' => 'blank'));?>
<?php echo $this->renderElement('beneficiarios/ficha_datos_titular',array('beneficiario' => $beneficiario))?>
<?php echo $controles->botonGenerico('ficha/'.$beneficiario['Beneficiario']['persona_id'].'/1','controles/printer.png','IMPRIMIR FICHA',array('target' => 'blank'));?>

