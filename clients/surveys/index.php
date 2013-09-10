<?php 
	require_once("pages.php");
	enforceLogin();
	startContent();
?>
<a href="new" data-ajax="false" data-role="button">Create new mockup</a>
<a href="edit" data-ajax="false" data-role="button">Edit mockup</a>
<a href="responses" data-ajax="false" data-role="button">View client responses</a>
<?php
	endContent();