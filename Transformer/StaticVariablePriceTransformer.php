<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\StaticVariablePrice;

class StaticVariablePriceTransformer extends AbstractTransformer
{
    /**
     * @param array $staticVariablePrices
     *
     * @return array
     */
    public static function doFromArray($staticVariablePrices)
    {
        $response = array();
        foreach ($staticVariablePrices as $staticVariablePrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($staticVariablePrice['supplier_profile']);

            $response[] = new StaticVariablePrice($staticVariablePrice['id'], $staticVariablePrice['calculation_value'], $staticVariablePrice['reduced_value'], $staticVariablePrice['from_quantity'], $staticVariablePrice['value'], $supplierProfile);
        }

        return $response;
    }
}