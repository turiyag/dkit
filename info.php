<?php include("./login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
    <head>
        <?php include('head.php'); ?>
    </head>
    <body>
        <div data-role="page" data-theme="a">
            <?php include('header.php');?>
            <div data-role="content">
				<form method="post" action="enforcelogin" data-ajax="false">
					<label for="txtName">Full Name:</label>
					<input type="text" id="txtName" name="txtName" placeholder="name" data-theme="a" />
					<label for="txtInitials">Initials:</label>
					<input type="text" id="txtInitials" name="txtInitials" placeholder="initials" data-theme="a" />
					<label for="txtPassword">Password:</label>
					<input type="password" id="txtPassword" name="password" placeholder="password" data-theme="a" />
					<label for="txtPassword2">Confirm Password:</label>
					<input type="password" id="txtPassword2" name="txtPassword2" placeholder="confirm password" data-theme="a" />
					<label for="txtTel">Telephone:</label>
					<input type="password" id="txtTel" name="txtTel" placeholder="telephone" data-theme="a" />
					<label for="txtEmail">Email (for automatic communication):</label>
					<input type="password" id="txtEmail" name="txtEmail" placeholder="email" data-theme="a" />
					<button>Login</button>
				</form>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </body>
</html>