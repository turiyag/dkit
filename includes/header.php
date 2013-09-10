<?php
    require_once 'user.php';
?>
<div class="header">
    <h1>
        <a href="../" data-icon="arrow-u"></a>
        <a href="/dev/dkit" data-icon="home"></a>
        Designer's Toolkit
        <a href="/dev/dkit/login/logout" data-icon="delete"></a>
    </h1>
<?php
    if (User::currentUser()) {
        echo User::currentUser();
    }
?>
</div>
