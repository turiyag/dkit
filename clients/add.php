<?php
    require_once 'pages.php';
    require_once 'user.php';
    require_once 'client.php';
    enforceLogin();
    if(allSet(array('name','abbr'))) {
        $c = Clients::add();
        if ($c) {
            $errors = false;
            foreach (array("name","abbr","email","tel","address","notes") as $val) {
                if (isset($_REQUEST[$val])) {
                    if(!$c->set($val,$_REQUEST[$val])) {
                        errormsg("Error occurred setting key: '$val' with value '$_REQUEST[$val]'");
                        $errors = true;
                    }
                }
            }
            if (!$errors) {
                successmsg('Added new client. Click <a href="/dev/dkit/clients/' . $c->id . '/">here</a> to view.');
            }
        } else {
            errormsg("An error occurred");
        }
    }
    startContent();
?>
<form method="post" action="add">
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