<?php
    require_once 'pages.php';
    require_once 'client.php';
    enforceLogin();
    startContent();
?>
<a href="edit" data-role="button">Edit client info</a>
<a href="new" data-role="button">Create new survey</a>
<?php
    endContent();

