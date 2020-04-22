<?php

App::import('Vendor','tcpdf/tcpdf');


/**
 * ListadoPDF
 * @author adrian
 *
 */

class ListadoPDF  extends TCPDF{

	
	var $lineheight; //! int
	var $linea; // Array
	var $titulo; // array
	var $encabezado; // array
	var $logo; // imagen
	var $topMargen;
	var $actualFontSize;
	var $pie;
	
	var $membrete = array();
	var $bMargen = 0.1;
	var $pageBreak = true;
	var $nosotros = "Cordoba Soft IT - info@cordobasoft.com";
		
	/**
	 * Construcctor
	 * @param $orientation
	 * @param $unit
	 * @param $format
	 * @param $unicode
	 * @param $encoding
	 * @param $diskcache
	 * @return unknown_type
	 */
	function ListadoPDF($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false){
		parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
		$this->AliasNbPages();
		$this->SetFontSizeConf(11);
		$this->titulo = array('titulo1' => '', 'titulo2' => '', 'titulo3' => '');
		$this->membrete = array(
								'L1' => Configure::read('APLICACION.nombre_fantasia'), 
								'L2' => Configure::read('APLICACION.domi_fiscal'),
								'L3' => "TEL: " . Configure::read('APLICACION.telefonos') ." - email: ".Configure::read('APLICACION.email')
		);
		//$fileLogo = IMAGES . DS . Configure::read('APLICACION.logo_pdf');
		//if(file_exists($fileLogo)) $this->logo = $fileLogo;
		$this->SetCreator(Configure::read('APLICACION.app_nombre') . " " . Configure::read('APLICACION.app_version'));
		$this->SetAuthor($this->nosotros . " - @2011 ". (date('Y') > 2011 ? " - ".date('Y') : "") ." All Right Reserved");
		$this->topMargen = $this->tMargin;

//		$this->SetAutoPageBreak($this->pageBreak, $this->bMargin * $this->bMargen);
		$this->SetAutoPageBreak(true, $this->bMargin);
	}
	
	/**
	 * Seteo el desplazamiento de la columna
	 * @param $offSet
	 * @return unknown_type
	 */
	function columna($offSet = 0){
		return $this->lMargin + $offSet;
	}
	
	/**
	 * setea el tamaño por default de la letra
	 * @param $size
	 * @return unknown_type
	 */
	function SetFontSizeConf($size){
		$this->SetFontSize($size);
		$this->actualFontSize = $size;
  		$this->lineheight = 5 * $this->actualFontSize / 11;         // Related to FontSizePt == 11
	}	
	
