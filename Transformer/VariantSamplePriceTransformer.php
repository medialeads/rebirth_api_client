<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantSamplePrice;
use Money\Money;

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
        $reducedValue = $data['reduced_value'];

        return new VariantSamplePrice($data['id'], Money::EUR(intval($data['value'] * 1000)),
            null === $reducedValue ? null : Money::EUR(intval($reducedValue * 1000)),
            Money::EUR(intval($data['calculation_value'] * 1000)),
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
