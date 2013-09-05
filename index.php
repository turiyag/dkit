<?php
    require_once './pages.php';
    enforceLogin();
    startContent();
?>
<a href="info" data-ajax="false" data-role="button" data-icon="grid">Your Info</a>
<a href="list/" data-ajax="false" data-role="button" data-icon="grid">Client List</a>
<a href="dbx/" data-ajax="false" data-role="button" data-icon="grid">Dropbox</a>
<a href="login/logout" data-ajax="false" data-role="button" data-icon="delete" data-theme="c">Log out</a>
<?php
    endContent();
?>