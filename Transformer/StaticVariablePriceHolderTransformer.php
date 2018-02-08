<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\StaticVariablePriceHolder;

class StaticVariablePriceHolderTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('StaticVariablePriceHolder_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return StaticVariablePriceHolder
     */
    protected function transform(array $data)
    {
        return new StaticVariablePriceHolder($data['id'], $data['condition'], $data['total_price'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']),
            StaticVariablePriceTransformer::create()->transformMultiple($data['static_variable_prices']),
            MarkingFeeTransformer::create()->transformMultiple($data['marking_fees']));
    }
}
