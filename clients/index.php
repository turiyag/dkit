<?php 
	require_once 'pages.php';
	require_once 'client.php';
	enforceLogin();
    $clients = Clients::listAll();
    if($clients === false) {
        errormsg("An error occurred");
    } else {
        if(count($clients) == 0) {
            infomsg("You have no clients");
        }
    }
	startContent();
    echo '<a href="add/" data-role="button">Add New Client</a>';
    if($clients !== false) {
        foreach ($clients as $client) {
            $cdata = $client->get();
            echo '<a href="' . $client->id . '/" data-role="button">' . $cdata['name'] . " (" . $cdata['abbr'] . ") [" . $cdata['tel'] . ']</a>';
        }
    }
	endContent();
