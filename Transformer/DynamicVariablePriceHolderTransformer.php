<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\DynamicVariablePriceHolder;

class DynamicVariablePriceHolderTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('DynamicVariablePriceHolder_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return DynamicVariablePriceHolder
     */
    protected function transform(array $data)
    {
        return new DynamicVariablePriceHolder($data['id'], $data['condition'], $data['total_price'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']),
            DynamicVariablePriceTransformer::create()->transformMultiple($data['dynamic_variable_prices']),
            MarkingFeeTransformer::create()->transformMultiple($data['marking_fees']));
    }
}
