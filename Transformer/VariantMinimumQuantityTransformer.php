<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantMinimumQuantity;

class VariantMinimumQuantityTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantMinimumQuantity_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantMinimumQuantity
     */
    protected function transform(array $data)
    {
        return new VariantMinimumQuantity($data['id'], $data['value'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
