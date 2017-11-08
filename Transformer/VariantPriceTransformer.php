<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantPrice;

/**
 * @author Dagan MENEZ
 */
class VariantPriceTransformer extends AbstractTransformer
{
    /**
     * @param array $variantPrices
     *
     * @return array
     */
    public static function doFromArray($variantPrices)
    {
        $response = array();
        foreach ($variantPrices as $variantPrice) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantPrice['supplier_profile']);

            $response[] =  new VariantPrice($variantPrice['id'], $variantPrice['calculation_value'], $variantPrice['reduced_value'], $variantPrice['value'], $supplierProfile, $variantPrice['from_quantity']);
        }

        return $response;
    }
}