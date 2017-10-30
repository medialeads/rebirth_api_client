<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantSamplePrice;

class VariantSamplePriceTransformer extends AbstractTransformer
{
    /**
     * @param array $variantSamplePrices
     *
     * @return array
     */
    public static function doFromArray($variantSamplePrices)
    {
        $response = array();
        foreach ($variantSamplePrices as $variantSamplePrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantSamplePrice['supplier_profile']);

            $response[] =  new VariantSamplePrice($variantSamplePrice['id'], $variantSamplePrice['calculation_value'], $variantSamplePrice['reduced_value'], $variantSamplePrice['value'], $supplierProfile);
        }

        return $response;
    }
}