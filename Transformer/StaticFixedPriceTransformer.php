<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\StaticFixedPrice;
use Money\Money;

class StaticFixedPriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('StaticFixedPrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return StaticFixedPrice
     */
    protected function transform(array $data)
    {
        $reducedValue = $data['reduced_value'];

        return new StaticFixedPrice($data['id'], $data['condition'], Money::EUR(intval($data['value'] * 1000)),
            null === $reducedValue ? null : Money::EUR(intval($reducedValue * 1000)),
            Money::EUR(intval($data['calculation_value'] * 1000)), $data['total_price'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']),
            MarkingFeeTransformer::create()->transformMultiple($data['marking_fees']));
    }
}
