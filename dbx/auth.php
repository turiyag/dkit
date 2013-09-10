<?php
	require_once 'pages.php';
	require_once 'dbx.php';
    use \Dropbox as dbx;

    enforceLogin();
    enforceDbx();
	startContent();
?>
        <p>You are authenticated, Dropbox integration is enabled</p>
        <p>Click <a href="dir/">here</a> to browse your dropbox</p>
<?php
    print_r($_SESSION['dbx']);
	endContent();