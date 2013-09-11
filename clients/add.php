<?php
	require_once 'pages.php';
	require_once 'user.php';
	require_once 'client.php';
	enforceLogin();
	if(noneEmpty(array('name','abbr'))) {
		$c = Clients::add();
		if ($c) {
			foreach (array("name","abbr","email","tel","address","notes") as $val) {
				if (isset($_REQUEST[$val])) {
					$c->set($val,$_REQUEST[$val]);
				}
			}
			successmsg('Added new client. Click <a href="/dev/dkit/clients/' . $c->id . '/">here</a> to view.');
		} else {
			throw new Exception("An error occurred");
		}
	}
	startContent();
?>
<form method="post" action="./">
	<input type="text" id="txtname" name="name" placeholder="name" />
	<input type="text" id="txtabbr" name="abbr" placeholder="abbreviation" />
	<input type="text" id="txtaddress" name="address" placeholder="address" />
	<input type="tel" id="txtTel" name="tel" placeholder="telephone" />
	<input type="email" id="txtEmail" name="email" placeholder="email" />
	<textarea name="notes" placeholder="notes"></textarea>
	<button id="btnadd">Add</button>
</form>
<script>
	$(function(){
		$("#btnadd").disable();
		$("#txtname, #txtabbr").change(function(e) {
			if($("#txtname").val() != "" && $("#txtabbr").val() != "") {
				$("#btnadd").enable();
			} else {
				$("#btnadd").disable();
			}
		});
		$("#txtname").change(function(e) {
			if($("#txtabbr").val() == "") {
				nm = $("#txtname").val() + " ";
				nm = nm.replace(/([^ ])[^ ]* /g,"$1");
				$("#txtabbr").val(nm);
			}
		});
	});
</script>
<?php
	endContent();