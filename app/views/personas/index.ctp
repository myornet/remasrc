<h2 class="title">PADRON DE BENEFICIARIOS</h2>
<?php echo $this->renderElement('personas/busqueda')?>
<?php if(!empty($personas))echo $this->renderElement('personas/resultados_busqueda',array('personas'=>$personas))?>
