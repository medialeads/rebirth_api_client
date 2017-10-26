<?php

namespace ES\APIv2Client;

require_once __DIR__.'/vendor/autoload.php';

$client = new Client("lol");
var_dump($client->search());
