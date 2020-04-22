<?//php echo $html->image('controles/status_online.png')?>
USUARIO: <strong><?php echo strtoupper($user['Usuario']['usuario'])?> </strong> | <?php echo $user['Centro']['descripcion']?>
<?//php echo $html->image('controles/connect.png')?> | IPN: <strong><?php echo $_SERVER['REMOTE_ADDR']?></strong>
&nbsp;|&nbsp;
<?php echo $html->link($html->image("controles/yast_security.png",array("border"=>"0")).'CAMBIAR CLAVE','/usuarios/password',null,false,false)?>
&nbsp;|&nbsp;
<?php echo $html->link($html->image("controles/exit.png",array("border"=>"0")).'SALIR','/usuarios/logout',null,false,false)?>