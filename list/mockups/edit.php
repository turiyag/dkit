<?php include("../../login/enforcelogin.php"); ?><!DOCTYPE html>
<html>
	<head>
		<?php include('head.php'); ?>
	</head>
	<body>
		<div data-role="page" data-theme="a">
			<?php include('../../header.php');?>
			<div data-role="content">
				Designer uploads set of images, client selects favorite and gives feedback
				<a href="new" data-ajax="false" data-role="button" data-icon="grid">Upload Image Set</a>
				Designer asks a question, user responds
				<a href="edit" data-ajax="false" data-role="button" data-icon="grid">Add Question</a>
			</div>
			<?php include('../../footer.php'); ?>
		</div>
	</body>
</html>