	/**
	 * sobrecarga del metodo Header
	 * @see app/vendors/tcpdf/TCPDF#Header()
	 */
	function Header(){
			
		$linea_back = $this->linea;
		$this->linea = array();
		
		$ancho = $this->w - $this->rMargin - 105;
		
		$this->y = $this->topMargen;
		
    	if(!empty($this->logo)){
    		
    		$this->Image($this->logo,25,2,26,13);
			$this->Ln(5);
    		$this->SetFont(PDF_FONT_NAME_MAIN,'B',10);
	    	$this->Cell(0,5,$this->membrete['L1'],0);
    		$this->Ln(3);
    		$this->SetFont(PDF_FONT_NAME_MAIN,'',7);
    		$this->Cell(0,5,$this->membrete['L2'],0);
    		$this->Ln(3);
    		$this->SetFont(PDF_FONT_NAME_MAIN,'',7);
    		$this->Cell(0,5,$this->membrete['L3'],0);
    		$this->Ln(4); 
    		
    	}else{
    		
			$this->SetFont(PDF_FONT_NAME_MAIN,'B',14);
	    	$this->Cell(0,5,$this->membrete['L1'],0);
    		$this->Ln(5);
    		$this->SetFont(PDF_FONT_NAME_MAIN,'',8);
    		$this->Cell(0,5,$this->membrete['L2'],0);
    		$this->Ln(3);
    		$this->SetFont(PDF_FONT_NAME_MAIN,'',8);
    		$this->Cell(0,5,$this->membrete['L3'],0);
    		$this->Ln(4);
	    	
    	}
    	
		$this->y = 22;
		
    	$yBack = $this->y;

		$this->y = $this->topMargen;
		$this->linea[0] = array();
		$this->linea[0]['posx'] = 105;
		$this->linea[0]['ancho'] = $ancho;
		$this->linea[0]['texto'] = Configure::read('APLICACION.app_nombre')." ";
		$this->linea[0]['size']  = 8;
		$this->linea[0]['borde'] = 'LTBR';
		$this->linea[0]['align'] = 'R';
		$this->linea[0]['fondo'] = 1;
		$this->linea[0]['style'] = 'B';
		$this->linea[0]['colorf'] = '#ccc';
		$this->Imprimir_linea();

		$this->linea[0] = array();
		$this->linea[0]['posx'] = 105;
		$this->linea[0]['ancho'] = $ancho;
		$this->linea[0]['texto'] = $this->titulo['titulo1']." ";
		$this->linea[0]['size']  = 8;
		$this->linea[0]['borde'] = 'LR';
		$this->linea[0]['align'] = 'R';
		$this->Imprimir_linea();

		$this->linea[0] = array();
		$this->linea[0]['posx'] = 105;
		$this->linea[0]['ancho'] = $ancho;
		$this->linea[0]['texto'] = $this->titulo['titulo2']." ";
		$this->linea[0]['size']  = 8;
		$this->linea[0]['borde'] = 'LR';
		$this->linea[0]['align'] = 'R';
		$this->Imprimir_linea();

		$this->linea[0] = array();
		$this->linea[0]['posx'] = 105;
		$this->linea[0]['ancho'] = $ancho;
		$this->linea[0]['texto'] = $this->titulo['titulo3'];
		$this->linea[0]['size']  = 10;
		$this->linea[0]['borde'] = 'LR';
		$this->linea[0]['align'] = 'C';
		$this->linea[0]['style'] = 'B';
		$this->Imprimir_linea();

		$this->y = $yBack;
		$this->Cell(0,3,'', 'B');
    	$this->Ln(4);

    	$this->tMargin = $this->y;
    	
    	//IMPRIMO LAS COLUMNAS
    	if(is_array($this->encabezado)){
    		
    		$this->Ln(0.5);

    		foreach($this->encabezado as $encabezado){
    			
    			$this->linea = $encabezado;
    			$this->imprimir_linea();
    			
    		}
    		
    	}
    	
    	$this->Ln(3);
    	
    	$this->tMargin = $this->y;
    	$this->linea = $linea_back;
    	
    	$this->Reset();
    	
	}	
	
	/**
	 * imprime una linea
	 * @return unknown_type
	 */
	function imprimir_linea(){
		
			$pos    = $this->GetX();
			$ancho  = 0;
			$alto   = 5;
			$texto  = '';
			$borde  = 0;
			$aling  = 'L';
			$fondo  = 0;
			$link   = '';

			$family = '';
			$style  = '';
			$size   = 11;

			$colorb = 255;
			$colorf = 255;
			$colort = 0;
			$Maxlineheight = 0;

//			$this->Reset();
			
			foreach($this->linea as $linea){
				
				$pos    = array_key_exists('posx', $linea)   ? $linea['posx']   : $pos;
				$ancho  = array_key_exists('ancho', $linea)  ? $linea['ancho']  : $this->GetStringWidth($linea['texto']);
				$texto  = $linea['texto'];
				$borde  = array_key_exists('borde', $linea)  ? $linea['borde']  : 0;
				$align  = array_key_exists('align', $linea)  ? $linea['align']  : 'L';
				$fondo  = array_key_exists('fondo', $linea)  ? $linea['fondo']  : 0;
				$link   = array_key_exists('link', $linea)   ? $linea['link']   : '';
				$family = array_key_exists('family', $linea) ? $linea['family'] : '';
				$style  = array_key_exists('style', $linea)  ? $linea['style']  : '';
				$size   = array_key_exists('size', $linea)   ? $linea['size']   : $this->actualFontSize;
				
				$colorb = array_key_exists('colorb', $linea) ? $this->ConvertColor($linea['colorb']) : $this->ConvertColor('black');
				$colorf = array_key_exists('colorf', $linea) ? $this->ConvertColor($linea['colorf']) : $this->ConvertColor('white');
				$colort = array_key_exists('colort', $linea) ? $this->ConvertColor($linea['colort']) : $this->ConvertColor('black');
				
				$this->lineheight = 5 * $size / 11;

				if($this->lineheight > $Maxlineheight) $Maxlineheight = $this->lineheight;
	    		
				$this->SetFillColor($colorf['R'],$colorf['G'],$colorf['B']);
    			$this->SetTextColor($colort['R'],$colort['G'],$colort['B']);
	    		$this->SetDrawColor($colorb['R'],$colorb['G'],$colorb['B']);
   				
	    		$this->SetFont($family,$style,$size);
		 		
   				$this->SetX($pos);
    			
   				$this->Cell($ancho, $this->lineheight, $texto, $borde, 0, $align, $fondo, $link);
	 			
    			$pos = $this->GetX();

			}
			
   			$this->Ln($Maxlineheight);
	   		$this->Reset();
	}	
	


