<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantPackagingSize;


/**
 * @author Dagan MENEZ
 */
class VariantPackagingSizeTransformer extends AbstractTransformer
{
    /**
     * @param array $variantPackagingSizes
     *
     * @return array
     */
    public static function doFromArray($variantPackagingSizes)
    {
        $response = array();
        foreach ($variantPackagingSizes as $variantPackagingSize) {
            $response[] = new VariantPackagingSize($variantPackagingSize['id'], $variantPackagingSize['project_id'], $variantPackagingSize['name'], $variantPackagingSize['slug']);
        }

        return $response;
    }
}