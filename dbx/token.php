<?php
	require_once 'pages.php';
	require_once 'dbx.php';
	enforceLogin();
    use \Dropbox as dbx;

	
	# Get the OAuth link
	$appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
	$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
	$authorizeUrl = $webAuth->start();

	startContent();
?>
<a href="<?php echo $authorizeUrl; ?>" target="_blank" data-ajax="false" data-role="button">Get Authentication Code</a>
<form action="auth" data-ajax="false" method="post">
	<label for="txtauthcode">Enter Authentication Code Here</label>
	<input type="text" name="txtauthcode" id="txtauthcode">
	<button data-theme="d">Submit</button>
</form>
<?php
	endContent();
?>