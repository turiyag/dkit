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
    if (isset($_REQUEST['password'])) {
        if ($_REQUEST['password'] != "") {
            $u->setPassword($_REQUEST['password']);
            $win = true;
        }
    }
    if ($win) {
        successmsg("Info updated");
    }
    startContent();
?>
<form method="post" action="info">
    <input type="text" id="txtName" name="fullname" placeholder="name" value="<?= $u->get('fullname'); ?>" />
    <input type="text" id="txtInitials" name="initials" placeholder="initials" value="<?= $u->get('initials'); ?>" />
    <input type="tel" id="txtTel" name="tel" placeholder="telephone" value="<?= $u->get('tel'); ?>" />
    <input type="email" id="txtEmail" name="email" placeholder="email" value="<?= $u->get('email'); ?>" />
    <input type="password" id="txtPassword" name="password" placeholder="password" />
    <input type="password" id="txtPassword2" name="password2" placeholder="confirm password" />
    <button id="update">Update</button>
</form>
<script>
    $("#txtPassword, #txtPassword2").change(function(e) {
        testPasswordMatch();
    });
    $("#txtPassword, #txtPassword2").keyup(function(e) {
        testPasswordMatch();
    });
    function testPasswordMatch() {
        if ($("#txtPassword").val() == $("#txtPassword2").val()) {
            $("#update").enable();
        } else {
            $("#update").disable();
        }
    }
</script>
<?php
    endContent();

