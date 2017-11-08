<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\StaticVariablePriceHolder;

/**
 * @author Dagan MENEZ
 */
class StaticVariablePriceHolderTransformer extends AbstractTransformer
{
    /**
     * @param array $staticVariablePriceHolders
     *
     * @return array
     */
    public static function doFromArray($staticVariablePriceHolders)
    {
        $response = array();
        foreach ($staticVariablePriceHolders as $staticVariablePriceHolder) {
            $markingFees = MarkingFeeTransformer::fromArray($staticVariablePriceHolder['marking_fees']);

            $staticVariablePrices = StaticVariablePriceTransformer::fromArray($staticVariablePriceHolder['static_variable_prices']);

            $supplierProfile = SupplierProfileTransformer::fromArray($staticVariablePriceHolder['supplier_profile']);

            $response[] =  new StaticVariablePriceHolder($staticVariablePriceHolder['id'], $staticVariablePriceHolder['condition'], $staticVariablePriceHolder['total_price'], $staticVariablePriceHolder['project_id'], $markingFees, $staticVariablePrices, $supplierProfile);
        }

        return $response;
    }
}