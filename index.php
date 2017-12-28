<?php

namespace ES\APIv2Client;

require_once __DIR__.'/vendor/autoload.php';

$client = new Client("7hQ87N5c2Ts5XKlEYGRihrPc0FMaYmm0", 'fr', 'v1.0');
$handlers = array(
    array(
        'query' => 'sac'
    )
);
$products = $client->searchProductsBy($handlers);