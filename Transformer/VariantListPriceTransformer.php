<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantListPrice;
use Money\Money;

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
        $reducedValue = $data['reduced_value'];

        return new VariantListPrice($data['id'], Money::EUR(intval($data['value'] * 1000)),
            null === $reducedValue ? null : Money::EUR(intval($reducedValue * 1000)),
            Money::EUR(intval($data['calculation_value'] * 1000)),
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
