<?php
$PID = null;

require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . basename(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "database.php";


if(isset($_REQUEST['PID']))$PID = $_REQUEST['PID'];
else exit();

function dbLink(){
	$dbCONFIG = new DATABASE_CONFIG();
	$link = mysql_connect($dbCONFIG->default['host'],$dbCONFIG->default['login'],$dbCONFIG->default['password'])
	or die ("No se establecio conexion a la base de datos");
	mysql_select_db($dbCONFIG->default['database'],$link);	
	return $link;
}

$datos = array();
$datos["PID"] = $PID;
$datos["TOTAL"] = 0;
$datos["ACTUAL"] = 0;
$datos["PORCENTAJE"] = 0;
$datos["ESTADO"] = "F";
$datos["MENSAJE"] = "...";


if(isset($_REQUEST['ACTION']) && $_REQUEST['ACTION'] == 'STOP'){
	mysql_query("LOCK TABLES asincronos WRITE;",dbLink());
	$sql = sprintf("update asincronos SET estado = 'S', msg = 'DETENIDO POR EL USUARIO...' where id = %u;",$PID);
	if(!mysql_query($sql,dbLink())) echo 0;
	else if(!mysql_query("UNLOCK TABLES;",dbLink())) echo 0;
	else echo 1;
}





if(isset($_REQUEST['ACTION']) && $_REQUEST['ACTION'] == 'START'){

	$str = explode(" ",php_uname());
	$os = trim($str[0]);	
	
	$php_pharser = PHP_BINDIR . "/" . ($os == 'Windows' ? "php.exe" : "php5");	
	/*
	if($os == 'Windows'){
		$DIR_PHP = ini_get('extension_dir');
		$PHP = explode(DIRECTORY_SEPARATOR,$DIR_PHP);
		
		$atemp = array();
		foreach($PHP as $idx => $value){
			if($value != 'ext'){
				array_push($atemp,$value);
			}else{
				break;
			}
		}			
		
		$PHP_ROOT = implode(DIRECTORY_SEPARATOR,$atemp);
		$PHP_ROOT .= DIRECTORY_SEPARATOR;				
		$php_pharser = $PHP_ROOT .'php.exe';
	}else{
		$php_pharser = '/usr/bin/php5 ';
	}
	*/

	$sql = sprintf("select proceso from asincronos where id = %u",$PID);
	$result = mysql_query($sql,dbLink());
	$exec = "";
	while($row = mysql_fetch_assoc($result)){
		$exec = $row['proceso'];
	}

	$cake = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."cake".DIRECTORY_SEPARATOR."console".DIRECTORY_SEPARATOR."cake.php";
	
//	$cake = "D:".DIRECTORY_SEPARATOR."develop".DIRECTORY_SEPARATOR."xampp".DIRECTORY_SEPARATOR."htdocs".DIRECTORY_SEPARATOR."sigem".DIRECTORY_SEPARATOR."cake".DIRECTORY_SEPARATOR."console".DIRECTORY_SEPARATOR."cake.php";
	
	$app = dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."app";	
	
//	$app = "D:".DIRECTORY_SEPARATOR."develop".DIRECTORY_SEPARATOR."xampp".DIRECTORY_SEPARATOR."htdocs".DIRECTORY_SEPARATOR."sigem".DIRECTORY_SEPARATOR."app";
	
	if($os == 'Windows'){
		$WshShell = new COM("WScript.Shell") or die ("Could not initialise Object.");
		$CMD = "\"$php_pharser\" \"$cake\" $exec $PID -app \"$app\"";
		$oExec = $WshShell->Run($CMD,0,false);
		print_r($oExec);
		unset($WshShell);
//		echo $CMD;
	}else{
		//LINUX
		$CMD = $php_pharser . " " . $cake . " ". $exec . " " . $PID . " -app ".$app;
		@exec($CMD . " > /dev/null &");				
	}		
	mysql_query("LOCK TABLES asincronos WRITE;",dbLink());
	$sql = sprintf("update asincronos SET estado = 'P', porcentaje=0, msg='COMENZANDO...' where id = %u;",$PID);
	mysql_query($sql,dbLink());
	mysql_query("UNLOCK TABLES;",dbLink());



}


if(isset($_REQUEST['ACTION']) && $_REQUEST['ACTION'] == 'STATUS'){
	$datos = array();
	$datos["TOTAL"] = 0;
	$datos["ACTUAL"] = 0;
	$datos["PORCENTAJE"] = 0;
	$datos["ESTADO"] = null;
	$datos["MENSAJE"] = "...";	
	$sql = sprintf("select estado,total,contador,porcentaje,msg from asincronos where id = %u",$PID);
	$result = mysql_query($sql,dbLink());
	while($row = mysql_fetch_assoc($result)){
		$datos["TOTAL"] = $row['total'];
		$datos["ACTUAL"] = $row['contador'];
		$datos["PORCENTAJE"] = $row['porcentaje'];
		$datos["ESTADO"] = $row['estado'];
		$datos["MENSAJE"] = $row['msg'];
	}
	echo json_encode($datos);
}





?>
