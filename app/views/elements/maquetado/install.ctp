<?php 

$instalAcrobat = "AdbeRdr1001_es_ES.exe";
$instalJavaVM = "jre-6u24-windows-i586-s.exe";
//$str = explode(" ",php_uname());
//$os = trim($str[0]);
//
//if($os != 'Windows'):
//	$instalAcrobat = "AdobeReader_esp-8.1.7-1.i486.rpm";
//	$instalJavaVM = "jre-6u24-linux-i586.bin";
//endif;

$w = 30;
$opacityMin = "1";

?>

<!-- Botones de ejecutables Java y PDF en el footer del sistema -->
<div class="buttons is-centered">
    <a class="button is-large" href="<?php echo $this->base?>/<?php echo $instalAcrobat?>" target="_blank">
        <span class="icon">
            <i class="far fa-file-pdf"></i>
        </span>
    </a>

    <a class="button is-large" href="<?php echo $this->base?>/<?php echo $instalJavaVM?>" target="_blank">
        <span class="icon">
            <i class="fab fa-java"></i>
        </span>
    </a>
</div>