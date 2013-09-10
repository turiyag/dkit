<?php
    require_once 'pages.php';
	require_once 'client.php';
    require_once 'user.php';
    enforceLogin();
    $win = false;
    try {
        $c = new Client();
    } catch (Exception $e) {
        errormsg($e->getMessage());
        endContent();
        exit();
    }
    foreach (array("name","abbr","email","tel","address","notes") as $val) {
        if (isset($_REQUEST[$val])) {
            if($c->set($val,$_REQUEST[$val])) {
                $win = true;
            } else {
                errormsg("An error occurred setting a client value");
            }
        }
    }
    if ($win) {
        successmsg("Info updated");
    }
    startContent();
?>
<form method="post" action="./">
    <input type="text" id="txtname" name="name" placeholder="name" value="<?= $c->get('name'); ?>" />
    <input type="text" id="txtabbr" name="abbr" placeholder="abbreviation" value="<?= $c->get('abbr'); ?>" />
    <input type="text" id="txtaddress" name="address" placeholder="address" value="<?= $c->get('address'); ?>" />
    <input type="tel" id="txtTel" name="tel" placeholder="telephone" value="<?= $c->get('tel'); ?>" />
    <input type="email" id="txtEmail" name="email" placeholder="email" value="<?= $c->get('email'); ?>" />
    <textarea name="notes" placeholder="notes"><?= $c->get('notes'); ?></textarea>
    <button id="btnadd">Edit</button>
</form>
<form method="post" action="delete/">
    <button id="btnadd">Delete</button>
</form>
<script>
    $(function(){
        //$("#btnadd").disable();
        $("#txtname").change(function(e) {
            if($("#txtabbr").val() == "") {
                nm = $("#txtname").val() + " ";
                nm = nm.replace(/([^ ])[^ ]* /g,"$1");
                $("#txtabbr").val(nm);
            }
        });
        $("#txtname, #txtabbr").change(function(e) {
            if($("#txtname").val() != "" && $("#txtabbr").val() != "") {
                //$("#btnadd").enable();
            } else {
                //$("#btnadd").disable();
            }
        });
    });
</script>
<?php
    endContent();
