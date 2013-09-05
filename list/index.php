<?php include("../login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <?php include('../header.php');?>
            <div data-role="content">
                <a href="info" data-ajax="false" data-role="button" data-icon="grid">Client Info</a>
                <a href="mockups/" data-ajax="false" data-role="button" data-icon="grid">Mockups</a>
            </div>
            <?php include('../footer.php'); ?>
        </div>
    </body>
</html>