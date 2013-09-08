<?php
require_once 'pages.php';
require_once 'dbx.php';
require_once 'user.php';

use \Dropbox as dbx;

enforceLogin();
infomsg("Enforcing Token");
if(!isset($_SESSION['dbx'])) {
    infomsg("Retrieving token");
    $_SESSION['dbx'] = array();
    $u = new User();
    $token = $u->get("token","dbx");
    //If credentials are accurate
    if ($token) {
        $_SESSION['dbx']['token'] = $token;
        infomsg("Retrieved token");
    } else {
        if(isset($_REQUEST['txtauthcode'])) {

            try {
                # Get the OAuth link
                $appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
                $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
                list($accessToken, $dropboxUserId) = $webAuth->finish($_REQUEST['txtauthcode']);
                $_SESSION['dbx']['token'] = $accessToken;
                if($u->set("token",$accessToken,"dbx")) {
                    successmsg("Authenticated to Dropbox, you can now access and use any of your files in Dropbox from DKit");
                } else {
                    dbxError("Authentication failed");
                }
            } catch (Exception $e) {
                dbxError($e->getMessage());
            }
        } else {
            dbxError("No Authentication Code supplied");
        }
    }
}

function dbxError($msg) {
    unset($_SESSION['dbx']);
    errormsg($msg);
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/dev/dkit/dbx/token');
    exit();
}