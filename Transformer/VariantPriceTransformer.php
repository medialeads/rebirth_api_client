<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/VariantPrice.php');

use Model\VariantPrice;

class VariantPriceTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantPrices): array
    {
        $response = array();
        foreach ($variantPrices as $variantPrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantPrice['supplier_profile']);

            $response[] =  new VariantPrice($variantPrice['id'], $variantPrice['calculation_value'], $variantPrice['reduced_value'], $variantPrice['value'], $supplierProfile, $variantPrice['from_quantity']);
        }

        return $response;
    }
}