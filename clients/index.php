<?php 
	require_once 'pages.php';
	require_once 'client.php';
	enforceLogin();
	startContent();
    $clients = new Clients();
    echo '<a href="add" data-role="button">Add New Client</a>';
    foreach ($clients->listAll() as $client) {
        $cdata = $client->get();
        echo '<a href="' . $client->id . '/" data-role="button">' . $cdata['name'] . " [" . $cdata['tel'] . ']</a>';
    }
	endContent();
