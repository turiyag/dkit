<?php
    # Include the Dropbox SDK libraries
    require_once __DIR__ . "/../dbxlib/Dropbox/autoload.php";
    require_once "../login/enforcelogin.php"; 
    use \Dropbox as dbx;
    
    $appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
    $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
    $authorizeUrl = $webAuth->start();
?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <?php include('../header.php');?>
            <?php
                if (isset($_SESSION['signupmsg'])) {
            ?>
                    <ul style="margin:15px;" data-role="listview" data-theme="d">
                        <li>
                            <?php echo $_SESSION['signupmsg']; ?>
                        </li>
                    </ul>
            <?php
                    unset($_SESSION['signupmsg']);
                }
            ?>
            <div data-role="content">
                <a href="<?php echo $authorizeUrl; ?>" target="_blank" data-ajax="false" data-role="button" data-icon="grid">Get Token</a>
                <form action="auth">
                    <label for="txtauthcode">Enter Authentication Code Here</label>
                    <input type="text" name="txtauthcode" id="txtauthcode">
                    <button>Submit</button>
                </form>
            </div>
            <?php include('../footer.php'); ?>
        </div>
    </body>
</html>
