<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\StaticVariablePrice;

class StaticVariablePriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('StaticVariablePrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return StaticVariablePrice
     */
    protected function transform(array $data)
    {
        return new StaticVariablePrice($data['id'], $data['from_quantity'], $data['value'], $data['reduced_value'],
            $data['calculation_value']);
    }
}
