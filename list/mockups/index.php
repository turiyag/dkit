<?php include("../../login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <?php include('../../header.php');?>
            <div data-role="content">
                <a href="new" data-ajax="false" data-role="button" data-icon="grid">Create new mockup</a>
                <a href="edit" data-ajax="false" data-role="button" data-icon="grid">Edit mockup</a>
                <a href="responses" data-ajax="false" data-role="button" data-icon="grid">View client responses</a>
            </div>
            <?php include('../../footer.php'); ?>
        </div>
    </body>
</html>