<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/VariantSamplePrice.php");

use Model\VariantSamplePrice;

class VariantSamplePriceTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantSamplePrices): array
    {
        $response = array();
        foreach ($variantSamplePrices as $variantSamplePrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantSamplePrice['supplier_profile']);

            $response[] =  new VariantSamplePrice($variantSamplePrice['id'], $variantSamplePrice['calculation_value'], $variantSamplePrice['reduced_value'], $variantSamplePrice['value'], $supplierProfile);
        }

        return $response;
    }
}