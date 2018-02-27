<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\StaticVariablePrice;
use Money\Money;

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
        $reducedValue = $data['reduced_value'];

        return new StaticVariablePrice($data['id'], $data['from_quantity'],
            Money::EUR(intval($data['value'] * 1000)),
            null === $reducedValue ? null : Money::EUR(intval($reducedValue * 1000)),
            Money::EUR(intval($data['calculation_value'] * 1000)));
    }
}
