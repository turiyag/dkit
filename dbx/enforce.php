<?php
require_once __DIR__ . '/../pages.php';
require_once __DIR__ . '/../sqli.php';
# Include the Dropbox SDK libraries
require_once __DIR__ . '/../dbxlib/Dropbox/autoload.php';
use \Dropbox as dbx;

enforceLogin();
if(!isset($_SESSION['dbx'])) {
    $_SESSION['dbx'] = array();
    
    $query = "SELECT * FROM dbx WHERE username='" . $mysqli->real_escape_string($_SESSION['username']) . "'";
    $result = $mysqli->query($query);
    //If credentials are accurate
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['dbx']['token'] = $row['token'];
    } else {
        if(isset($_REQUEST['txtauthcode'])) {
            # Get the OAuth link
            $appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
            $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

            try {
                list($accessToken, $dropboxUserId) = $webAuth->finish($_REQUEST['txtauthcode']);
                $_SESSION['dbx']['token'] = $accessToken;
                $query = "INSERT INTO dbx (username, token) ";
                $query .= "VALUES ('" . $mysqli->real_escape_string($_SESSION['username']) . "','" . $mysqli->real_escape_string($_SESSION['dbx']['token']) . "')";
                $result = $mysqli->query($query);
                successmsg("Authenticated to Dropbox, you can now access and use any of your files in Dropbox from DKit");
            } catch (Exception $e) {
                unset($_SESSION['dbx']);
                dbxError($e->getMessage());
            }
        } else {
            unset($_SESSION['dbx']);
            dbxError("No Authentication Code supplied");
        }
    }
}

function dbxError($msg) {
    errormsg($msg);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/dev/dkit/dbx/token');
    exit();
}