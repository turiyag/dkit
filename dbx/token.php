<?php
    require_once '../pages.php';
    enforceLogin();

    # Include the Dropbox SDK libraries
    require_once __DIR__ . "/../dbxlib/Dropbox/autoload.php";
    use \Dropbox as dbx;
    
    # Get the OAuth link
    $appInfo = dbx\AppInfo::loadFromJsonFile("dbauth.json");
    $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
    $authorizeUrl = $webAuth->start();

    startContent();
?>
<a href="<?php echo $authorizeUrl; ?>" target="_blank" data-ajax="false" data-role="button" data-icon="grid">Get Authentication Code</a>
<form action="auth" data-ajax="false" method="post">
    <label for="txtauthcode">Enter Authentication Code Here</label>
    <input type="text" name="txtauthcode" id="txtauthcode">
    <button data-theme="d">Submit</button>
</form>
<?php
    endContent();
?>