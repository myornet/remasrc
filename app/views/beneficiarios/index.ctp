<h2 class="title">PADRON DE BENEFICIARIOS</h2>
<?php echo $this->renderElement('beneficiarios/busqueda')?>
<?php if(!empty($beneficiarios))echo $this->renderElement('beneficiarios/resultados_busqueda',array('beneficiarios'=>$beneficiarios))?>
