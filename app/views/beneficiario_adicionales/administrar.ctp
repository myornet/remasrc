<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>GRUPO FAMILIAR :: ADMINISTRACION DE MIEMBROS DEL GRUPO FAMILIAR</h2>

<script type="text/javascript">

	Event.observe(window, 'load', function(){
		if($('BeneficiarioAdicionalAccion').getValue() == 5){
			$("beneficioIncorpora_1").show();
			$("beneficioIncorpora_2").show();
			$("beneficioIncorpora_3").show();
		}else{
			$("beneficioIncorpora_1").hide();
			$("beneficioIncorpora_2").hide();
			$("beneficioIncorpora_3").hide();
		}	
		$('BeneficiarioAdicionalAccion').observe('change',function(){
			if($('BeneficiarioAdicionalAccion').getValue() == 5){
				$("beneficioIncorpora_1").show();
				$("beneficioIncorpora_2").show();
				$("beneficioIncorpora_3").show();
			}else{
				$("beneficioIncorpora_1").hide();
				$("beneficioIncorpora_2").hide();
				$("beneficioIncorpora_3").hide();
			}
		});
		
	});

	function validateForm(){

		if($('BeneficiarioAdicionalAccion').getValue() == 5){
			var newBeneficioId = $("BeneficiarioAdicionalNuevoBeneficiarioId").getValue();
			if(newBeneficioId == ""){
				alert("INDICAR A QUE BENEFICIO SE INCORPORA!");
				return false;
			}
		}
		
		var adicional = getTextoSelect("BeneficiarioAdicionalId");
		var accion = getTextoSelect("BeneficiarioAdicionalAccion");
		var fechaAccion = getStrFecha("BeneficiarioAdicionalFechaAccion");
		var str = "***** ATENCION: ******\n\n";
		str = str + "SE GENERARA EL SIGUIENTE EVENTO:\n\n";
		str = str + accion + "\n\n";
		str = str + adicional + "\n\n";
		str = str + "FECHA: " + fechaAccion + "\n\n";
		str = str + "DESEA CONTINUAR?";
		return confirm(str);
	}

</script>

<div class="areaDatoForm">	
	<?php echo $frm->create(null,array('action' => 'administrar/'.$beneficiario_id,'onsubmit' => "return validateForm();"));?>
	<table class="tbl_form">
		<tr>
			<td>INTEGRANTE</td>
			<td><?php echo $frm->input('BeneficiarioAdicional.id',array('type' => 'select', 'options' => $adicionales))?></td>
		</tr>
		<tr>
			<td>ACCION</td>
			<td><?php echo $frm->input('BeneficiarioAdicional.accion',array('type' => 'select', 'options' => $acciones))?></td>
		</tr>
		
		<tr id="beneficioIncorpora_1">
			<td>TITULAR</td>
			<td>
				<?php 
				echo $javascript->link('scriptaculous');
				echo $javascript->link('scriptaculous.js?load=effects');
				?>
				
				<input name="data[BeneficiarioAdicional][beneficiarioAproxima]" type="text" size="50" maxlenght="100" value="" id="BeneficiarioAdicionalBeneficiarioAproxima" />
				<div id="BeneficiarioAdicionalBeneficiario_autoComplete" class="auto_complete"></div>
				<span id="ajax_loader_beneficiarios" style="display: none;font-size: 11px;font-style:italic;color:red;">
				Procesando...<?php echo $html->image('controles/red_animated.gif') ?>
				</span>	
				<?php echo $frm->hidden('BeneficiarioAdicional.nuevo_beneficiario_id'); ?>
				<script type="text/javascript">
				
				//<![CDATA[
					Event.observe(window, 'load', function() {
						document.getElementById("BeneficiarioAdicionalNuevoBeneficiarioId").value = "";
						document.getElementById("beneficiarioSelected").value = "";
						$("beneficiarioSelected").hide();
					});
					
					new Ajax.Autocompleter('BeneficiarioAdicionalBeneficiarioAproxima', 'BeneficiarioAdicionalBeneficiario_autoComplete', '<?php echo $this->base?>/beneficiarios/autocomplete', {minChars:2, afterUpdateElement:getSelectionId0, indicator:'ajax_loader_beneficiarios'});
					function getSelectionId0(text, li){
						var id = li.id;
						$("beneficiarioSelected").update(text.value);
						document.getElementById("BeneficiarioAdicionalNuevoBeneficiarioId").value = id;
						$("beneficiarioSelected").show();
					}    
				//]]>           
				</script>
			</td>
		</tr>
		<tr id="beneficioIncorpora_2">
			<td>BENEF | TITULAR</td>
			<td><span id="beneficiarioSelected" style="background-color: gray;padding: 5px;color: white;"></span></td>
		</tr>		
		<tr id="beneficioIncorpora_3">
			<td>PARENTEZCO</td>
			<td><?php echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSPARE','empty' => false,'model' => 'BeneficiarioAdicional.tipo_parentezco'));?></td>
		</tr>
			
		<tr>
			<td>FECHA</td>
			<td><?php echo $frm->calendar('BeneficiarioAdicional.fecha_accion',null,date('Y-m-d'),date('Y')-10,date('Y')+1)?></td>
		</tr>	
	</table>
	<?php echo $frm->hidden('beneficiario_id',array('value' => $beneficiario_id));?>
	<?php echo $frm->btnGuardarCancelar(array('URL' => '/beneficiario_adicionales/index/'.$beneficiario_id))?>	
	
</div>	
