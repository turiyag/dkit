<?php
	session_start();
	session_destroy();
	session_start();
	header('Location: http://' . $_SERVER['HTTP_HOST'] . '/dev/dkit/login');
?>