<h2 class="modulo">PADRON DE BENEFICIARIOS</h2>
<div id="datos-beneficiario-padron">
BENEFICIO #<?php echo $beneficiario['Beneficiario']['id']?> 
<?php if($beneficiario['Beneficiario']['estado'] == 1):?>
	<span style="color: green;font-size: 12px; font-weight: normal;">* VIGENTE *</span>
<?php else:?>
	<span style="color: red;font-size: 12px; font-weight: normal">* NO VIGENTE (<?php echo $util->armaFecha($beneficiario['Beneficiario']['fecha_baja'])?>) *</span>
<?php endif;?>
| TITULAR: <?//php echo $beneficiario['Persona']['tdocndoc']?> <?//php echo $beneficiario['Persona']['apenom']?>
<?php echo $html->link($beneficiario['Persona']['tdocndoc']." - ".$beneficiario['Persona']['apenom'],'/personas/ficha/' . $beneficiario['Persona']['id'],array('target' => '_blank'))?>
</div>
<?php echo $this->renderElement('maquetado/menu_padron_beneficiario')?>