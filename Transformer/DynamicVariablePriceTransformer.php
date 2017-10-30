<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\DynamicVariablePrice;

class DynamicVariablePriceTransformer extends AbstractTransformer
{
    /**
     * @param array $dynamicVariablePrices
     *
     * @return array
     */
    public static function doFromArray($dynamicVariablePrices)
    {
        $response = array();
        foreach ($dynamicVariablePrices as $dynamicVariablePrice) {
            $response[] =  new DynamicVariablePrice($dynamicVariablePrice['id'], $dynamicVariablePrice['calculation_value'], $dynamicVariablePrice['reduced_value'], $dynamicVariablePrice['from_quantity'], $dynamicVariablePrice['value']);
        }

        return $response;
    }
}