<?php 

/********************************************************************************************************************
 * ARCHIVO DE CONFIGURACION
 * EJEMPLO: $config['DOMAIN_URL'] = "http://www.copycom.com.ar";
 * LECTURA:
 * 	Configure::load("configure_file");
 * 	$config = Configure::getInstance();
 * 	Configure::write('DOMAIN_URL',$config->DOMAIN_URL);
 ********************************************************************************************************************/

$config['PERFIL'] = array();

$config['PERFIL'][1] = array(
	'/usuarios/login',
	'/usuarios/password',
	'/usuarios/logout',
	'/personas/index',
	'/beneficiarios/ficha',
	'/beneficiario_adicionales/index',
	'/beneficiario_beneficios/index',
);
$config['PATH_MYDUMP'] = "/usr/bin/mysqldump";
$config['PATH_BACKUP'] = "/datos/backups/mysql/";
$config['PATH_BACKUP_COPY'] = "/var/backups/";

$config['FTP_BACKUP_SERVER'] = "192.168.0.128";
$config['FTP_BACKUP_USER'] = "ftp_mutual1";
$config['FTP_BACKUP_PASS'] = "amanftp_180407";
$config['FTP_BACKUP_FOLDER'] = "backup/sigem/";


?>