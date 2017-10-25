<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/StaticVariablePriceHolder.php");
require_once(__DIR__ . "/MarkingFeeTransformer.php");
require_once(__DIR__ . "/StaticVariablePriceTransformer.php");
require_once(__DIR__ . "/SupplierProfileTransformer.php");

use Model\StaticVariablePriceHolder;

class StaticVariablePriceHolderTransformer extends AbstractTransformer
{
    public static function doFromArray(array $staticVariablePriceHolders): array
    {
        $response = array();
        foreach ($staticVariablePriceHolders as $staticVariablePriceHolder) {
            $markingFees = MarkingFeeTransformer::fromArray($staticVariablePriceHolder['marking_fees']);

            $staticVariablePrices[] = StaticVariablePriceTransformer::fromArray($staticVariablePriceHolder['static_variable_prices']);

            $supplierProfile = SupplierProfileTransformer::fromArray($staticVariablePriceHolder['supplier_profile']);

            $response[] =  new StaticVariablePriceHolder($staticVariablePriceHolder['id'], $staticVariablePriceHolder['condition'], $staticVariablePriceHolder['total_price'], $staticVariablePriceHolder['project_id'], $markingFees, $staticVariablePrices, $supplierProfile);
        }

        return $response;
    }
}