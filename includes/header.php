<div data-role="header">
    <h1>Designer's Toolkit</h1>
    <?php if(!($_SERVER['PHP_SELF']=='/dev/dkit/index.php')) { ?><a href="/dev/dkit/" data-ajax="false" data-icon="home" data-iconpos="notext">Home</a><?php } ?>
    <?php if(!($_SERVER['PHP_SELF']=='/dev/dkit/help.php') && isset($_SESSION['username'])) { ?><a href="/dev/dkit/login/logout" data-ajax="false" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Log out</a><?php } ?>
</div>
