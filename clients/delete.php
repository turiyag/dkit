<?php
	require_once 'pages.php';
	require_once 'user.php';
	require_once 'client.php';
	enforceLogin();
	if(noneEmpty("confirm")) {
		$c = new Client();
		$cname = $c->get("name");
		$c->delete();
		successmsg("Deleted $cname");
		redirect('/dev/dkit/clients/');
	}
	startContent();
?>
<form method="post" action="./">
	<input type="hidden" name="confirm" value="true">
	Are you sure you want to delete this client and all associated records? This action is irreversible.
	<button>Delete</button>
</form>