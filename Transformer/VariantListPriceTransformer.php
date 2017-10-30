<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantListPrice;

class VariantListPriceTransformer extends AbstractTransformer
{
    /**
     * @param array $variantListPrices
     *
     * @return array
     */
    public static function doFromArray($variantListPrices)
    {
        $response = array();
        foreach ($variantListPrices as $variantListPrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantListPrice['supplier_profile']);

            $response[] =  new VariantListPrice($variantListPrice['id'], $variantListPrice['calculation_value'], $variantListPrice['reduced_value'], $variantListPrice['value'], $supplierProfile);
        }

        return $response;
    }
}