<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . '/../Model/DynamicFixedPrice.php');
require_once(__DIR__ . '/SupplierProfileTransformer.php');

use Model\DynamicFixedPrice;

class DynamicFixedPriceTransformer extends AbstractTransformer
{
    public static function doFromArray(array $dynamicFixedPrices): array
    {
        $response = array();
        foreach ($dynamicFixedPrices as $dynamicFixedPrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($dynamicFixedPrice['supplier_profile']);
            $markingFees = MarkingFeeTransformer::fromArray($dynamicFixedPrice['marking_fees']);

            $response[] =  new DynamicFixedPrice($dynamicFixedPrice['id'], $dynamicFixedPrice['condition'], $dynamicFixedPrice['calculation_value'], $dynamicFixedPrice['total_price'], $dynamicFixedPrice['project_id'],  $markingFees, $dynamicFixedPrice['reduced_value'], $dynamicFixedPrice['value'], $supplierProfile);
        }

        return $response;
    }
}