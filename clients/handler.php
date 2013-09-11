<?php
	require_once 'pages.php';
	require_once 'client.php';
	try {
		enforceLogin();
		$c = new Client();
		startContent();
		echo "<h3>" . $c->get("name") . "</h3>";
	} catch (Exception $e) {
		errormsg($e->getMessage());
		endContent();
		exit();
	}
?>
<a href="edit/" data-role="button">Edit client info</a>
<a href="new/" data-role="button">Create new survey</a>
<?php
	endContent();

