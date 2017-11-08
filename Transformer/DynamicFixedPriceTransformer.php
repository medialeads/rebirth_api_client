<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\DynamicFixedPrice;

/**
 * @author Dagan MENEZ
 */
class DynamicFixedPriceTransformer extends AbstractTransformer
{
    /**
     * @param array $dynamicFixedPrices
     *
     * @return array
     */
    public static function doFromArray($dynamicFixedPrices)
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