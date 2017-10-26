<?php

require_once("Client.php");

$client = new Client("lol");
$products = $client->search();
