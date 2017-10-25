<?php

namespace Transformer;

require_once(__DIR__ . '/../Model/VariantImage.php');

use Model\VariantImage;

class VariantImageTransformer
{
    public function fromArray($variantImage)
    {
        return new VariantImage($variantImage['original_filename'], $variantImage['id'], $variantImage['url']);
    }
}