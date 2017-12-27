<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantSize;

/**
 * @author Dagan MENEZ
 */
class VariantSizeTransformer extends AbstractTransformer
{
    /**
     * @param array $variantSizes
     *
     * @return array
     */
    public static function doFromArray($variantSizes)
    {
        $response = array();
        foreach ($variantSizes as $variantSize) {
            $response[] =  new VariantSize($variantSize['id'], $variantSize['calculation_value'], $variantSize['type'], $variantSize['value']);
        }

        return $response;
    }
}