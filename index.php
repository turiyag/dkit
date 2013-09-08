<?php
    require_once 'pages.php';
    enforceLogin();
    startContent(); 
?>
<a href="info" data-role="button">Edit Profile</a>
<a href="clients/" data-role="button">Clients</a>
<a href="dbx/" data-role="button">Dropbox</a>
<?php
    endContent();