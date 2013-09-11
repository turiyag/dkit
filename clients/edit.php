<?php
	require_once 'pages.php';
	require_once 'client.php';
	require_once 'user.php';
	enforceLogin();
	$win = false;
	$c = new Client();
	if(noneEmpty("name","abbr")){
		foreach (array("name","abbr","email","tel","address","notes") as $val) {
			if (isset($_REQUEST[$val])) {
				$c->set($val,$_REQUEST[$val]);
			}
		}
		successmsg("Info updated");
	}
	$cdata = $c->get();
	startContent();
?>
<a href="surveys/" data-role="button">Surveys</a>
<form method="post" action="./">
	<input type="text" id="txtname" name="name" placeholder="name" value="<?= $cdata['name']; ?>" />
	<input type="text" id="txtabbr" name="abbr" placeholder="abbreviation" value="<?= $cdata['abbr']; ?>" />
	<input type="text" id="txtaddress" name="address" placeholder="address" value="<?= $cdata['address']; ?>" />
	<input type="tel" id="txtTel" name="tel" placeholder="telephone" value="<?= $cdata['tel']; ?>" />
	<input type="email" id="txtEmail" name="email" placeholder="email" value="<?= $cdata['email']; ?>" />
	<textarea name="notes" placeholder="notes"><?= $cdata['notes']; ?></textarea>
	<button id="btnadd">Edit</button>
</form>
<form method="post" action="delete/">
	<button id="btnadd">Delete</button>
</form>
<script>
	$(function(){
		validate();
		$("#txtname").change(function(e) {
			if($("#txtabbr").val() == "") {
				nm = $("#txtname").val() + " ";
				nm = nm.replace(/([^ ])[^ ]* /g,"$1");
				$("#txtabbr").val(nm);
			}
		});
		$("#txtname, #txtabbr").change(validate);
		$("#txtname, #txtabbr").keyup(validate);
		function validate() {
			if($("#txtname").val() != "" && $("#txtabbr").val() != "") {
				$("#btnadd").enable();
			} else {
				$("#btnadd").disable();
			}
		}
	});
</script>
<?php
	endContent();
