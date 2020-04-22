<?php
App::import(array('Form','Html'));


/**
 * 
 * @author ADRIAN TORRES
 *
 */
class FrmHelper extends FormHelper{
	
	
	function input($fieldName,$options=null){
		$options['label'] = (isset($options['label']) ? $options['label'] : "");
		if(!key_exists('div',$options))$options['div'] = false;
		return parent::input($fieldName,$options);	
	}

	/**
	 * btnGuardarCancelar
	 * Funcion que renderiza el boton guardar y cancelar, por parametro se pasa la URL donde redirige el boton cancelar
	 * 
	 * @param $optCancel
	 * @return unknown_type
	 */
	
	function btnGuardarCancelar($optCancel){
		$str = "";
		
		$RAIZ =  Configure::read('APLICACION.folder_install');
		$URL = $this->base . $optCancel['URL'];
		$txtBtnGuardar = (!empty($optCancel['TXT_GUARDAR']) ? $optCancel['TXT_GUARDAR'] : "GUARDAR");
		$txtBtnCancelar = (!empty($optCancel['TXT_CANCELAR']) ? $optCancel['TXT_CANCELAR'] : "CANCELAR");
		
		$str = "<div class=\"submit\">";
//		$str .= "	<input type=\"button\" value=\"".$this->txtBtnCancelar."\" onclick=\"javascript:window.location='".$URL."';\" class=\"btn_cancelar\"/>";
		$str .= "	<input type=\"button\" value=\"".$txtBtnCancelar."\" onclick=\"javascript:window.location='".$URL."';\"/>";
		$str .= "&nbsp;&nbsp;";
//		$str .= "	<input type=\"submit\" value=\"".$this->txtBtnGuardar."\" id=\"btn_submit\" class=\"btn_guardar\"/>";
		$str .= "	<input type=\"submit\" value=\"".$txtBtnGuardar."\" id=\"btn_submit\"/>";
		$str .= "</div>";
		$str .= "</form>";			
		
		return $str;
		
	}	
	
	/**
	 * Boton generico
	 * @param unknown_type $opts
	 * @return unknown_type
	 */
	function boton($opts){
		$str = "";
		$URL = $this->base . $opts['URL'];
		$txt = (isset($opts['LABEL']) ? $opts['LABEL'] : 'Click Aqui');
		$name = (isset($opts['NAME']) ? $opts['NAME'] : 'btn_'.rand(0,999));
		$str = "<div class=\"submit\">";
		$str .= "	<input type=\"button\" name=\"".$name."\" value=\"".$txt."\" onclick=\"javascript:window.location='".$URL."';\"/>";
		$str .= "</div>";	
		return $str;
	}	
	
	/**
	 * 
	 * Enter description here ...
	 * @param $id
	 * @param $options
	 * @param $decimal
	 */
	function number($id,$options=array(),$decimal=false){
		if(!key_exists('size',$options))$options['size'] = ($decimal ? 10 : 5);
		if(!key_exists('maxlength',$options))$options['maxlength'] = ($decimal ? 10 : 5);
		if(!key_exists('class',$options))$options['class'] = 'input_number';
		if(!key_exists('div',$options))$options['div'] = false;
//		if(!key_exists('value',$options))$options['value'] = ($decimal ? "0.00" : "0");
		$options['onkeypress'] =  "return soloNumeros(event".($decimal ? ",true" : "").")";
		return $this->input($id,$options);
	}

	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $fieldName
	 * @param unknown_type $label
	 * @param unknown_type $dateSelected
	 * @param unknown_type $minYear
	 * @param unknown_type $maxYear
	 * @param unknown_type $disable
	 */
	function calendar($fieldName,$label='',$dateSelected = null,$minYear = null,$maxYear = null,$disable = ''){
		
		$minYear = (!empty($minYear) ? $minYear : date('Y'));
		$maxYear = (!empty($maxYear) ? $maxYear : date('Y'));
		
		$d = date('d');
		$m = date('m');
		$y = date('Y');
		
		if(!empty($dateSelected)){
			$d = date('d',strtotime($dateSelected));
			$m = date('m',strtotime($dateSelected));
			$y = date('Y',strtotime($dateSelected));
		}
		
		$dia = $this->day($fieldName,$d,array('min'=>10,'disabled'=> ($disable ? 'disabled' : '')),false);
		$mes = $this->month($fieldName,$m,array('disabled'=> ($disable ? 'disabled' : '')),false);
		$anio = $this->year($fieldName,$minYear,$maxYear,$y,array('disabled'=> ($disable ? 'disabled' : '')),false);
		$calendar = "<div class=\"input date\"><label for=''>$label</label>".$dia .' - '. $mes .' - '. $anio."</div>";
		return $calendar;
	}

	function inputFecha($fieldName,$options=null){
		parent::setEntity($fieldName);
		$model =& ClassRegistry::getObject(parent::model());
		$field = parent::field();
		$type = $model->getColumnType($field);
		if(!empty($model->data[parent::model()][$field]))$fecha = date('d/m/Y',strtotime($model->data[parent::model()][$field]));
		else $fecha = null;
		$options['value'] = $fecha;
		$options['label'] = (isset($options['label']) ? $options['label'] : "");
		return parent::input($fieldName,$options);	
	}	
	
	/**
	 * Combo con los tipos de reportes
	 * @return unknown_type
	 */
	function tipoReporte($selected='PDF',$modelName=null){
		return $this->input((!empty($modelName) ? $modelName."." : "").'tipo_reporte',array('type' => 'select','options' => array('PDF' => 'PDF','XLS' => 'XLS'),'label'=>'','selected' => $selected));
	}	
	
}

?>