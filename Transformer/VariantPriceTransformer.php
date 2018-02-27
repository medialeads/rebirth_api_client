<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantPrice;
use Money\Money;

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
        $reducedValue = $data['reduced_value'];

        return new VariantPrice($data['id'], $data['from_quantity'], Money::EUR(intval($data['value'] * 1000)),
            null === $reducedValue ? null : Money::EUR(intval($reducedValue * 1000)),
            Money::EUR(intval($data['calculation_value'] * 1000)),
            PartialSupplierProfileTransformer::create()->transformOne($data['supplier_profile']));
    }
}
