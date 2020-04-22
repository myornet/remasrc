<?

if ($session->check('Message.NOTICE')){
	print "<div class='notices'>";
	$session->flash("NOTICE");
	print "<div style='clear:both;'></div>";
	print "</div>";
}
if ($session->check('Message.ERROR')){
	print "<div class='notices_error'>";
	$session->flash("ERROR");
	print "<div style='clear:both;'></div>";
	print "</div>";
}
if ($session->check('Message.OK')){
	print "<div class='notices_ok'>";
	$session->flash("OK");
	print "<div style='clear:both;'></div>";
	print "</div>";
}

?>