<?php
    # Include the Dropbox SDK libraries
    require_once __DIR__ . "/../dbxlib/Dropbox/autoload.php";
    use \Dropbox as dbx;
    
    $appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
    $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
    $authorizeUrl = $webAuth->start();
    list($accessToken, $dropboxUserId) = $webAuth->finish($_GET['txtauthcode']);
?><!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>The title</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function() {
		});
	</script>
</head>

<body>
	<div id="header">
	</div>
	<div id="content">
        <h3>Username:</h3>
        <p><?php echo $dropboxUserId; ?></p>
        <h3>Access Token:</h3>
        <p><?php echo $accessToken; ?></p>
        <pre>
            <?php
                $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
                $accountInfo = $dbxClient->getAccountInfo();
                print_r($accountInfo);
            ?>
        </pre>
	</div>
	<div id="footer">
	</div>
</body>
</html>

