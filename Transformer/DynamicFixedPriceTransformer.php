<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\DynamicFixedPrice;

class DynamicFixedPriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('DynamicFixedPrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return DynamicFixedPrice
     */
    protected function transform(array $data)
    {
        return new DynamicFixedPrice($data['id'], $data['condition'], $data['value'], $data['reduced_value'],
            $data['calculation_value'], $data['total_price'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']),
            MarkingFeeTransformer::create()->transformMultiple($data['marking_fees']));
    }
}
