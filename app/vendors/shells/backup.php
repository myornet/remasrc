<?php 
/***********************************************************************************************
 * GENERADOR DE BACKUPS
 * 
 * start back
 * /usr/bin/mysqldump --opt --single-transaction --comments --dump-date --no-autocommit --password=remasrc#1qaz 
 * --user=remasrc_sa remasrc_db --result-file=/datos/backups/mysql/remasrc_db.sql
 * 
 * restore back
 * mysql -u remasrc_sa -p remasrc_db < /datos/backups/mysql/remasrc_db.sql
 * 
 * lanzador shell
 * 
 * /usr/bin/php5 /datos/www/remasrc/cake/console/cake.php backup 1 -app /datos/www/remasrc/app/
 * 
 * 
 ***********************************************************************************************/

/**
 * 
 * @author adrian
 *
 */

Configure::load("configure_file");

class BackupShell extends Shell{
	
	var $uses = array('Asincrono');
	
	function main(){

		$this->Asincrono->limpiarTablas();
		$db = & ConnectionManager::getDataSource($this->Asincrono->useDbConfig);
		
		$zipCMD = "tar -cvzf";
		
		$userDB 			= $db->config['login'];
		$passDB 			= $db->config['password'];
		$name_DB 			= $db->config['database'];	
		
		$CFG = Configure::getInstance();
		
		if(!is_dir($CFG->PATH_BACKUP)) $CFG->PATH_BACKUP = TMP;
		if(!file_exists($CFG->EXEC_MYDUMP)) $CFG->EXEC_MYDUMP = "/usr/bin/mysqldump";
		
		
		$fileBackup = $CFG->PATH_BACKUP . $name_DB .".sql";
		
		//creo el backup
		$CMD = $CFG->EXEC_MYDUMP. " --opt --single-transaction --comments --dump-date --no-autocommit --password=$passDB --user=$userDB $name_DB --result-file=$fileBackup";

		$this->out($CMD);
		@exec($CMD);
		
		//genero un tar 
		$fileTARGZ = $name_DB ."_backup_".date('D').".tar.gz";
		$CMD = $zipCMD." ".$CFG->PATH_BACKUP."$fileTARGZ $fileBackup ". WWW_ROOT ."logs " . WWW_ROOT . "novedades";
		$this->out($CMD);
		@exec($CMD);
		
		//borro el sql 
		$CMD = "rm -rf " . $fileBackup;
		$this->out($CMD);
		@exec($CMD);		

		//copio al dir adicional
		if(is_dir($CFG->PATH_BACKUP_COPY)){
			$CMD = "cp -r ".$CFG->PATH_BACKUP.$fileTARGZ. " " . $CFG->PATH_BACKUP_COPY;
			$this->out($CMD);
			@exec($CMD);			
		}
		
		//copio por FTP
		if(file_exists($CFG->PATH_BACKUP.$fileTARGZ)){
			$FTP_ID = $this->FTP($CFG);
			if($FTP_ID){
				ftp_put($FTP_ID,$CFG->FTP_BACKUP_FOLDER . $fileTARGZ,$CFG->PATH_BACKUP.$fileTARGZ,FTP_BINARY);
				ftp_quit($FTP_ID);	
			}
		}
		
		
	}
	
	function FTP($CFG){
		$id_ftp = ftp_connect($CFG->FTP_BACKUP_SERVER,21);
		if(!ftp_login($id_ftp,$CFG->FTP_BACKUP_USER,$CFG->FTP_BACKUP_PASS)) return null;
		ftp_pasv($id_ftp,true);
		return $id_ftp;
	}	
	
}

?>