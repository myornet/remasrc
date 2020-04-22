<ul id="simple-menu"> 
<?php 
if(!empty($menuNav)):
	foreach($menuNav as $id => $menu):
		if(in_array($id,$permisos_actuales)):
			echo "<li>".$html->link($menu['label'],$menu['url'],array('title' => 'Home'),false,false)."</li>";
		endif;
	endforeach;
endif;
?>
</ul> 