<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/VariantListPrice.php");

use Model\VariantListPrice;

class VariantListPriceTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantListPrices): array
    {
        $response = array();
        foreach ($variantListPrices as $variantListPrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantListPrice['supplier_profile']);

            $response[] =  new VariantListPrice($variantListPrice['id'], $variantListPrice['calculation_value'], $variantListPrice['reduced_value'], $variantListPrice['value'], $supplierProfile);
        }

        return $response;
    }
}