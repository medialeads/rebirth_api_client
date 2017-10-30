<?php

namespace ES\APIv2Client;

require_once __DIR__.'/vendor/autoload.php';

$client = new Client("lol");
$products = $client->search();
$variant = $products[0]->getVariants()[0];

var_dump($client->price($variant));