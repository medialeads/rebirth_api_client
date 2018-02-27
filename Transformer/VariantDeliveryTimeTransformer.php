<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantDeliveryTime;

class VariantDeliveryTimeTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantDeliveryTime_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantDeliveryTime
     */
    protected function transform(array $data)
    {
        return new VariantDeliveryTime($data['id'], $data['value'],
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
