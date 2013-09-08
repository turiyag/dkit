<?php
    require_once 'pages.php';
    require_once 'user.php';
	if(!User::currentUser()) {
		if(isset($_POST['username']) && isset($_POST['password'])) {
			if(User::login($_POST['username'], $_POST['password'])) {
                successmsg("Logged in as " . $_SESSION['username']);
				if(isset($_SESSION['preloginaddr'])) {
					redirect($_SESSION['preloginaddr']);
				} else {
					redirect('/dev/dkit/');
				}
            } else {
                errormsg("Invalid username or password");
                redirect('/dev/dkit/login/');
			}
		} else {
			//Not logged in and no credentials passed in
			//Remember where they were trying to go
			$_SESSION['preloginaddr'] = $_SERVER['REQUEST_URI'];
			//And redirect them to the login page
            redirect('/dev/dkit/login/');
		}
	}