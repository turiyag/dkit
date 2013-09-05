<?php
class LoadState {
    const None = 1;
    const Head = 2;
    const Body = 3;
    const Page = 4;
    const Content = 5;
    const PostContent = 6;
    const PostPage = 7;
    const PostBody = 8;
}

var $loaded = LoadState::None;
function startHead() {
    if ($loaded == LoadState::None) {
        require_once "./login/enforcelogin.php"; 
        echo "<!DOCTYPE html>\n<html><head>";
        include('head.php');
        $loaded = LoadState::Head;
    } else {
        errormsg("Head already started");
    }
}

function startBody() {
    if ($loaded < LoadState::Head) {
        startHead()
    } 
    if ($loaded == LoadState::Head) {
        echo '</head><body>';
        $loaded = LoadState::Body;
    } else {
        errormsg("Body already started");
    }
}

function startPage() {
    if ($loaded < LoadState::Body) {
        startBody()
    } 
    if ($loaded == LoadState::Body) {
        echo '<div data-role="page" data-theme="a">';
        include('header.php');
        displayMessages();
        $loaded = LoadState::Page;
    } else {
        errormsg("Page already started");
    }
}

function startPage() {
    if ($loaded < LoadState::Page) {
        startBody()
    } 
    if ($loaded == LoadState::Page) {
        echo '<div data-role="page" data-theme="a">';
        include('header.php');
        displayMessages();
        $loaded = LoadState::Page;
    } else {
        errormsg("Page already started");
    }
}

function successmsg($msg) {
    $_SESSION['successes'][] = $msg;
}

function errormsg($msg) {
    $_SESSION['errors'][] = $msg;
}

function warningmsg($msg) {
    $_SESSION['warnings'][] = $msg;
}

function displayMessages() {
    if (isset($_SESSION['successes'])) {
        displayType($_SESSION['successes'],"d");
        unset($_SESSION['successes']);
    }
    if (isset($_SESSION['errors'])) {
        displayType($_SESSION['errors'],"c");
        unset($_SESSION['errors']);
    }
    if (isset($_SESSION['warnings'])) {
        displayType($_SESSION['warnings'],"b");
        unset($_SESSION['warnings']);
    }
}

function displayType($msgs, $theme) {
    foreach ($msgs as $msg) {
?>
            <ul style="margin:15px;" data-role="listview" data-theme="<?php echo $theme; ?>">
                <li>
                    <?php echo $msg; ?>
                </li>
            </ul>
<?php
    }
}
    
include("./login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
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
                <a href="dbxtest/" data-ajax="false" data-role="button" data-icon="grid">Dropbox</a>
                <a href="login/logout" data-ajax="false" data-role="button" data-icon="delete" data-theme="c">Log out</a>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>