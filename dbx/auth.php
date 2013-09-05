<?php
    require_once '../pages.php';
    require_once __DIR__ . "/../dbxlib/Dropbox/autoload.php";
    use \Dropbox as dbx;

    enforceDbx();
    startContent();
    if(isset($_SESSION['dbx'])) {
?>
        <h3>Access Token:</h3>
        <p><?php echo $_SESSION['dbx']['token']; ?></p>
        <pre>
            <?php
                $dbxClient = new dbx\Client($_SESSION['dbx']['token'], "PHP-Example/1.0");
                $accountInfo = $dbxClient->getAccountInfo();
                array_merge($_SESSION['dbx'],$accountInfo);
                print_r($accountInfo);
            ?>
        </pre>
<?php
    }
    endContent();