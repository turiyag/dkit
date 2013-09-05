<?php include("./login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <div data-role="content">
                <a href="info" data-ajax="false" data-role="button" data-icon="grid">Client Info</a>
                <a href="list/" data-ajax="false" data-role="button" data-icon="grid">Mockups</a>
                <a href="login/logout" data-ajax="false" data-role="button" data-icon="delete" data-theme="c">Log out</a>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>