    function Footer(){
        $this->SetY(-15);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('courier','',6);
        $this->Cell(0,3,'PAGINA '.$this->PageNo().'/{nb}','T',1,'R');
        $this->Cell(0,3,'IMPRESO EL '.date('d-m-Y H:m:s'),'',1,'L');
        $this->Cell(0,3,$this->nosotros,'',1,'C');
        $this->Reset();
    }
    
    
	/**
	 * Restauro valores por defecto
	 * @return unknown_type
	 */
	function Reset(){
		$colort = $this->ConvertColor('black');
		$colorb = $this->ConvertColor('black');
		$colorf = $this->ConvertColor('white');
		$this->SetFont('courier','',$this->actualFontSize); // Changeable?(not yet...)
  		$this->lineheight = 5 * $this->actualFontSize / 11;         // Related to FontSizePt == 11
    	$this->SetFillColor($colorf['R'],$colorf['G'],$colorf['B']);
    	$this->SetTextColor($colort['R'],$colort['G'],$colort['B']);
    	$this->SetDrawColor($colorb['R'],$colorb['G'],$colorb['B']);
  		$this->linea  = array();
	}
	
	
	/**
	 * genera el valor de dezplazamiento de las columnas
	 * @param $anchos
	 * @return unknown_type
	 */
	function armaAnchoColumnas($anchos){
		$OFFSET = array();
		$i = 0;
		$w =0;
		$OFFSET[0] = $this->columna($w);
		for($i; $i < count($anchos);$i++){
			$w += $anchos[$i];
			$OFFSET[$i + 1] = $this->columna($w);
		}
		return $OFFSET;		
	}
	
