<?php
/**
* 	adrian
* 	10/08/2010
*/



class BackupsController extends AppController{
	
	var $name = 'Backups';
	var $uses = array("Usuario","BeneficiarioNovedad");
	
	function index(){
		Configure::write('debug',0);
		$fBack = "BACKUP_DB_".date('Ymd_His').".sql";
		$this->Mysql->MySqlDumpDB(LOGS . $fBack);
		$this->Zip->addFile(LOGS.$fBack,$fBack);
		$novedades = $this->BeneficiarioNovedad->find('all',array('conditions' => array(),'fields' => array('BeneficiarioNovedad.adjunto')));
		if(!empty($novedades)):
			$this->Zip->addDirectory('webroot' . DS . 'novedades');
			foreach($novedades as $novedad){
				$path = WWW_ROOT . 'novedades' . DS . $novedad['BeneficiarioNovedad']['adjunto'];
				if(file_exists($path)){
					$this->Zip->addFile($path,'webroot' . DS . 'novedades'.DS.$novedad['BeneficiarioNovedad']['adjunto']);
				}
			}
		endif;
		$this->Zip->addDirectory('webroot' . DS . 'auditoria');
		$dir = WWW_ROOT . 'logs' . DS . 'auditoria';
		if ($gestor = opendir($dir)) {
		    while (false !== ($archivo = readdir($gestor))) {
		        if ($archivo != "." && $archivo != ".." && !is_dir($archivo)) {
		            $this->Zip->addFile($dir . DS . $archivo,'webroot' . DS . 'auditoria'.DS.$archivo);
		        }
		    }
		    closedir($gestor);
		}		
		$fileName = "BACKUP_DB_".date('Ymd').".zip";
		$this->Zip->forceDownload($fileName);
		exit();		
	}
		
	
	
	
}

?>