<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantImage;

class VariantImageTransformer extends AbstractTransformer
{
    /**
     * @param array $variantImages
     *
     * @return array
     */
    public static function doFromArray(array $variantImages): array
    {
        $response = array();
        foreach ($variantImages as $variantImage) {
            $response[] = new VariantImage($variantImage['id'], $variantImage['original_filename'], $variantImage['url']);
        }

        return $response;
    }
}