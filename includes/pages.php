<?php

if(session_id() == '') {
    session_start();
}

class LoadState {
    const None = 1;
    const Head = 2;
    const Body = 3;
    const Page = 4;
    const Content = 5;
    const End = 6;
}

$loaded = LoadState::None;

function startHead() {
    global $loaded;
    if ($loaded == LoadState::None) {
        echo "<!DOCTYPE html>\n<html><head>";
        include('head.php');
        $loaded = LoadState::Head;
    } else {
        errormsg("Head already started");
    }
}

function startBody() {
    global $loaded;
    if ($loaded < LoadState::Head) {
        startHead();
    } 
    if ($loaded == LoadState::Head) {
        echo '</head><body>';
        $loaded = LoadState::Body;
    } else {
        errormsg("Body already started");
    }
}

function startPage() {
    global $loaded;
    if ($loaded < LoadState::Body) {
        startBody();
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

function startContent() {
    global $loaded;
    if ($loaded < LoadState::Page) {
        startPage();
    } 
    if ($loaded == LoadState::Page) {
        echo '<div data-role="content">';
        $loaded = LoadState::Content;
    } else {
        errormsg("Content already started");
    }
}

function endContent() {
    global $loaded;
    if ($loaded < LoadState::Content) {
        startContent();
    } 
    if ($loaded == LoadState::Content) {
        echo '</div>';
        include('footer.php');
        echo '</body></html>';
        $loaded = LoadState::End;
    } else {
        errormsg("Content already ended");
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
        displayMsgType($_SESSION['successes'],"d");
        unset($_SESSION['successes']);
    }
    if (isset($_SESSION['errors'])) {
        displayMsgType($_SESSION['errors'],"c");
        unset($_SESSION['errors']);
    }
    if (isset($_SESSION['warnings'])) {
        displayMsgType($_SESSION['warnings'],"b");
        unset($_SESSION['warnings']);
    }
}

function displayMsgType($msgs, $theme) {
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

function enforceLogin() {
    include __DIR__ . "/login/enforcelogin.php";
}

function enforceDbx() {
    include __DIR__ . "/dbx/enforce.php";
}
?>