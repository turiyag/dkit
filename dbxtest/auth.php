<?php
    require_once "../login/enforcelogin.php"; 
    # Include the Dropbox SDK libraries
    require_once __DIR__ . "/../dbxlib/Dropbox/autoload.php";
    require_once '../sqli.php';
    use \Dropbox as dbx;
    
    $appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
    $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

    if(isset($_REQUEST['txtauthcode'])) {
            
        try {        
            unset($_SESSION['dbx']);
            list($accessToken, $dropboxUserId) = $webAuth->finish($_REQUEST['txtauthcode']);
            
            $_SESSION['dbx'] = array();
            $_SESSION['dbx']['token'] = $accessToken;
            $_SESSION['dbx']['userid'] = $dropboxUserId;
            $query = "INSERT INTO dbx (username, token) VALUES ('" . $_SESSION['username'] . "','" . $mysqli->real_escape_string($_SESSION['dbx']['token']) . "')";
            $result = $mysqli->query($query);
        } catch (\Dropbox\Exception\BadRequestException $e) {
            // Return the cached data
            
        }
    }

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
        <p><?php echo $_SESSION['dbx']['userid']; ?></p>
        <h3>Access Token:</h3>
        <p><?php echo $_SESSION['dbx']['token']; ?></p>
        <pre>
            <?php
                $dbxClient = new dbx\Client($_SESSION['dbx']['token'], "PHP-Example/1.0");
                $accountInfo = $dbxClient->getAccountInfo();
                print_r($accountInfo);
            ?>
        </pre>
	</div>
	<div id="footer">
	</div>
</body>
</html>

