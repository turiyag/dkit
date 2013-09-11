<?php
	require_once 'pages.php';
	require_once 'user.php';
	if(noneEmpty('username','password')) {
		$u = Users::add($_REQUEST['username']);
		foreach (array("fullname","initials","email","tel") as $val) {
			if (isset($_REQUEST[$val])) {
				$u->set($val,$_REQUEST[$val]);
			}
		}
		$u->setPassword($_REQUEST['password']);
		successmsg("Signed up as " . $_REQUEST['username']);
		User::login($_REQUEST['username'], $_REQUEST['password']);
		redirect("/dev/dkit/");
	}
	startContent();
?>
<form method="post" action="signup">
	<input type="text" id="txtuser" name="username" placeholder="username" />
	<input type="text" id="txtName" name="fullname" placeholder="full name" />
	<input type="text" id="txtInitials" name="initials" placeholder="initials" />
	<input type="tel" id="txtTel" name="tel" placeholder="telephone" />
	<input type="email" id="txtEmail" name="email" placeholder="email" />
	<input type="password" id="txtPassword" name="password" placeholder="password" />
	<input type="password" id="txtPassword2" name="password2" placeholder="confirm password" />
	<button id="btnSignup">Sign up</button>
</form>
<script>
	$(function(){
		$("#btnSignup").disable();
		$("#txtName, #txtInitials, #txtPassword, #txtPassword2").change(function(e) {
			validate();
		});
		$("#txtPassword, #txtPassword2").keyup(function(e) {
			validate();
		});
		$("#txtName, #txtInitials").change(function(e) {
			validate();
		});
		function validate() {
			p1 = $("#txtPassword").val();
			p2 = $("#txtPassword2").val();
			if (p1 == p2 && p1 != "") {
				if($("#txtName").val() != "" && $("#txtInitials").val() != "") {
					$("#btnSignup").enable();
				} else {
					$("#btnSignup").disable();
				}
			} else {
				$("#btnSignup").disable();
			}
		}
		$("#txtName").change(function(e) {
			if($("#txtInitials").val() == "") {
				nm = $("#txtName").val() + " ";
				nm = nm.replace(/([^ ])[^ ]* /g,"$1");
				$("#txtInitials").val(nm);
			}
		});
	});
</script>
<?php
	endContent();