<?php 
echo $javascript->link('scriptaculous');
echo $javascript->link('scriptaculous.js?load=effects');
?>
<input name="data[<?php echo $model?>][productoAproxima]" type="text" size="50" maxlenght="100" value="" id="<?php echo $model?>ProductoAproxima" />
<div id="<?php echo $model?>Producto_autoComplete" class="auto_complete"></div>
<span id="ajax_loader_producto" style="display: none;font-size: 11px;font-style:italic;color:red;">
Procesando...<?php echo $html->image('controles/red_animated.gif') ?>
</span>	
<?php echo $frm->hidden($model.'.codigo_beneficio_id'); ?>
<script type="text/javascript">
//<![CDATA[
           document.getElementById("<?php echo $model?>CodigoBeneficioId").value = "";
           new Ajax.Autocompleter('<?php echo $model?>ProductoAproxima', '<?php echo $model?>Producto_autoComplete', '<?php echo $this->base?>/beneficiario_beneficios/autocomplete', {minChars:2, afterUpdateElement:getSelectionId0, indicator:'ajax_loader_producto'});
           function getSelectionId0(text, li){
        	   var id = li.id;
        	   //var values = id.split("|");
        	   alert(text.value);
        	   
           }    
//]]>           
</script>