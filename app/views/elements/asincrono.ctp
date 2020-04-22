<?php if(!empty($asincrono)):?>
<?php 
echo $javascript->link('livepipe');
echo $javascript->link('progressbar');

$UID = intval(mt_rand());
$interval = 0.10;
$backgroundProgress = $this->base . "/img/controles/pagea.jpg";

$PID = $asincrono['Asincrono']['id'];
$titulo = $asincrono['Asincrono']['titulo'];
$subtitulo = ( !empty($asincrono['Asincrono']['subtitulo']) || $asincrono['Asincrono']['subtitulo'] != "" ? $asincrono['Asincrono']['subtitulo'] : "...");

$url_response_server = FULL_BASE_URL . $this->base. "/asincrono.php";
$url_action = FULL_BASE_URL . $this->base. $asincrono['Asincrono']['action_do'];
$url_action_target = (!empty($asincrono['Asincrono']['target']) ? $asincrono['Asincrono']['target'] : "_self");
?>

<style>

    #progress_bar_container {
		width:560px;
		padding: 5px;	
		border:1px solid #666666;
		background-color: #D8DBD4;
		margin-top:5px;
		margin-bottom: 10px;
		color:#000000;
    }

    #progress_bar{  
        width:550px;  
        height:29px;  
        border:1px solid #000000;  
        padding:0px;  
        margin:0;  
        position:relative;  
        background-image:url("<?php echo $backgroundProgress?>");  
        background-repeat:repeat-x; 
		text-align:center; 
		color:#000000;
		line-height:29px;
		font-weight:bold:
    } 
     
    #progress_bar div {  
        background-color:#fff;  
    }
    
    .progress_bar_porcentaje {
    	text-align:center; 
    	color:green; 
    	padding:0px 2px 0px 2px; 
    	float: left;
    	font-weight: bold;
    	margin-top: 3px; 
    	width: 40px; 
    	height: 20px;
    	line-height: 20px;
    	margin-right: 2px;
    	background-color:#FFFF88;
    }
    
    .progress_bar_mensaje {
    	color:#003366;
    	padding-left:3px; 
    	float: left;
    	margin-top: 3px;
    	width: 502px; 
    	height: 20px;
    	line-height: 20px;
    	overflow: hidden;
    	font-family: monospace;
    	font-size: 10px;
    }
    
    #progress_bar_controles {
    	margin-top:3px;
    	border-top: 1px solid #666666;
    	padding-top: 3px;width:550px;
    	float: left;
    	text-align: right;
	}
    
    #progress_bar_titulo{
    	width:560px;
   		font-size: 10px;
    	margin-bottom: 5px;
    	overflow: hidden;
    }
		
	#progress_bar_subtitulo{
    	width:560px;
   		font-size: 9px;
    	margin-bottom: 5px;
		overflow: hidden;
    }
   
    
</style>

<div id="progress_bar_container">
	<p id="progress_bar_titulo">#<?php echo $PID?> - <strong><?php echo $titulo?></strong></p>
	<p id="progress_bar_subtitulo"><?php echo $subtitulo?></p>
	<div id="progress_bar"></div>
	<div id="progress_bar_porcentaje_<?php echo $UID?>" class="progress_bar_porcentaje"></div>
	<div id="progress_bar_mensaje_<?php echo $UID?>" class="progress_bar_mensaje"></div>
	<div style="clear: both;"></div> 
	<div id="progress_bar_controles">  
		<input type="button" value="COMENZAR" id="progress_bar_start_<?php echo $UID?>"/>  
	    <input type="button" value="DETENER" id="progress_bar_stop_<?php echo $UID?>"/>  
	    <input type="button" value="CONSULTAR" id="progress_bar_action_<?php echo $UID?>"/>
	</div>
	<div style="clear: both;"></div> 		
</div>


<script type="text/javascript">
var progress_bar_<?php echo $UID?> = new Control.ProgressBar('progress_bar','<?php echo $url_response_server?>','<?php echo $url_action?>','<?php echo $url_action_target?>','<?php echo $PID?>','<?php echo $UID?>','{interval:<?php echo $interval?>,}');  
$('progress_bar_stop_<?php echo $UID?>').observe('click',progress_bar_<?php echo $UID?>.stop.bind(progress_bar_<?php echo $UID?>));  
$('progress_bar_start_<?php echo $UID?>').observe('click',progress_bar_<?php echo $UID?>.start.bind(progress_bar_<?php echo $UID?>));
$('progress_bar_action_<?php echo $UID?>').observe('click',progress_bar_<?php echo $UID?>.action.bind(progress_bar_<?php echo $UID?>)); 
</script>

<?php endif;?>