<?php

namespace Transformer;

require_once('VariantTransformer.php');
require_once('LabelTransformer.php');
require_once(__DIR__ . '/../Model/Product.php');

use Model\Product;

class ProductTransformer extends AbstractTransformer
{
    public static function doFromArray(array $products): array
    {
        $response = array();
        foreach ($products as $product) {
            $labels = array();
            foreach ($product['labels'] as $label) {
                $labels[] = LabelTransformer::fromArray($label);
            }

            $variants = array();
            foreach ($product['variants'] as $variant) {
                $variants[] = VariantTransformer::fromArray($variant);
            }
            $products[] = new Product($product['id'], date_create($product['last_indexed_at']), $product['country_of_origin'], $product['main_product_image_id'],   $labels, $variants);
            var_dump($products); die();
        }

    }
}