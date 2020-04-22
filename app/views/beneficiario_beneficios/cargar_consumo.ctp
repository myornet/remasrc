<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>NUEVA ORDEN DE CONSUMO</h2>


	<script type="text/javascript">
	Event.observe(window, 'load', function(){

		<?php if($mostrar_detalle == 1):?>
			$("formCabecera").disable();
			$("fechaPermanenteHasta").hide();
			if(document.getElementById("BeneficiarioBeneficioDetallePermanente").checked)$("fechaPermanenteHasta").show();
			else $("fechaPermanenteHasta").hide();
					
			$('BeneficiarioBeneficioDetallePermanente').observe('click',function(){
				$("fechaPermanenteHasta").toggle();
			});			
		<?php endif;?>
	});

	function validateForm(){
		serialize = document.getElementById("BeneficiarioBeneficioDetalleRenglonesSerialize");
		if(serialize == null){
			alert("DEBE CARGAR EL DETALLE DE LA ORDEN!");
			return false;
		}		
		if(confirm("GENERAR LA ORDEN DE CONSUMO?")) return true;
		else return false;
	}
	</script>
<div class="<?php echo ($mostrar_detalle == 0 ? "areaDatoForm" : "areaDatoForm2")?>">
	<?php echo $frm->create(null,array('id' => 'formCabecera','action' => 'cargar_consumo/'.$beneficiario_id));?>

	<table class="tbl_form">
	
		<tr>
			<td>FECHA</td>
			<td><?php echo $frm->calendar('BeneficiarioBeneficio.fecha','',$fechaNovedad,date('Y') - 1,date('Y') + 5)?></td>
			<td><input type="submit" value="CARGAR DETALLE" /></td>
		</tr>	
	</table>
	<?php echo $frm->input('id');?>	
	<?php echo $frm->hidden('beneficiario_id',array('value' => $beneficiario_id));?>
	<?php echo $frm->hidden("BeneficiarioBeneficio.beneficiario_id",array('value' => $beneficiario['Beneficiario']['id']))?>
	<?php echo $frm->hidden("BeneficiarioBeneficio.persona_id",array('value' => $beneficiario['Beneficiario']['persona_id']))?>
	
	<?php echo $frm->end()?>
</div>
<div id="DetalleOrden" style="visibility:<?php echo ($mostrar_detalle == 0 ? "hidden" : "visible") ?>;" class="areaDatoForm">
		
	<h2>DETALLE DE LA ORDEN DE CONSUMO</h2>
	
	<?php echo $frm->create(null,array('id' => 'formDetalle','action' => 'aprobar_orden','onsubmit' => "return validateForm()"));?>
	
	<table class="tbl_form">
		<tr>
		
			<tr>
				<td>BENEFICIARIO</td>
				<td><?php echo $frm->input('BeneficiarioBeneficioDetalle.persona_id',array('type' => 'select', 'options' => $adicionales))?></td>
			</tr>		
		
			<td>PRODUCTO / SERVICIO</td>
			<td>
			
			<?php 
			echo $javascript->link('scriptaculous');
			echo $javascript->link('scriptaculous.js?load=effects');
			?>
			<input name="data[BeneficiarioBeneficioDetalle][productoAproxima]" type="text" size="50" maxlenght="100" value="" id="BeneficiarioBeneficioDetalleProductoAproxima" />
			<div id="BeneficiarioBeneficioDetalleProducto_autoComplete" class="auto_complete"></div>
			<span id="ajax_loader_producto" style="display: none;font-size: 11px;font-style:italic;color:red;">
			Procesando...<?php echo $html->image('controles/red_animated.gif') ?>
			</span>	
			<?php echo $frm->hidden('BeneficiarioBeneficioDetalle.codigo_producto'); ?>
			<?php echo $frm->hidden("BeneficiarioBeneficioDetalle.producto_descripcion")?>
			<script type="text/javascript">
			
			//<![CDATA[
				Event.observe(window, 'load', function() {
					document.getElementById("BeneficiarioBeneficioDetalleCodigoProducto").value = "";
					document.getElementById("ProductoDescripcion").value = "";
					document.getElementById("BeneficiarioBeneficioDetalleProductoDescripcion").value = "";
					$("ProductoDescripcion").hide();
				});
				
				new Ajax.Autocompleter('BeneficiarioBeneficioDetalleProductoAproxima', 'BeneficiarioBeneficioDetalleProducto_autoComplete', '<?php echo $this->base?>/beneficiario_beneficios/autocomplete', {minChars:1, afterUpdateElement:getSelectionId0, indicator:'ajax_loader_producto'});
				function getSelectionId0(text, li){
					var id = li.id;
					document.getElementById("ProductoDescripcion").value = id + ' - ' + text.value;
					document.getElementById("BeneficiarioBeneficioDetalleCodigoProducto").value = id;
					document.getElementById("BeneficiarioBeneficioDetalleProductoDescripcion").value = text.value;
					$("ProductoDescripcion").show();
				}    
			//]]>           
			</script>
				
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="text" id="ProductoDescripcion" disabled="disabled" size="50"/></td>
		</tr>
		
		<tr>
			<td>CANTIDAD</td>
			<td>
			<input name="data[BeneficiarioBeneficioDetalle][cantidad]" type="text" size="5" maxlength="5" class="input_number" onkeypress="return soloNumeros(event)" value="" id="BeneficiarioBeneficioDetalleCantidad" />
			IMPORTE
			<input name="data[BeneficiarioBeneficioDetalle][importe]" type="text" size="10" maxlength="10" class="input_number" onkeypress="return soloNumeros(event,true)" value="" id="BeneficiarioBeneficioDetalleImporte" /></td>

		</tr>
		<tr>
			<td>PERMANENTE</td>
			<td><input type="checkbox" id="BeneficiarioBeneficioDetallePermanente" name="data[BeneficiarioBeneficioDetalle][permanente]"/></td>
		</tr>		
		<tr id="fechaPermanenteHasta">
			<td>FECHA HASTA</td>
			<td><?php echo $frm->calendar('BeneficiarioBeneficioDetalle.fecha_hasta','',date('Y-m-d'),date('Y'),date('Y') + 1)?></td>
		</tr>		
		<tr>
			<td>OBSERVACIONES</td>
			<td><?php echo $frm->textarea("BeneficiarioBeneficioDetalle.observaciones",array('cols' => 60,'rows' => 10))?></td>
		</tr>
		<tr>
			<td></td>
			<td>
