<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\StaticFixedPrice;

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
        return new StaticFixedPrice($data['id'], $data['condition'], $data['value'], $data['reduced_value'],
            $data['calculation_value'], $data['total_price'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']),
            MarkingFeeTransformer::create()->transformMultiple($data['marking_fees']));
    }
}
