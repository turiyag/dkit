<?php
    require_once 'pages.php';
    require_once 'client.php';
    enforceLogin();
    try {
        $c = new Client();
    } catch (Exception $e) {
        errormsg($e->getMessage());
        endContent();
        exit();
    }
    startContent();
    echo "<h3>" . $c->get("name") . "</h3>";
?>
<a href="edit/" data-role="button">Edit client info</a>
<a href="new/" data-role="button">Create new survey</a>
<?php
    endContent();

