<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantPrice;

class VariantPriceTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantPrice_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantPrice
     */
    protected function transform(array $data)
    {
        return new VariantPrice($data['id'], $data['from_quantity'], $data['value'], $data['reduced_value'],
            $data['calculation_value'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
