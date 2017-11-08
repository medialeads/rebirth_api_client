<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\DynamicVariablePriceHolder;

/**
 * @author Dagan MENEZ
 */
class DynamicVariablePriceHolderTransformer extends AbstractTransformer
{
    /**
     * @param array $dynamicVariablePriceHolders
     *
     * @return array
     */
    public static function doFromArray($dynamicVariablePriceHolders)
    {
        $response = array();
        foreach ($dynamicVariablePriceHolders as $dynamicVariablePriceHolder) {

            $markingFees = MarkingFeeTransformer::fromArray($dynamicVariablePriceHolder['marking_fees']);

            $dynamicVariablePrices = DynamicVariablePriceTransformer::fromArray($dynamicVariablePriceHolder['dynamic_variable_prices']);

            $supplierProfile = SupplierProfileTransformer::fromArray($dynamicVariablePriceHolder['supplier_profile']);

            $response[] =  new DynamicVariablePriceHolder($dynamicVariablePriceHolder['id'], $dynamicVariablePriceHolder['condition'], $dynamicVariablePriceHolder['total_price'], $dynamicVariablePriceHolder['project_id'], $markingFees, $dynamicVariablePrices, $supplierProfile);
        }

        return $response;
    }
}