<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\StaticFixedPrice;

class StaticFixedPriceTransformer extends AbstractTransformer
{
    /**
     * @param array $staticFixedPrices
     *
     * @return array
     */
    public static function doFromArray(array $staticFixedPrices): array
    {
        $response = array();
        foreach ($staticFixedPrices as $staticFixedPrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($staticFixedPrice['supplier_profile']);
            $markingFees = MarkingFeeTransformer::fromArray($staticFixedPrice['marking_fees']);

            $response[] =  new StaticFixedPrice($staticFixedPrice['id'], $staticFixedPrice['condition'], $staticFixedPrice['calculation_value'], $staticFixedPrice['total_price'], $staticFixedPrice['project_id'],  $markingFees, $staticFixedPrice['reduced_value'], $staticFixedPrice['value'], $supplierProfile);
        }

        return $response;
    }
}