<!--	 		<a href="<?php echo $this->base?>/beneficiario_beneficios/cargar_consumo/<?php echo $beneficiario_id?>" style="margin:3px; border:1px solid; padding: 3px;background-color: graytext;">-->
<!--	 		CANCELAR-->
<!--	 		</a>	-->
<!--	 		&nbsp;&nbsp;			-->
	 		<a href="<?php echo $this->base?>/beneficiario_beneficios/cargar_renglones/<?php echo $beneficiario_id?>" id="link1568620940" style="margin:3px; border:1px solid; padding: 3px;background-color: graytext;" onclick=" event.returnValue = false; return false;">
	 		AGREGAR
	 		</a>
	 		<script type="text/javascript">
	 			Event.observe('link1568620940', 'click', function(event) { 
					$('ajax_loader_2124618328').show();
					new Ajax.Updater(
						'grilla_renglones',
						'<?php echo $this->base?>/beneficiario_beneficios/cargar_renglones/<?php echo $beneficiario_id?>', 
						{
							asynchronous:true, 
							evalScripts:true, 
							onComplete:function(request, json) {
									$('ajax_loader_2124618328').hide();
									document.getElementById("BeneficiarioBeneficioDetalleProductoAproxima").value = "";
									document.getElementById("BeneficiarioBeneficioDetalleCodigoProducto").value = "";
									document.getElementById("ProductoDescripcion").value = "";
									document.getElementById("BeneficiarioBeneficioDetalleProductoDescripcion").value = "";
									document.getElementById("BeneficiarioBeneficioDetalleCantidad").value = "";
									document.getElementById("BeneficiarioBeneficioDetalleImporte").value = "";
									document.getElementById("BeneficiarioBeneficioDetalleObservaciones").value = "";
									document.getElementById("BeneficiarioBeneficioDetallePermanente").checked = false;
									$("fechaPermanenteHasta").hide();
									$("ProductoDescripcion").hide();
									$("BeneficiarioBeneficioDetalleProductoAproxima").focus();									
							}, 
							parameters:$('formDetalle').serialize(), 
							requestHeaders:['X-Update', 'grilla_renglones']
						}
					)
				}, 
				false);
	 		
	 		</script>
	 		<span id="ajax_loader_2124618328" style="display: none;font-size: 11px;font-style:italic;color:red;margin-left:10px;"><img src="<?php echo $this->base?>/img/controles/ajax-loader.gif" border="0" alt="" /></span>
			</td>
		
		</tr>
		</table>
</div>		
		<table class="tbl_form">
		<tr>
			<td id="grilla_renglones">
			
			</td>
		</tr>				
	
		</table>
	<?php echo $frm->hidden("BeneficiarioBeneficio.cabecera",array('value' => base64_encode(serialize($this->data))))?>
	<?php echo $frm->btnGuardarCancelar(array('TXT_GUARDAR' => 'GENERAR ORDEN','URL' => '/beneficiario_beneficios/index/'.$beneficiario_id))?>
