<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantListPrice;

class VariantListPriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantListPrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantListPrice
     */
    protected function transform(array $data)
    {
        return new VariantListPrice($data['id'], $data['value'], $data['reduced_value'], $data['calculation_value'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
