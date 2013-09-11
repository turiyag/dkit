<?php
require_once 'pages.php';
require_once 'client.php';
require_once 'user.php';
enforceLogin();
startContent();
?>
<p>Your Projects</p>

<a href="surveys/" data-role="button">Surveys</a>
<script>
	$(function(){
	});
</script>
<?php
endContent();

