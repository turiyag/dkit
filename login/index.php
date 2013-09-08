<?php
    require_once 'pages.php';
    startContent();
?>
<form action="enforce" method="post">
    <input type="text" name="username" id="txtuser" placeholder="Username">
    <input type="password" name="password" id="txtpass" placeholder="Password">
    <button>Login</button>
</form>
<a href="signup" data-role="button">Sign up</a>
<a href="lost" data-role="button">Forgot password?</a>
<?php
    endContent();