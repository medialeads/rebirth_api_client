<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\DynamicVariablePriceHolder;

class DynamicVariablePriceHolderTransformer extends AbstractTransformer
{
    /**
     * @param array $dynamicVariablePriceHolders
     *
     * @return array
     */
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