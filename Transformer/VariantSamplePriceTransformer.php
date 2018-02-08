<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantSamplePrice;

class VariantSamplePriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantSamplePrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantSamplePrice
     */
    protected function transform(array $data)
    {
        return new VariantSamplePrice($data['id'], $data['value'], $data['reduced_value'], $data['calculation_value'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
