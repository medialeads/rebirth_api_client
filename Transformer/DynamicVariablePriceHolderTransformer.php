<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/DynamicVariablePriceHolder.php");
require_once(__DIR__ . "/MarkingFeeTransformer.php");
require_once(__DIR__ . "/StaticFixedPriceTransformer.php");
require_once(__DIR__ . "/SupplierProfileTransformer.php");

use Model\DynamicVariablePriceHolder;

class DynamicVariablePriceHolderTransformer extends AbstractTransformer
{
    public static function doFromArray(array $dynamicVariablePriceHolders): array
    {
        $response = array();
        foreach ($dynamicVariablePriceHolders as $dynamicVariablePriceHolder) {

            $markingFees = MarkingFeeTransformer::fromArray($dynamicVariablePriceHolder['marking_fees']);

            $dynamicVariablePrices = array();
            foreach ($dynamicVariablePriceHolder['static_variable_prices'] as $dynamicVariablePrice) {
                $dynamicVariablePrices[] = StaticFixedPriceTransformer::fromArray($dynamicVariablePrice);
            }

            $supplierProfile = SupplierProfileTransformer::fromArray($dynamicVariablePriceHolder['supplier_profile']);

            $response[] =  new DynamicVariablePriceHolder($dynamicVariablePriceHolder['id'], $dynamicVariablePriceHolder['condition'], $dynamicVariablePriceHolder['total_price'], $dynamicVariablePriceHolder['project_id'], $markingFees, $dynamicVariablePrices, $supplierProfile);
        }

        return $response;
    }
}