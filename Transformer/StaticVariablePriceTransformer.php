<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\StaticVariablePrice;

/**
 * @author Dagan MENEZ
 */
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
            $response[] = new StaticVariablePrice($staticVariablePrice['id'], $staticVariablePrice['calculation_value'], $staticVariablePrice['reduced_value'], $staticVariablePrice['from_quantity'], $staticVariablePrice['value']);
        }

        return $response;
    }
}