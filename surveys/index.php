<?php 
	require_once("pages.php");
	enforceLogin();
	startContent();
?>
<h3>Surveys</h3>
<a href="new" data-role="button">New Survey</a>
<p>Completed Surveys</p>
<a href="responses/" data-role="button">Listing</a>
<p>Incomplete Surveys</p>
<a href="responses/" data-role="button">Listing</a>
<?php
	endContent();