	/**
	 * conversor de color a RGB -- (keys: R,G,B) from html code (e.g. #3FE5AA)
	 * @param $color
	 * @return unknown_type
	 */
	function ConvertColor($color="#000000"){
	
	  //W3C approved color array (disabled)
	  //static $common_colors = array('black'=>'#000000','silver'=>'#C0C0C0','gray'=>'#808080', 'white'=>'#FFFFFF','maroon'=>'#800000','red'=>'#FF0000','purple'=>'#800080','fuchsia'=>'#FF00FF','green'=>'#008000','lime'=>'#00FF00','olive'=>'#808000','yellow'=>'#FFFF00','navy'=>'#000080', 'blue'=>'#0000FF','teal'=>'#008080','aqua'=>'#00FFFF');
	  //All color names array
	  static $common_colors = array('antiquewhite'=>'#FAEBD7','aquamarine'=>'#7FFFD4','beige'=>'#F5F5DC','black'=>'#000000','blue'=>'#0000FF','brown'=>'#A52A2A','cadetblue'=>'#5F9EA0','chocolate'=>'#D2691E','cornflowerblue'=>'#6495ED','crimson'=>'#DC143C','darkblue'=>'#00008B','darkgoldenrod'=>'#B8860B','darkgreen'=>'#006400','darkmagenta'=>'#8B008B','darkorange'=>'#FF8C00','darkred'=>'#8B0000','darkseagreen'=>'#8FBC8F','darkslategray'=>'#2F4F4F','darkviolet'=>'#9400D3','deepskyblue'=>'#00BFFF','dodgerblue'=>'#1E90FF','firebrick'=>'#B22222','forestgreen'=>'#228B22','gainsboro'=>'#DCDCDC','gold'=>'#FFD700','gray'=>'#808080','green'=>'#008000','greenyellow'=>'#ADFF2F','hotpink'=>'#FF69B4','indigo'=>'#4B0082','khaki'=>'#F0E68C','lavenderblush'=>'#FFF0F5','lemonchiffon'=>'#FFFACD','lightcoral'=>'#F08080','lightgoldenrodyellow'=>'#FAFAD2','lightgreen'=>'#90EE90','lightsalmon'=>'#FFA07A','lightskyblue'=>'#87CEFA','lightslategray'=>'#778899','lightyellow'=>'#FFFFE0','limegreen'=>'#32CD32','magenta'=>'#FF00FF','mediumaquamarine'=>'#66CDAA','mediumorchid'=>'#BA55D3','mediumseagreen'=>'#3CB371','mediumspringgreen'=>'#00FA9A','mediumvioletred'=>'#C71585','mintcream'=>'#F5FFFA','moccasin'=>'#FFE4B5','navy'=>'#000080','olive'=>'#808000','orange'=>'#FFA500','orchid'=>'#DA70D6','palegreen'=>'#98FB98','palevioletred'=>'#D87093','peachpuff'=>'#FFDAB9','pink'=>'#FFC0CB','powderblue'=>'#B0E0E6','red'=>'#FF0000','royalblue'=>'#4169E1','salmon'=>'#FA8072','seagreen'=>'#2E8B57','sienna'=>'#A0522D','skyblue'=>'#87CEEB','slategray'=>'#708090','springgreen'=>'#00FF7F','tan'=>'#D2B48C','thistle'=>'#D8BFD8','turquoise'=>'#40E0D0','violetred'=>'#D02090','white'=>'#FFFFFF','yellow'=>'#FFFF00');
	  //http://www.w3schools.com/css/css_colornames.asp
	  if ( ($color{0} != '#') and ( strstr($color,'(') === false ) ) $color = $common_colors[strtolower($color)];
	
	  if ($color{0} == '#') //case of #nnnnnn or #nnn
	  {
	  	$cor = strtoupper($color);
	  	if (strlen($cor) == 4) // Turn #RGB into #RRGGBB
	  	{
		 	  $cor = "#" . $cor{1} . $cor{1} . $cor{2} . $cor{2} . $cor{3} . $cor{3};
		  }
		  $R = substr($cor, 1, 2);
		  $vermelho = hexdec($R);
		  $V = substr($cor, 3, 2);
		  $verde = hexdec($V);
		  $B = substr($cor, 5, 2);
		  $azul = hexdec($B);
		  $color = array();
		  $color['R']=$vermelho;
		  $color['G']=$verde;
		  $color['B']=$azul;
	  }
	  else //case of RGB(r,g,b)
	  {
	  	$color = str_replace("rgb(",'',$color); //remove Žrgb(Ž
	  	$color = str_replace("RGB(",'',$color); //remove ŽRGB(Ž -- PHP < 5 does not have str_ireplace
	  	$color = str_replace(")",'',$color); //remove Ž)Ž
	    $cores = explode(",", $color);
	    $color = array();
		  $color['R']=$cores[0];
		  $color['G']=$cores[1];
		  $color['B']=$cores[2];
	  }
	  if (empty($color)) return array('R'=>255,'G'=>255,'B'=>255);
	  else return $color; // array['R']['G']['B']
	}	
	
 
}
?>
