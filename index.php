<?php include("./login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <?php include('header.php');?>
            <?php
                if (isset($_SESSION['signupmsg'])) {
            ?>
                    <ul style="margin:15px;" data-role="listview" data-theme="d">
                        <li>
                            <?php echo $_SESSION['signupmsg']; ?>
                        </li>
                    </ul>
            <?php
                    unset($_SESSION['signupmsg']);
                }
            ?>
            <div data-role="content">
                <a href="info" data-ajax="false" data-role="button" data-icon="grid">Your Info</a>
                <a href="list/" data-ajax="false" data-role="button" data-icon="grid">Client List</a>
                <a href="login/logout" data-ajax="false" data-role="button" data-icon="delete" data-theme="c">Log out</a>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>