<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>UNIFICAR BENEFICIO</h2>

<script type="text/javascript">
Event.observe(window, 'load', function(){
	$("beneficioIncorpora_2").hide();
	$("beneficioIncorpora_3").hide();
});
function validateForm(){
	var newBeneficio = $("BeneficiarioAdicionalBeneficiarioAproxima").getValue();
	if(newBeneficio == ""){
		alert("DEBE INDICAR LA PERSONA TITULAR DEL BENEFICIO AL CUAL SE UNIFICARA EL PRESENTE.");
		return false;
	}
	if($("BeneficiarioNuevoBeneficiarioId").getValue() == "" || $("BeneficiarioNuevoBeneficiarioId").getValue() == 0){
		alert("DEBE SELECCIONAR LA PERSONA TITULAR DEL BENEFICIO AL CUAL SE UNIFICARA EL PRESENTE.");
		return false;		
	}	
	var str = "***** ATENCION: ******\n\n";
	str = str + "UNIFICAR EL BENEFICIO ACTUAL CON:\n";
	str = str + newBeneficio + "\n\n";
	str = str + "TODOS LOS INTEGRANTES SERAN INCORPORADOS COMO ADICIONALES \n Y EL PRESENTE BENEFICIO SERA ELIMINADO\n\n";
	str = str + "DESEA CONTINUAR?";
	return confirm(str);
}
</script>

<?php echo $frm->create(null,array('action' => 'unificar/' . $beneficiario_id,'onsubmit' => "return validateForm()"));?>

<div class="areaDatoForm">
	<table class="tbl_form">
		<tr id="beneficioIncorpora_1">
			<td>TITULAR DEL BENEFICIO</td>
			<td>
				<?php 
				echo $javascript->link('scriptaculous');
				echo $javascript->link('scriptaculous.js?load=effects');
				?>
				
				<input name="data[BeneficiarioAdicional][beneficiarioAproxima]" type="text" size="50" maxlenght="100" value="" id="BeneficiarioAdicionalBeneficiarioAproxima" />
				<div id="BeneficiarioBeneficiario_autoComplete" class="auto_complete"></div>
				<span id="ajax_loader_beneficiarios" style="display: none;font-size: 11px;font-style:italic;color:red;">
				Procesando...<?php echo $html->image('controles/red_animated.gif') ?>
				</span>	
				<?php echo $frm->hidden('Beneficiario.nuevo_beneficiario_id'); ?>
				<script type="text/javascript">
				
				//<![CDATA[
					Event.observe(window, 'load', function() {
						document.getElementById("BeneficiarioNuevoBeneficiarioId").value = "";
						document.getElementById("beneficiarioSelected").value = "";
						$("beneficiarioSelected").hide();
					});
					
					new Ajax.Autocompleter('BeneficiarioAdicionalBeneficiarioAproxima', 'BeneficiarioBeneficiario_autoComplete', '<?php echo $this->base?>/beneficiarios/autocomplete', {minChars:2, afterUpdateElement:getSelectionId0, indicator:'ajax_loader_beneficiarios'});
					function getSelectionId0(text, li){
						var id = li.id;
						$("beneficiarioSelected").update(text.value);
						document.getElementById("BeneficiarioNuevoBeneficiarioId").value = id;
						$("beneficioIncorpora_2").show();
						$("beneficiarioSelected").show();
						$("beneficioIncorpora_3").show();
					}    
				//]]>           
				</script>
			</td>
		</tr>
		<tr id="beneficioIncorpora_2">
			<td>INCORPORAR AL BENEFICIO</td>
			<td><span id="beneficiarioSelected" style="background-color: gray;padding: 5px;color: white;"></span></td>
		</tr>		
		<tr id="beneficioIncorpora_3">
			<td>PARENTEZCO DEL TITULAR</td>
			<td><?php echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSPARE','empty' => false,'model' => 'Beneficiario.tipo_parentezco'));?></td>
		</tr>
	
	
	</table>


</div>
<?php echo $frm->hidden('beneficiario_id_actual',array('value' => $beneficiario_id))?>
<?php if($user['Usuario']['perfil'] == 3) echo $frm->end("UNIFICAR BENEFICIO");?>