<?php
	require_once 'pages.php';
	enforceLogin();
	startContent(); 
?>
<a href="login/edit/" data-role="button">Edit Profile</a>
<a href="clients/" data-role="button">Clients</a>
<a href="surveys/" data-role="button">Surveys</a>
<a href="projects/" data-role="button">Projects</a>
<a href="dbx/" data-role="button">Dropbox</a>
<a href="design/" data-role="button">Design Demo</a>
<?php
	endContent();