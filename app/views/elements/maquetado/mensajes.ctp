<?

if ($session->check('Message.NOTICE')){
	print "<div class='notification is-marginless is-info>";
	$session->flash("NOTICE");
	print "</div>";
}
if ($session->check('Message.ERROR')){
	print "<div class='notification is-marginless is-danger'>";
	$session->flash("ERROR");
	print "</div>";
}
if ($session->check('Message.OK')){
	print "<div class='notification is-marginless is-success'>";
	$session->flash("OK");
	print "</div>";
}

?>