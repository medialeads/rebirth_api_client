<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\DynamicVariablePrice;

class DynamicVariablePriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('DynamicVariablePrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return DynamicVariablePrice
     */
    protected function transform(array $data)
    {
        return new DynamicVariablePrice($data['id'], $data['from_quantity'], $data['value'], $data['reduced_value'],
            $data['calculation_value']);
    }
}
