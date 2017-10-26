<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\ProductImage;

class ProductImageTransformer extends AbstractTransformer
{
    /**
     * @param array $productImages
     *
     * @return array
     */
    public static function doFromArray(array $productImages): array
    {
        $response = array();
        foreach ($productImages as $productImage) {
            $response[] = new ProductImage($productImage['id'], $productImage['original_filename'], $productImage['url']);
        }

        return $response;
    }
}