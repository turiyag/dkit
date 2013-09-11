<?php
	require_once 'pages.php';
	require_once 'user.php';
	enforceLogin();
	$win = false;
	$u = new User();
	foreach (array("fullname","initials","email","tel") as $val) {
		if (isset($_REQUEST[$val])) {
			$u->set($val,$_REQUEST[$val]);
			$win = true;
		}
	}
	if (!empty($_REQUEST['password'])) {
		$u->setPassword($_REQUEST['password']);
		$win = true;
	}
	if ($win) {
		successmsg("Info updated");
	}
	startContent();
?>
<form method="post" action="./">
	<input type="text" id="txtName" name="fullname" placeholder="name" value="<?= $u->get('fullname'); ?>" />
	<input type="text" id="txtInitials" name="initials" placeholder="initials" value="<?= $u->get('initials'); ?>" />
	<input type="tel" id="txtTel" name="tel" placeholder="telephone" value="<?= $u->get('tel'); ?>" />
	<input type="email" id="txtEmail" name="email" placeholder="email" value="<?= $u->get('email'); ?>" />
	<input type="password" id="txtPassword" name="password" placeholder="password" />
	<input type="password" id="txtPassword2" name="password2" placeholder="confirm password" />
	<button id="btnUpdate">Update</button>
</form>
<script>
	$(function(){
		validate();
		$("#txtName, #txtInitials, #txtPassword, #txtPassword2").change(function(e) {
			validate();
		});
		$("#txtName, #txtInitials, #txtPassword, #txtPassword2").keyup(function(e) {
			validate();
		});
		function validate() {
			p1 = $("#txtPassword").val();
			p2 = $("#txtPassword2").val();
			if (p1 == p2) {
				if($("#txtName").val() != "" && $("#txtInitials").val() != "") {
					$("#btnUpdate").enable();
				} else {
					$("#btnUpdate").disable();
				}
			} else {
				$("#btnUpdate").disable();
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

