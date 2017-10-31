<?php

namespace ES\APIv2Client;

use ES\APIv2Client\Model\Product;

require_once __DIR__.'/vendor/autoload.php';

$client = new Client("lol");
$products = $client->search();
foreach ($products as $product) {
    /** @var Product $product */
    if (!empty($product->getVariants())) {
        foreach ($product->getVariants() as $variant) {
            $client->price($variant);
        }
    }
}