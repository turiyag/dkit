<?php
	require_once 'pages.php';
	enforceLogin();
	successmsg('This is a <a href="/">link</a>, in a message denoting success.');
	errormsg('This is a <a href="/">link</a>, in a message denoting an error.');
	infomsg('This is a <a href="/">link</a>, in an informational message.');
	startContent(); 
?>
<a href="info/" data-role="button">Button style link</a>
<div class="ui-col2">
	<a href="/dev/dkit/contact/" data-role="button">Two</a><a href="/dev/dkit/login/logout/" data-role="button">Columns</a>
</div>
<form>
	<input type="text" placeholder="textbox">
	<input type="password" placeholder="password">
	<select>
		<option value="volvo">Volvo</option>
		<option value="saab">Saab</option>
		<option value="mercedes">Mercedes</option>
		<option value="audi">Audi</option>
	</select>
</form>
<?php
	endContent();