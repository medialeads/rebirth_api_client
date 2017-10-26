<?php

namespace Transformer;

require_once('VariantTransformer.php');
require_once(__DIR__ . '/../Model/ProductImage.php');

use Model\ProductImage;

class ProductImageTransformer extends AbstractTransformer
{
    public static function doFromArray(array $productImages): array
    {
        $response = array();
        foreach ($productImages as $productImage) {
            $response[] = new ProductImage($productImage['id'], $productImage['original_filename'], $productImage['url']);
        }

        return $response;
    }
}