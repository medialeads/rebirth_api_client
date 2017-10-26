<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantMinimumQuantity;

class VariantMinimumQuantityTransformer extends AbstractTransformer
{
    /**
     * @param array $variantMinimumQuantities
     *
     * @return array
     */
    public static function doFromArray(array $variantMinimumQuantities): array
    {
        $response = array();
        foreach ($variantMinimumQuantities as $variantMinimumQuantity) {
            $supplierProfile = SupplierProfileTransformer::fromArray($variantMinimumQuantity['supplier_profile']);

            $variantMinimumQuantity['project_id'] = 1; //TODO REMOVE

            $response[] =  new VariantMinimumQuantity($variantMinimumQuantity['id'], $variantMinimumQuantity['project_id'], $variantMinimumQuantity['value'], $supplierProfile);
        }

        return $response;
    }
}