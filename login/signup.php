<?php
    require_once 'pages.php';
    require_once 'user.php';
    if(isset($_REQUEST['username'])) {
        $u = Users::add($_REQUEST['username']);
        if ($u) {
            foreach (array("fullname","initials","email","tel") as $val) {
                if (isset($_REQUEST[$val])) {
                    $u->set($val,$_REQUEST[$val]);
                }
            }
            if (isset($_REQUEST['password'])) {
                $u->setPassword($_REQUEST['password']);
                successmsg("Signed up as " . $_REQUEST['username']);
                User::login($_REQUEST['username'], $_REQUEST['password']);
                redirect("/dev/dkit/");
            } else {
                errormsg("Password not set");
            }
        } else {
            errormsg("An error occurred");
        }
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
    <button id="update">Sign up</button>
</form>
<script>
    $(function(){
        $("#update").disable();
        $("#txtPassword, #txtPassword2").change(function(e) {
            testPasswordMatch();
        });
        $("#txtPassword, #txtPassword2").keyup(function(e) {
            testPasswordMatch();
        });
        function testPasswordMatch() {
            p1 = $("#txtPassword").val();
            p2 = $("#txtPassword2").val();
            if (p1 == p2 && p1 != "") {
                $("#update").enable();
            } else {
                $("#update").disable();
            }
        }
    });
</script>
<?php
    endContent();