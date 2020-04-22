<?php
/**
 * MysqlComponent
 * @author adrian
 *
 */
class MysqlComponent extends Object{
	
	var $writeToFile = null;
	
    function startup(&$controller){
		$this->controller =& $controller;
		$this->modelClass = $this->controller->modelClass;
    }	
    
    
    function MySqlDumpDB($file = null){

		if (!$this->modelClass){
		    $ModelClass = $this->modelClass = $this->controller->modelClass;
		}else{
			$ModelClass = $this->modelClass;
		}
		
		
	
		$db = & ConnectionManager::getDataSource($this->controller->$ModelClass->useDbConfig);
		
		$query = "";
		$query .= "/*###### BACKUP DATABASE - ".$db->config['database']." ######*/\n";
		$query .= "DROP DATABASE IF EXISTS `".$db->config['database']."`; \n\n";
		$query .= "CREATE DATABASE `".$db->config['database']."`; \n\n";
		$query .= "USE `".$db->config['database']."`; \n\n";

		$query .= "/* *********************************************** */\n";

		foreach($db->_sources as $tabla){
			#chequeo#
			$sql = "CHECK TABLE `$tabla` FAST QUICK";
			$this->controller->$ModelClass->query($sql);
			#optimizo#
			$sql = "OPTIMIZE TABLE `".$db->config['database']."`.`".$tabla."`";
			$this->controller->$ModelClass->query($sql);

			#borro y creo la tabla#
			$query .= $this->_mysqldump_table_structure($tabla);
			#genero los inserts#
			$query .= $this->_mysqldump_table_data($tabla);
		}
		$query .= "/* *********************************************** */\n";
		if(empty($file)):
			ob_start();
			header("Content-type: text/plain");
			header("Content-Disposition: attachment; filename=BACKUP_DB_".date('Ymd_His').".sql");
			echo $query;
		else:
			App::import('Core','File');			
			$oFILE = new File($file,true);
			if ($oFILE->writable()) $oFILE->append($query);
		endif;
    }

	function _mysqldump_table_structure($table){
		
		$query = "";
		
		if (!$this->modelClass){
		    $ModelClass = $this->modelClass = $this->controller->modelClass;
		}else{
			$ModelClass = $this->modelClass;
		}
		$db = & ConnectionManager::getDataSource($this->controller->$ModelClass->useDbConfig);

		$query .= "/* Estructura de la Tabla `$table` */\n";
		$query .= "DROP TABLE IF EXISTS `$table`;\n\n";

		$sql="show create table `$table`; ";
		$result = $this->controller->$ModelClass->query($sql);
		if($result){
			$query .= $result[0][0]['Create Table'].";\n\n";
		}
		return $query;
	}



	function _mysqldump_table_data($table){
		
		$query = "";
		
		$sql = "select * from `$table`;";
		if (!$this->modelClass){
		    $ModelClass = $this->modelClass = $this->controller->modelClass;
		}else{
			$ModelClass = $this->modelClass;
		}
		$db = & ConnectionManager::getDataSource($this->controller->$ModelClass->useDbConfig);

		$sql = "select * from `$table`;";
		$result = mysql_query($sql);
		$result=mysql_query($sql);
		if( $result)
		{
			$num_rows= mysql_num_rows($result);
			$num_fields= mysql_num_fields($result);

			if( $num_rows > 0)
			{
				$query .= "/* Datos de la tabla `$table` */\n";

				$field_type=array();
				$i=0;
				while( $i < $num_fields)
				{
					$meta = mysql_fetch_field($result, $i);
					array_push($field_type, $meta->type);
					$i++;
				}

				//print_r( $field_type);
				$query .= "insert into `$table` values\n";
				$index=0;
				while( $row= mysql_fetch_row($result))
				{
					$query .= "(";
					for( $i=0; $i < $num_fields; $i++)
					{
						if( is_null( $row[$i]))
							$query .= "null";
						else
						{
							switch( $field_type[$i])
							{
								case 'int':
									$query .= $row[$i];
									break;
								case 'string':
								case 'blob' :
								default:
									$query .= "'".mysql_real_escape_string($row[$i])."'";

							}
						}
						if( $i < $num_fields-1)
							$query .= ",";
					}
					$query .= ")";

					if( $index < $num_rows-1)
						$query .= ",";
					else
						$query .= ";";
					$query .= "\n";

					$index++;
				}
			}
		}
		mysql_free_result($result);
		$query .= "\n";
		return $query;
	}	
	
	
}
?>