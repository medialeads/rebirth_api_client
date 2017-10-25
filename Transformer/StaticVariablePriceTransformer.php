<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/StaticVariablePrice.php');
require_once(__DIR__ . '/SupplierProfileTransformer.php');

use Model\StaticVariablePrice;

class StaticVariablePriceTransformer extends AbstractTransformer
{
    public static function doFromArray(array $staticVariablePrices): array
    {
        $response = array();
        foreach ($staticVariablePrices as $staticVariablePrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($staticVariablePrice['supplier_profile']);

            $response[] = new StaticVariablePrice($staticVariablePrice['id'], $staticVariablePrice['calculation_value'], $staticVariablePrice['reduced_value'], $staticVariablePrice['value'], $supplierProfile);
        }

        return $response;
    }
}