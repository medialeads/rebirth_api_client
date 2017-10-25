<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/VariantMinimumQuantity.php');

use Model\VariantMinimumQuantity;

class VariantMinimumQuantityTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantMinimumQuantities): array
    {
        $response = array();
        foreach ($variantMinimumQuantities as $variantMinimumQuantity) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantMinimumQuantity['supplier_profile']);

            $response[] =  new VariantMinimumQuantity($variantMinimumQuantity['id'], $variantMinimumQuantity['project_id'], $variantMinimumQuantity['value'], $supplierProfile);
        }

        return $response;
    }
}