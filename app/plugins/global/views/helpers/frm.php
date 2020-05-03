<?php

App::import(array('Form'));

/**
 * SOBRECARGA DE LA CLASE FORMHELPER
 * @author adrian
 *
 */

class FrmHelper extends FormHelper{
	
	var $txtBtnGuardar = "GUARDAR";
	var $txtBtnCancelar = "CANCELAR";
	

	/**
	 * btnGuardarCancelar
	 * Funcion que renderiza el boton guardar y cancelar, por parametro se pasa la URL donde redirige el boton cancelar
	 * 
	 * @param $optCancel
	 * @return unknown_type
	 */
	
	function btnGuardarCancelar($optCancel){
		$str = "";
		$URL = $this->base . $optCancel['URL'];
		$this->txtBtnGuardar = (!empty($optCancel['TXT_GUARDAR']) ? $optCancel['TXT_GUARDAR'] : $this->txtBtnGuardar);
		$this->txtBtnCancelar = (!empty($optCancel['TXT_CANCELAR']) ? $optCancel['TXT_CANCELAR'] : $this->txtBtnCancelar);
		
		$str = "<div class=\"submit\">";
		$str .= "	<input type=\"button\" value=\"".$this->txtBtnCancelar."\" onclick=\"javascript:window.location='".$URL."';\"/>";
		$str .= "&nbsp;&nbsp;";
		$str .= "	<input type=\"submit\" value=\"".$this->txtBtnGuardar."\" id=\"btn_submit\"/>";
		$str .= "</div>";
		$str .= "</form>";			
		
		return $str;
		
	}
	
	function btnForm($opts){
		$URL = $this->base . $opts['URL'];
		$txt = (!empty($opts['LABEL']) ? $opts['LABEL'] : 'Click Aqui');
		$class = (!empty($opts['CLASS']) ? $opts['CLASS'] : 'button is-success');
		
		$str = "<div class=\"submit\">";
		$str .= "	<input class=\"".$opts['CLASS']."\" type=\"button\" name=\"".$opts['NAME']."\" id=\"".$opts['NAME']."\" value=\"".$txt."\" onclick=\"javascript:window.location='".$URL."';\"/>";
		$str .= "</div>";	
		
		return $str;
	}
	
	/**
	 * genera un campo text para ingreso de numeros
	 * @return unknown_type
	 */
//	function number($id,$label='',$disable=false,$size=5,$ln=5){
//		$ctrlInt = "var key = ((window.Event ? false : true) ? event.which : event.keyCode);return (key <= 13 || (key >= 48 && key <= 57));";
////		return $this->input($id,array('label' => $label,'size' => 5,'maxlength' => 5,'class' =>'input_number', 'onkeypress' => $ctrlInt));
////		return $this->input($id,array('label' => $label,'size' => $size,'maxlength' => $ln,'class' =>'input_number', 'onkeypress' => 'return soloNumeros(event)','disabled'=> ($disable ? 'disabled' : '')));
//		return $this->number2($id,array('label'=>$label,'size'=>$size,'maxlength'=>$ln,'disabled'=>($disable ? 'disabled' : '')));
//	}

	function number($id,$options=array()){
		if(!key_exists('size',$options))$options['size'] = 5;
		if(!key_exists('maxlenght',$options))$options['maxlenght'] = 5;
		if(!key_exists('class',$options))$options['class'] = 'input_number';
		$options['onkeypress'] =  'return soloNumeros(event)';
		return $this->input($id,$options);
	}	
	
	/**
	 * genera un campo text con formato moneda
	 * @return unknown_type
	 */
	function money($id,$default='',$label=''){
		$ctrlFloat = "var key = ((window.Event ? false : true) ? event.which : event.keyCode);return (key <= 13 || (key >= 48 && key <= 57) || key == 46);";
//		return $this->input($id,array('label' => $label,'size' => 12,'maxlength' => 12,'class' =>'input_number', 'onkeypress' => $ctrlFloat));
		return $this->input($id,array('label' => $label,'value' => $default,'size' => 12,'maxlength' => 12,'class' =>'input_number', 'onkeypress' => "return soloNumeros(event,true)"));	
	}	

	
	function calendar($fieldName,$label='',$dateSelected = null,$minYear = null,$maxYear = null,$disable = ''){
		
		$minYear = (!empty($minYear) ? $minYear : date('Y'));
		$maxYear = (!empty($maxYear) ? $maxYear : date('Y'));
		
		$d = date('d');
		$m = date('m');
		$y = date('y');
		
		if(!empty($dateSelected)){
			$d = date('d',strtotime($dateSelected));
			$m = date('m',strtotime($dateSelected));
			$y = date('Y',strtotime($dateSelected));
		}
		
		$dia = $this->day($fieldName,$d,array('min'=>10,'disabled'=> ($disable ? 'disabled' : '')),false);
		$mes = $this->month($fieldName,$m,array('disabled'=> ($disable ? 'disabled' : '')),false);
		$anio = $this->year($fieldName,$minYear,$maxYear,$y,array('disabled'=> ($disable ? 'disabled' : '')),false);
		$calendar = "<div class=\"input date\"><label for=''>$label</label>".$dia . $mes . $anio."</div>";
		return $calendar;
	}
	
	function input($fieldName,$options=null){
		$options['label'] = (isset($options['label']) ? $options['label'] : "");
		return parent::input($fieldName,$options);	
	}
	
	
}
?>