<?php

set_exception_handler('failPage');

if(session_id() == '') {
	session_start();
}

if(!isset($_SESSION['msgs'])) {
	$_SESSION['msgs'] = [];
}

if(isset($_REQUEST['client'])) {
	$_SESSION['client'] = $_REQUEST['client'];
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
		echo '<div class="page">';
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
		echo '<div class="content">';
		$loaded = LoadState::Content;
	} else {
		errormsg("Content already started");
	}
}

function endContent($footer = true) {
	global $loaded;
	if ($loaded < LoadState::Content) {
		startContent();
	} 
	if ($loaded == LoadState::Content) {
		echo '</div>';
		if ($footer) {
			include('footer.php');
		}
		echo '</div></body></html>';
		$loaded = LoadState::End;
	} else {
		errormsg("Content already ended");
	}
}

function successmsg($msg) {
	$_SESSION['msgs']['successes'][] = $msg;
}

function errormsg($msg) {
	$_SESSION['msgs']['errors'][] = $msg;
}

function infomsg($msg) {
	$_SESSION['msgs']['infos'][] = $msg;
}

function displayMessages() {
	if (isset($_SESSION['msgs']['successes'])) {
		displayMsgType($_SESSION['msgs']['successes'],"success","check");
		unset($_SESSION['msgs']['successes']);
	}
	if (isset($_SESSION['msgs']['errors'])) {
		displayMsgType($_SESSION['msgs']['errors'],"error","alert");
		unset($_SESSION['msgs']['errors']);
	}
	if (isset($_SESSION['msgs']['infos'])) {
		displayMsgType($_SESSION['msgs']['infos'],"info","info");
		unset($_SESSION['msgs']['infos']);
	}
}

function displayMsgType($msgs, $theme, $icon) {
	foreach ($msgs as $msg) {
?>
			<div class="msg-<?php echo $theme; ?>">
				<span data-icon="<?= $icon; ?>"></span><?= $msg; ?>
			</div>
<?php
	}
}

function enforceLogin() {
	include __DIR__ . "/../login/enforce.php";
}

function enforceDbx() {
	include __DIR__ . "/../dbx/enforce.php";
}

function redirect($url) {
	header('Location: http://' . $_SERVER['HTTP_HOST'] . $url);
	exit();
}

function failPage($e) {
	if($e instanceof Exception) {
		errormsg($e->getMessage());
	} else if (is_string($e)) {
		errormsg($e);
	} else {
		errormsg("Unknown Page Failure");
	}
	endContent();
	exit();
}

function allSet() {
	$args = func_get_args();
	foreach($args as $mixed) {
		if (is_array($mixed)) {
			foreach($mixed as $val) {
				if(!isset($_REQUEST[$val])) {
					return false;
				}
			}
		} else {
			if(!isset($_REQUEST[$mixed])) {
				return false;
			}
		}
	}
	return true;
}

function noneEmpty() {
	$args = func_get_args();
	foreach($args as $mixed) {
		if (is_array($mixed)) {
			foreach($mixed as $val) {
				if(empty($_REQUEST[$val])) {
					return false;
				}
			}
		} else {
			if(empty($_REQUEST[$mixed])) {
				return false;
			}
		}
	}
	return true;
}