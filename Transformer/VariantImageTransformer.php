<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/VariantImage.php');

use Model\VariantImage;

class VariantImageTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantImages): array
    {
        $response = array();
        foreach ($variantImages as $variantImage) {
            $response[] = new VariantImage($variantImage['original_filename'], $variantImage['id'], $variantImage['url']);
        }

        return $response;
    }
}